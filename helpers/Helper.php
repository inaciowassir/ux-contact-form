<?php

$root = trim($_SERVER['APP_DOMAIN'], "/");

define('ROOT',$root."/");
define('FOLDER_PERMISSIONS',0755);

function route($route = null)
{
	global $root;
	$route = trim($route, "/");
	return ($route == null) ? $root : $root . "/" . $route;
}

function asset($asset)
{
	global $root;
	$asset = trim($asset, "/");
	return "{$root}/views/assets/{$asset}";
}

function upload($path)
{
	$path = trim($path, "/")."/";
	return "views/assets/uploads/{$path}";
}

function uploadedFile($path)
{
	global $root;
	$path = trim($path, "/");
	
	$relativePath = "views/assets/uploads/{$path}";
	$fullPath = "{$root}/views/assets/uploads/";
	
	if(file_exists($relativePath) && !is_dir($relativePath)) 
	{
		return "{$fullPath}{$path}";
	}
	return "{$root}/views/assets/images/cover-img.jpg";
}

function redirect(String $url, int $code = 301)
{
	header("Location: ". $url, true, $code);        
	exit();
}

function slug($string)
{
	$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
	$b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';	
	$string = utf8_decode($string);
	$string = strtr($string, utf8_decode($a), $b);
	$string = strip_tags(trim($string));
	$string = str_replace(" ","-",$string);
	$string = str_replace(array("-----","----","---","--"),"-",$string);
	return strtolower(utf8_encode($string));
}

function resume($string, $words = '200')
{
	$string 	= trim(strip_tags($string));
	$count		= strlen($string);	
	
	if($count <= $words){
		return $string;	
	}else{
		$strpos = strrpos(substr($string,0,$words),' ');
		return trim(substr($string,0,$strpos)).'...';
	}		
}

function saveThumbnail($saveToDir, $imagePath, $imageName, $max_x, $max_y) {
	preg_match("'^(.*)\.(gif|jpeg|jpg|png)$'i", $imageName, $ext);
	switch (strtolower($ext[2])) {
		case 'jpg' :
					 $im   = imagecreatefromjpeg ($imagePath);
					 break;
		case 'jpeg': $im   = imagecreatefromjpeg ($imagePath);
					 break;
		case 'gif' : $im   = imagecreatefromgif  ($imagePath);
					 break;
		case 'png' : $im   = imagecreatefrompng  ($imagePath);
					 break;
		default    : $stop = true;
					 break;
	}
   
	if (!isset($stop)) {
		$x = imagesx($im);
		$y = imagesy($im);
   
		if (($max_x/$max_y) < ($x/$y)) {
			$save = imagecreatetruecolor($x/($x/$max_x), $y/($x/$max_x));
		}
		else {
			$save = imagecreatetruecolor($x/($y/$max_y), $y/($y/$max_y));
		}
		imagecopyresized($save, $im, 0, 0, 0, 0, imagesx($save), imagesy($save), $x, $y);
	   
		imagejpeg($save, "{$saveToDir}{$imageName}");
		imagedestroy($im);
		imagedestroy($save);
		
		return true;
	}
	
	return false;
}

function selectedOption($key, $value)
{
	if($key == $value)
		return 'selected="selected"';
}