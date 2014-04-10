<?php 

$query = DB::PegaInstancia()->query("SELECT * FROM noticia ORDER BY data desc LIMIT 5");

$ultimasNoticias = $query->fetchAll(PDO::FETCH_OBJ);
require_once "templates/home.php";