<?php
// The file
$filename = $_GET['image'] ;
$typ = substr($filename, -3);
// Set a maximum height and width
$width = $_GET['w'];
$height = $_GET['h'];

// Content type
header('Content-Type: image/jpeg');

// Get new dimensions
list($width_orig, $height_orig) = getimagesize($filename);

$ratio_orig = $width_orig/$height_orig;

if ($width/$height > $ratio_orig) {
   $width = $height*$ratio_orig;
} else {
   $height = $width/$ratio_orig;
}

// Resample
$image_p = imagecreatetruecolor($width, $height);
if ($typ == "png") {
$image = imagecreatefrompng($filename);
}
else {
$image = imagecreatefromjpeg($filename);
}
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

// Output
imagejpeg($image_p, null, 100);
?>
