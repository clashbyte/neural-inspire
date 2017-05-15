<?php

	// Данные 
	global $database;
	$database = json_decode(file_get_contents(__DIR__."/data.json"));	
	
	// Получение первого слова
	function GetFirstWord() {
		global $database;
		$num = rand(1, $database->totalWeight)-1;
		$acc = 0;
		foreach($database->words as $word){
			if($word->weight > 0){
				$acc += $word->weight;
				if($acc > $num){
					return $word;
				}
			}
		}
	}
	
	// Получение следующего слова
	function GetNextWord($w) {
		global $database;
		if($w->childWeight == 0){
			return null;
		}
		$num = rand(1, $w->childWeight)-1;
		$acc = 0;
		foreach($w->children as $id => $weight){
			$acc += $weight;
			if($acc > $num){
				return $database->words[$id];
			}
		}
		return null;
	}
	
	// Генератор высказывания
	function Generate(){

		// Аккумулятор слов
		$out = "";
		$currentWord = GetFirstWord();
		$out .= mb_strtoupper(mb_substr($currentWord->name, 0, 1)).mb_substr($currentWord->name, 1);
		
		while($currentWord = GetNextWord($currentWord)){
			$out .= ' ' . $currentWord->name;
		}
		return $out.".";	
	}
	
	// Генератор подписи
	function GenerateSub() {
		$names = [
			"Богдан",
			"Богдан",
			"Богдан",
			"Богдан Петров",
			"Богдан Петров",
			"Великий оптимизатор",
			"Оптимизатор",
			"Java-бог",
			"Бгдн",
			"БГДН",
			"Эксперт",
			"Эксперт по всем вопросам"
		];
		$times = [
			"400 г. до н. э.",
			"позавчера",
			"2013 г.",
			"1984 г.",
			"time()",
			"(unixtime ".time().")",
			"1366 г.",
			"1024х768 г.",
			"ушедший в своп",
			"великий и ужасный",
			"что всех заебал",
			"автор учебников по правописанию",
			'<?php $times[$i] ?>',
			'кудах',
			'увековеченный в нейросети',
			'<?= date("Y") ?>',
			date("Y")
		];
		return $names[array_rand($names)].", ".$times[array_rand($times)];
	}
	
