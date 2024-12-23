<?php
function compressPhoto($source_file) {
    // Set the compression level (0-100)
    $compression_level = 80;

    // Load the image and get its dimensions
    $source_image = imagecreatefromstring(file_get_contents($source_file));
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    // Create a new image in JPEG format with the same dimensions as the source image
    $destination_image = imagecreatetruecolor($width, $height);

    // Copy the source image to the destination image and save it as a JPEG file with the desired compression level
    imagecopy($destination_image, $source_image, 0, 0, 0, 0, $width, $height);
    imagejpeg($destination_image, "compressed/", $compression_level);

    // Free up memory used by the images
    imagedestroy($source_image);
    imagedestroy($destination_image);
}
?>