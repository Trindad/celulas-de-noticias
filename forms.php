<?php

session_start();
require_once('lib/bd.php');
require_once('lib/url.php');
require_once('lib/html.php');

$tokens = identifica_pagina(false);
define("ROOT", "http://localhost/celulas/");
$logado = true;

if (!isset($_SESSION['login']) || !$_SESSION['login']->id) {
	
	if (!in_array($tokens[0], array("forms.php", "login"))) {
		flashMessage("error", "Você precisa estar logado para ver esta página!");
		header("Location: " . ROOT . "admin/login");
		exit;
	}

	$logado = false;
}

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';
    
switch ($acao):
	case 'login':
		$usuario = isset($_POST['usuario'])?$_POST['usuario']:"";
        $senha = isset($_POST['senha'])? sha1($_POST['senha']):"";
         
         if (!$usuario || !$senha) {
            header("Location: " . ROOT . "login");
            exit;
         }
         
         $check = DB::PegaInstancia()->query("SELECT * from usuario where login  LIKE " . DB::PegaInstancia()->quote($usuario) . " AND senha LIKE '{$senha}' LIMIT 1");
         //var_dump($check->fetchAll(PDO::FETCH_OBJ));
         if ($check->rowCount() > 0) {
            $_SESSION['login'] = $check->fetch(PDO::FETCH_OBJ);
            header("Location: " . ROOT);
            exit;   
         }
         
         flashMessage('error', 'Usuário e/ou senha inválidos!');
         header("Location: " . ROOT . "login");
         exit;
		break;
endswitch;