<?php

require 'vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

// Increase memory limit
ini_set('memory_limit', '512M');

// Set up Google Cloud credentials
putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/verb4874/gcsk/psyched-oxide-424402-a3-38779c1a080f.json'); // Replace with the path to your service account key

// Define your directories and bucket name
$localDirectory = __DIR__ . '/pdfs';
$gcsBucketName = 'verfak_ktp';
$zipFilename = 'missing_files.zip';
$maxZipSize = 10 * 1024 * 1024; // 10MB in bytes

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
    $missingFiles = array_diff($localFileNames, $gcsFileNames);
    return array_slice($missingFiles, 0, 100); // Limit to the first 100 missing files
}

function zipMissingFiles($missingFiles, $sourceDirectory, $zipFilename, $maxZipSize) {
    $zip = new ZipArchive();
    if ($zip->open($zipFilename, ZipArchive::CREATE) !== TRUE) {
        exit("Cannot open <$zipFilename>\n");
    }

    $currentSize = 0;
    foreach ($missingFiles as $file) {
        $filePath = $sourceDirectory . DIRECTORY_SEPARATOR . $file;
        if (file_exists($filePath)) {
            $fileSize = filesize($filePath);
            if ($currentSize + $fileSize > $maxZipSize) {
                break; // Stop adding files if the next file exceeds the 10MB limit
            }
            $zip->addFile($filePath, $file);
            $currentSize += $fileSize;
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

// Find missing files (limit to the first 100)
$missingFiles = findMissingFiles($localFiles, $gcsFiles);

// Zip missing files with a size limit of 10MB
zipMissingFiles($missingFiles, $localDirectory, $zipFilename, $maxZipSize);

// Create a downloadable zip file
createDownload($zipFilename);

?>
