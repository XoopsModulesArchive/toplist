<?php 
/*
header("Content-type: image/png");
$grafik = ImageCreate (70, 20);

$hintergrundfarbe = ImageColorAllocate($grafik, 255, 255, 255);

$rechteckfarbe    = ImageColorAllocate($grafik, 255,   0,   0);
#$ellipsenfarbe    = ImageColorAllocate($grafik,   0,   0, 255);

imagefilledrectangle($grafik,0,0,70,20,$rechteckfarbe);

#$ellipsenbreite = 6*10;
#imageellipse($grafik,60,65,$ellipsenbreite,35,$ellipsenfarbe);

ImagePNG($grafik);
imagedestroy($grafik);
*/

/*
$image = imagecreate(90,20); 
$farbe_body=imagecolorallocate($image,255,255,255);
$font_c = imagecolorallocate($image,10,36,106);
imagettftext($image, 10, 0, 2, 16, $font_c, "images/msttcorefonts/arial.ttf", "Xoops Topsite"); 
header("Content-type: image/gif"); 
imagegif($image); 
*/
header('Content-Type:image/gif');
readfile("http://demo.myxoops.org/modules/toplist/images/xoops-toplist.png"); 
?>
