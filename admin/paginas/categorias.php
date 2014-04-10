<?php
   
   $acao = isset($tokens[1]) ? $tokens[1] : "";

   switch ($acao) {

	   	case 'editar':
	   		$id = isset($tokens[2]) ? intval($tokens[2]) : 0;
	   		$query = DB::PegaInstancia()->query("SELECT * FROM categoria where id = {$id} LIMIT 1");

	   		if (!$query->rowCount()) {
	   			flashMessage("warn", "Categoria não encontrada...");
	   			header("Location: " . ROOT . "admin/categorias");
	   			exit;
	   		}

	   		$categoria = $query->fetch(PDO::FETCH_OBJ);

	   		$query = DB::PegaInstancia()->query("SELECT * FROM categoria ORDER BY descricao asc ");

	 		$temp = $query->fetchAll(PDO::FETCH_OBJ);
	 		$categorias = array(null => "Selecione uma categoria");

	 		foreach ($temp as $cat) {
	 			$categorias[$cat->id] = $cat->descricao;
	 		}
	   		
	   		include_once "templates/categoria/editar.php";

	   		break;
	 	case 'adicionar':
	 		$query = DB::PegaInstancia()->query("SELECT * FROM categoria ORDER BY descricao asc ");

	 		$temp = $query->fetchAll(PDO::FETCH_OBJ);
	 		$categorias = array(null => "Selecione uma categoria");

	 		foreach ($temp as $cat) {
	 			$categorias[$cat->id] = $cat->descricao;
	 		}

	   		include_once "templates/categoria/add.php";
	   		break; 
	   	case 'deletar':
	   		$id = isset($tokens[2]) ? intval($tokens[2]) : 0;
	   		DB::PegaInstancia()->query("UPDATE noticia SET categoria = NULL WHERE categoria = {$id}");
	   		DB::PegaInstancia()->query("UPDATE categoria SET categoria_pai = NULL WHERE categoria_pai = {$id}");
	   		$query = DB::PegaInstancia()->query("DELETE FROM categoria where id = {$id}");
	   		if($query->rowCount()){

	   			flashMessage("success","Sucessso ao deletar Categoria");
	   		}
	   		else{
	   			flashMessage("error","Erro ao deletar Categoria");
	   		}

	   		header("Location: " . ROOT . "admin/categorias");
	   		break; 	
	   	default:
	   		$pagina = intval($acao) > 1 ? intval($acao) : 1;

	   		$offset = ($pagina * 20) - 20;
	   		$categorias = DB::PegaInstancia()->query("SELECT * FROM categoria ORDER BY descricao asc LIMIT 20 OFFSET {$offset}")->fetchAll(PDO::FETCH_OBJ);
	   		
	   		$total = DB::PegaInstancia()->query("SELECT count(*) as total FROM categoria LIMIT 1")->fetch(PDO::FETCH_OBJ)->total;
	 		$paginador = new Paginador($total,20,$pagina,ROOT.'admin/categorias/%d');
	 		$paginacao = $paginador->renderiza();

	   		include_once "templates/categoria/listagem.php";
	}
