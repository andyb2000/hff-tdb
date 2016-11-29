<?php
// This is a simple image thumbnail generator in memory

$load_image=$_REQUEST["img"];
if (!$load_image) {exit;};
//$load_image = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $load_image);
$load_image = mb_ereg_replace("([\.]{2,})", '', $load_image);

// set the file location properly
$load_image=getcwd()."/../../".$load_image;

header('Content-type: image/jpeg');

echo make_thumb($src, 50);
exit;

function make_thumb($load_image, $desired_width) {

	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);

	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));

	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image);
}
?>