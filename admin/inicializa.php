<?php

session_start();

require_once "../lib/url.php";
require_once "../lib/bd.php";
require_once "../lib/misc.php";
require_once "../lib/html.php";
require_once "../lib/paginador.php";

define("ROOT", "http://localhost/celulas/");

$tokens = identifica_pagina();

$logado = true;
//var_dump($_SESSION);

if (!isset($_SESSION['login']) || !$_SESSION['login']->id) {
	
	if (!in_array($tokens[0], array("forms.php", "login"))) {
		flashMessage("error", "Você precisa estar logado para ver esta página!");
		header("Location: " . ROOT . "admin/login");
		exit;
	}

	$logado = false;
}
