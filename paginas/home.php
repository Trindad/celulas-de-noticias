<?php 

$query = DB::PegaInstancia()->query("SELECT * FROM noticia ORDER BY data desc LIMIT 5");

$ultimasNoticias = $query->fetchAll(PDO::FETCH_OBJ);


$selecao_noticias = DB::PegaInstancia()->query("SELECT noticia.*,categoria.descricao, categoria.id as id_categoria 
FROM noticia join categoria ON categoria.id = noticia.categoria GROUP BY categoria.id")->fetchAll(PDO::FETCH_OBJ);

require_once "templates/home.php";