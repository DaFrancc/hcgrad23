<?php

// Get the directory path to the photos folder
$photosDirectory = 'uploads/';

// Get all the files in the directory
$files = glob($photosDirectory . '/*.jpg');

// Create a new zip archive
$zip = new ZipArchive();
$zipFileName = 'memories.zip';

// Open the zip archive
if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
  
  // Add each photo to the zip archive
  foreach ($files as $file) {
    $zip->addFile($file, basename($file));
  }
  
  // Close the zip archive
  $zip->close();
  
  // Set the response headers to indicate a file download
  header('Content-Type: application/zip');
  header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
  header('Content-Length: ' . filesize($zipFileName));
  
  // Send the zip archive to the user for download
  readfile($zipFileName);
  
  // Delete the zip archive file
  unlink($zipFileName);
  
} else {
  // Failed to create the zip archive
  echo "Error creating zip archive";
}
?>