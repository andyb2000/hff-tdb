<?php
// This is a simple image thumbnail generator in memory

$load_image=$_REQUEST["img"];
if (!$load_image) {exit;};
$load_image = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $load_image);
$load_image = mb_ereg_replace("([\.]{2,})", '', $load_image);

// set the file location properly
$load_image=getcwd()."/../../".$load_image;
echo "DEBUG: '".$load_image."'<BR>\n";
exit;
header('Content-type: image/jpeg');

list($width, $height) = getimagesize("library_images/".$load_image);

$create = imagecreatetruecolor(150, 150);
$img = imagecreatefromjpeg("library_images/".$load_image);

$newwidth = 150;
$newheight = 150;

imagecopyresized($create, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($create, null, 100);

?>