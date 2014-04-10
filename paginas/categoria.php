<?php 

$id = isset($tokens[1]) ? intval($tokens[1]) : 0;

$pagina = isset($tokens[2]) ? intval($tokens[2]) : 1;

$offset = ($pagina * 20) - 20;

$query = DB::PegaInstancia()->query("SELECT * FROM noticia WHERE noticia.categoria = {$id} ORDER BY data desc  LIMIT 20 OFFSET {$offset}");

$noticias = $query->fetchAll(PDO::FETCH_OBJ);

$total = DB::PegaInstancia()->query("SELECT count(*) as total FROM noticia WHERE noticia.categoria = {$id} LIMIT 1")->fetch(PDO::FETCH_OBJ)->total;
$paginador = new Paginador($total,20,$pagina,ROOT."categoria/{$id}/%d");
$paginacao = $paginador->renderiza();

$mes = array(1 => "JAN","FEV","MAR","ABR","MAI","JUN","JUL","AGO","SET","OUT","NOV","DEZ");

require_once "templates/categoria.php";