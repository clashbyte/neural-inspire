<?
	
	include "data.php";
	
	// Получение слова
	function PickWord($p) {
		$num = rand(1, $p["childWeight"])-1;
		$acc = 0;
		foreach($p["children"] as $ch) {
			$acc += $ch["weight"];
			if($acc > $num){
				return $ch;
			}
		}
		return null;
	}
	
	// Генерация высказывания
	function Generate() {
		global $database;
		$out = "";
		$p = PickWord($database);
		$first = true;
		while($p){
			$nm = $p["name"];
			if($first){
				$out = mb_strtoupper(mb_substr($nm, 0, 1)).mb_substr($nm, 1);
				$first = false;
			}else{
				$out .= " ".$nm;
			}
			$p = PickWord($p);
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
