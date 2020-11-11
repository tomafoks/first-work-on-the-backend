<?php
session_start();
$img = imagecreatefromjpeg('../images/noise.jpg');
$color = imagecolorallocate($img, 64, 64, 64);
imageantialias($img, true);

$nChars = 5;
$randStr = substr(md5(uniqid()), 0, $nChars);
$_SESSION['randStr'] = $randStr;
$font = dirname(__FILE__) . "/arial.ttf";

$x = 20; $y = 30; $deltaX = 40;

for($i=0; $i<$nChars; $i++){
    $size = rand(16, 30);
    $angle = -30 + rand(0, 60);
    imagettftext($img, $size, $angle, $x, $y, $color, $font, $randStr{$i});
    $x += $deltaX;
}

header('Content-Type: image/jpg');
imagejpeg($img);