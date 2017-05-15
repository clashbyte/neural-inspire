<?php
	
	// Выбор генератора
	if(isset($_REQUEST["old"])){
		include "old/lib.php";
	}else{
		include "new/lib.php";
	}
	
	// Режим и выбор
	$mode = strtok(str_replace("/", "", str_replace("/inspire", "", $_SERVER['REQUEST_URI'])), '?');
	
	// Выбор текущего режима
	switch($mode) {
		
		case "test":
			
			print_r($_SERVER['REQUEST_URI']);
			die();
			break;
		
		// Апишка
		case "api":
			header("Content-type: text/plain; charset=utf-8");
			echo json_encode(array(
				"quote" 	=> Generate(),
				"author"	=> GenerateSub()
			), JSON_UNESCAPED_UNICODE);
			die();
			break;
			
		// Картинка
		case "img":
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			include "imagegen.php";
			break;
		
		// Просто страница
		default:
			include "page.php";
	}
	
