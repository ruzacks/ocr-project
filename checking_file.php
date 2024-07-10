<?php

require 'vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

// Set up Google Cloud credentials
putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/verb4874/gcsk/psyched-oxide-424402-a3-38779c1a080f.json'); // Replace with the path to your service account key

// Define your directories and bucket name
$localDirectory = __DIR__ . '/pdfs';
$gcsBucketName = 'verfak_ktp';
$zipFilename = 'missing_files.zip';

function listLocalFiles($directory) {
    $files = array_diff(scandir($directory), ['.', '..']);
    return array_filter($files, function($file) use ($directory) {
        return is_file($directory . DIRECTORY_SEPARATOR . $file);
    });
}

function listGcsFiles($bucketName) {
    $storage = new StorageClient();
    $bucket = $storage->bucket($bucketName);
    $objects = $bucket->objects();

    $files = [];
    foreach ($objects as $object) {
        $files[] = $object->name();
    }

    return $files;
}

function findMissingFiles($localFiles, $gcsFiles) {
    $localFileNames = array_map('basename', $localFiles);
    $gcsFileNames = array_map('basename', $gcsFiles);
    return array_diff($localFileNames, $gcsFileNames);
}

function zipMissingFiles($missingFiles, $sourceDirectory, $zipFilename) {
    $zip = new ZipArchive();
    if ($zip->open($zipFilename, ZipArchive::CREATE) !== TRUE) {
        exit("Cannot open <$zipFilename>\n");
    }

    foreach ($missingFiles as $file) {
        $filePath = $sourceDirectory . DIRECTORY_SEPARATOR . $file;
        if (file_exists($filePath)) {
            $zip->addFile($filePath, $file);
        }
    }

    $zip->close();
}

function createDownload($zipFilename) {
    if (file_exists($zipFilename)) {
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . basename($zipFilename) . '"');
        header('Content-Length: ' . filesize($zipFilename));

        flush();
        readfile($zipFilename);

        // Delete the zip file after download
        unlink($zipFilename);
        exit();
    } else {
        exit("Failed to create zip file $zipFilename\n");
    }
}

// List files in local directory and GCS bucket
$localFiles = listLocalFiles($localDirectory);
$gcsFiles = listGcsFiles($gcsBucketName);

// Find missing files
$missingFiles = findMissingFiles($localFiles, $gcsFiles);

// Zip missing files
zipMissingFiles($missingFiles, $localDirectory, $zipFilename);

// Create a downloadable zip file
createDownload($zipFilename);

?>
