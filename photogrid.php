<?php
$o_dir = 'uploads/';
$c_dir = 'compressed/';
$p_dir = 'previewImages/'; // folder containing the images
$preview_images = array();
$reverse_preview_images = array();
if (is_dir($p_dir)) {
    $files = scandir($p_dir);
    foreach ($files as $file) {
        if (in_array($file, array('.', '..'))) continue;
        $preview_images[] = $file;
    }
    $reverse_preview_images = array_reverse($preview_images);
}

$currentImage = 0;

$imagesHtml = '';
foreach ($reverse_preview_images as $image) {
    $imagesHtml .= '<div class="grid-item" id="imgdiv' . $currentImage . '"><button class="image-button" onclick="openImage(this)"><img org-img="' . $o_dir . $image . '" comp-img="' . $c_dir . $image . '" data-lazy="' . $p_dir . $image . '" class="lazyimage gridimg"/></button></div>';
    $currentImage++;
}

echo $imagesHtml; // output the HTML code for the random images
?>