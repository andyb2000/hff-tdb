<?php
// This is a simple image thumbnail generator in memory

$load_image=$_REQUEST["img"];
if (!$load_image) {exit;};
//$load_image = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $load_image);
$load_image = mb_ereg_replace("([\.]{2,})", '', $load_image);

// set the file location properly
$load_image=getcwd()."/../../".$load_image;

header('Content-type: image/jpeg');

echo resize(150, $load_image);
exit;

function resize($newWidth, $originalFile) {

	$info = getimagesize($originalFile);
	$mime = $info['mime'];

	switch ($mime) {
		case 'image/jpeg':
			$image_create_func = 'imagecreatefromjpeg';
			$image_save_func = 'imagejpeg';
			$new_image_ext = 'jpg';
			break;

		case 'image/png':
			$image_create_func = 'imagecreatefrompng';
			$image_save_func = 'imagepng';
			$new_image_ext = 'png';
			break;

		case 'image/gif':
			$image_create_func = 'imagecreatefromgif';
			$image_save_func = 'imagegif';
			$new_image_ext = 'gif';
			break;

		default:
			throw new Exception('Unknown image type.');
	}

	$img = $image_create_func($originalFile);
	list($width, $height) = getimagesize($originalFile);

	$newHeight = ($height / $width) * $newWidth;
	$tmp = imagecreatetruecolor($newWidth, $newHeight);
	imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

	$image_save_func($tmp);
};
?>