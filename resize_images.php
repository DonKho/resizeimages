<?php
/*
this script will automatically resize your images ,
if you have a tons of images with large width/height pixels, 
and you needs to change all image files into smaller pixels,
use this apps. you can change/update resize your hundred / thousands / millions image with just one,two,three second.

put your original images in folder images
create folder results to store result images

author : Kukuh TW
email : kukuhtw@gmail.com

*/

$dir    = 'c:\xampp\htdocs\test_resize\images'; // <--- this is your directory images
$files1 = scandir($dir);

$datajson1 = json_encode($files1) ;
$datadecode = json_decode($datajson1);

$allfiles = implode("~~~",$files1);
$jumlahdata = substr_count($allfiles,"~~~");
 
for ($x=0;$x<=$jumlahdata;$x++) {
	echo "<br> Data ke ".$x. " = " .$datadecode[$x];
	$cek_extension = substr($datadecode[$x], -3);
	$cek_extension = strtolower($cek_extension);
    if ($cek_extension=="jpg" || $cek_extension=="jpeg" || $cek_extension=="png") {
		$fileakandiresize = "images/".$datadecode[$x];
		list($width, $height) = getimagesize($fileakandiresize);
		
		if ($width>$height) {
			//landscape mode
			$w_step1= 1000; // pixel widths <---- change this pixels as small as you need . 
			$h_step1= 800; // pixel heights <---- change this pixels as small as you need
		}
		else {
			//portrait mode
			$w_step1= 800; // pixel widths <---- change this pixels as small as you need . 
			$h_step1= 1000; // pixel heights <---- change this pixels as small as you need
		}
		
	    $dst_x=0;
		$dst_y=0;
		$src_x=0;
		$src_y=0;
		$dst_w = $w_step1;
		$dst_h = $h_step1;
		$src_w=$width;
		$src_h=$height;
		$results_image = imagecreatetruecolor($dst_w, $dst_h);
		if ($cek_extension=="jpg" || $cek_extension=="jpeg" ) {
			$src_image = imagecreatefromjpeg($fileakandiresize);	
		}
		else if ($cek_extension=="png") {
			$src_image = imagecreatefrompng($fileakandiresize);	
		}
		

      	imagecopyresized($results_image, $src_image,
		$dst_x, $dst_y,
		$src_x, $src_y,
		$dst_w, $dst_h,
		$src_w, $src_h );

		// Output
		$namafile_results = "results/".$datadecode[$x];
		imagejpeg($results_image,$namafile_results);
		imageDestroy($results_image);
    }
	
}

?>
