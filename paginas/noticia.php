<?php 

$id = isset($tokens[1]) ? intval($tokens[1]) : 0;

$noticia = DB::PegaInstancia()->query("SELECT * FROM noticia WHERE id = {$id}")->fetch(PDO::FETCH_OBJ);

if (!$noticia) {
	
	flashMessage("error", "Notícia não encontrada!");

	header("Location:".ROOT);
	exit;
}
$query = DB::PegaInstancia()->query("
	(SELECT id, 'video' as tipo, uri as arquivo, '' as descricao 
	FROM `noticia_video` where noticia_id = {$noticia->id} ) 

	UNION ALL

	(SELECT id, 'imagem' as tipo, arquivo, descricao
	FROM `noticia_imagem` where noticia_id = {$noticia->id} )

	ORDER BY rand()
");

$midias = $query->fetchAll(PDO::FETCH_OBJ);

require_once("templates/noticia.php");