<?php 
	
	 
	// Параметры шрифта и картинки
	$font = __DIR__.'/roboto.ttf';
	$font_size = $_GET["size"] ? (int)$_GET["size"] : 14;
	$width = $_GET["width"] ? (int)$_GET["width"] : 400;
	$margin = 0;
	$font_size = min(max($font_size, 8), 64);
	$width = min(max($width, 100), 1000);
	 
	//content type
	header('Content-Type: image/png');
	
	// Генерация фразы
	$text = Generate();
	 
	// Разбор по словам
	$text_a = explode(' ', $text);
	$text_new = '';
	foreach($text_a as $word){
		$box = imagettfbbox($font_size, 0, $font, $text_new.' '.$word);
		if($box[2] > $width - $margin*2){
			$text_new .= "\n".$word;
		} else {
			$text_new .= " ".$word;
		}
	}
	$text_new = trim($text_new);
	$box = imagettfbbox($font_size, 0, $font, $text_new);
	$height = $box[1] + $font_size + $margin * 2;
	 
	// Картинка
	$im = imagecreatetruecolor($width, $height);
	$bgrcolor = imagecolorallocatealpha($im, 255, 0, 255, 127);
	$acccolor = imagecolorallocate($im, 0, 0, 0);
	imagesavealpha($im, true);
	imagefill($im, 0, 0, $bgrcolor);
	imagecolortransparent($im, $bgrcolor);
	
	imagettftext($im, $font_size, 0, $margin, $font_size+$margin, $acccolor, $font, $text_new);
	imagepng($im);
	imagedestroy($im);