<?php 
	

function identifica_pagina($admin = true){
	$uri = $_SERVER['REQUEST_URI'];
	$tokens = explode('/',$uri);
	array_shift($tokens);
	array_shift($tokens);

	if ($admin) {
		array_shift($tokens); 
	}
	
    return $tokens;
}

function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
