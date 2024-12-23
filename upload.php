<?php
$target_dir = "uploads/";
$timestamp = date("m-d-Y_H-i-s");
$file_count = 0;
$uploaded_files = array();

function compressPhoto($source_file, $destination_file) {
    // Set the compression level (0-100)
    $compression_level = 50;

    // Load the image and get its dimensions
    $source_image = imagecreatefromstring(file_get_contents($source_file));
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    
    $new_width = $width / 2;
    $new_height = $height / 2;

    // Create a new image in JPEG format with the same dimensions as the source image
    $destination_image = imagecreatetruecolor($new_width, $new_height);

    // Copy the source image to the destination image and save it as a JPEG file with the desired compression level
    imagecopyresampled($destination_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagejpeg($destination_image, $destination_file, $compression_level);

    // Free up memory used by the images
    imagedestroy($source_image);
    imagedestroy($destination_image);
}

function createPreviewPhoto($source_file, $destination_file) {
    // Set the compression level (0-100)
    $compression_level = 85;

    // Load the image and get its dimensions
    $source_image = imagecreatefromstring(file_get_contents($source_file));
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    // Calculate the size of the square
    $square_size = min($width, $height);

    // Calculate the coordinates to crop the square from the center
    $crop_x = ($width - $square_size) / 2;
    $crop_y = ($height - $square_size) / 2;

    // Create a new image in JPEG format with the desired size
    $destination_image = imagecreatetruecolor(200, 200);

    // Crop the square from the source image and resize it to the desired size
    imagecopyresampled($destination_image, $source_image, 0, 0, $crop_x, $crop_y, 200, 200, $square_size, $square_size);

    // Save the compressed image as a JPEG file in the "previewImages" folder
    imagejpeg($destination_image, $destination_file, $compression_level);

    // Free up memory used by the images
    imagedestroy($source_image);
    imagedestroy($destination_image);
}

foreach ($_FILES["inpFile"]["name"] as $key => $file) {
    $file_extension = 'jpg'; // force extension to JPEG
    $target_file = $target_dir . $timestamp . "_" . ++$file_count . "." . $file_extension;

    // Convert the uploaded image to JPEG format
    $source_file = $_FILES["inpFile"]["tmp_name"][$key];
    $image = imagecreatefromstring(file_get_contents($source_file));
    $exif = exif_read_data($source_file);
    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;
            case 6:
                $image = imagerotate($image, -90, 0);
                break;
            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }
    }
    imagejpeg($image, $source_file, 100); // convert to JPEG with maximum quality
    imagedestroy($image);

    if (move_uploaded_file($_FILES["inpFile"]["tmp_name"][$key], $target_file)) {
        $uploaded_files[] = $target_file;
    } else {
        // File could not be uploaded
        header('HTTP/1.1 400 Bad Request');
        exit;
    }
}

header('HTTP/1.1 200 OK');

foreach ($uploaded_files as $file) {
    $source_file = $file;
    $compressed_destination_file = "compressed/" . basename($file);
    $preview_destination_file = "previewImages/" . basename($file);
    compressPhoto($source_file, $compressed_destination_file);
    createPreviewPhoto($source_file, $preview_destination_file);
}
?>
