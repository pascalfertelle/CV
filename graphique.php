<?php header ("Content-type: image/png");
$image = imagecreate(200,50);
$orange = imagecolorallocate($image, 255, 128, 0);
imagepng($image);
?>