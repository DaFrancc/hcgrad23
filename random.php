<?php
      $dir = 'compressed/'; // folder containing the images
      $images = array();
      if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
          if (in_array($file, array('.', '..'))) continue;
          $images[] = $dir . $file;
        }
      }
      shuffle($images); // shuffle the array to get random assortment of images

      $numImages = 10; // default number of images to load
      $randomImages = array_slice($images, 0, $numImages);
      $currentImage = 0;

      $imagesHtml = '';
      foreach ($randomImages as $image) {
        $imagesHtml .= '<td id="bgtd'.$currentImage.'"><img data-lazy="' . $image . '" class="lazyimage" /></td>';
        $currentImage++;
      }

      echo $imagesHtml; // output the HTML code for the random images
?>