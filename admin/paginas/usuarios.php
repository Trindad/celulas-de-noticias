<?php
   
   $acao = isset($tokens[1]) ? $tokens[1] : "";

   switch ($acao) {

	   	case 'editar':
	   		$id = isset($tokens[2]) ? intval($tokens[2]) : 0;
	   		$query = DB::PegaInstancia()->query("SELECT * FROM usuario where id = {$id} LIMIT 1");

	   		if (!$query->rowCount()) {
	   			flashMessage("warn", "Usuario não encontrada...");
	   			header("Location: " . ROOT . "admin/usuarios");
	   			exit;
	   		}

	   		$usuario = $query->fetch(PDO::FETCH_OBJ);
	   		
	   		include_once "templates/usuario/editar.php";

	   		break;
	 	case 'adicionar':
	   		include_once "templates/usuario/add.php";
	   		break; 
	   	case 'deletar':
	   		$id = isset($tokens[2]) ? intval($tokens[2]) : 0;
	   		DB::PegaInstancia()->query("UPDATE noticia SET usuario = NULL WHERE usuario = {$id}");
	   		DB::PegaInstancia()->query("UPDATE usuario SET usuario_pai = NULL WHERE usuario_pai = {$id}");
	   		$query = DB::PegaInstancia()->query("DELETE FROM usuario where id = {$id}");
	   		if($query->rowCount()){

	   			flashMessage("success","Sucessso ao deletar Usuario");
	   		}
	   		else{
	   			flashMessage("error","Erro ao deletar Usuario");
	   		}

	   		header("Location: " . ROOT . "admin/usuarios");
	   		break; 	
	   	default:
	 		$pagina = intval($acao) > 1 ? intval($acao) : 1;

	   		$offset = ($pagina * 20) - 20;

	 		$usuarios = DB::PegaInstancia()->query("SELECT * FROM usuario ORDER BY nome asc LIMIT 20 OFFSET {$offset}")->fetchAll(PDO::FETCH_OBJ);
	   		$total = DB::PegaInstancia()->query("SELECT count(*) as total FROM usuario LIMIT 1")->fetch(PDO::FETCH_OBJ)->total;

	 		$paginador = new Paginador($total,20,$pagina,ROOT.'admin/usuarios/%d');
	 		$paginacao = $paginador->renderiza();
	   		include_once "templates/usuario/listagem.php";
	}
