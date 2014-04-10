<?php
   
   $acao = isset($tokens[1]) ? $tokens[1] : "";
   switch ($acao) {

   		case "midia":

   			$id = isset($tokens[2]) ? intval($tokens[2]) : 0;
	   		$query = DB::PegaInstancia()->query("SELECT * FROM noticia where id = {$id} LIMIT 1");

	   		if (!$query->rowCount()) {
	   			flashMessage("warn", "Notícia não encontrada...");
	   			header("Location: " . ROOT . "admin/noticias");
	   			exit;
	   		}

	   		$noticia = $query->fetch(PDO::FETCH_OBJ);

	   		$query = DB::PegaInstancia()->query("
	   			(SELECT id, 'video' as tipo, uri as arquivo, '' as descricao 
				FROM `noticia_video` where noticia_id = {$noticia->id}) 

				UNION ALL

				(SELECT id, 'imagem' as tipo, arquivo, descricao
				FROM `noticia_imagem` where noticia_id = {$noticia->id})

	   			ORDER BY rand()
	   		");

	   		$midias = $query->fetchAll(PDO::FETCH_OBJ);

   			require_once 'templates/noticia/midia.php';

   			break;

   		case 'deletar_midia':

   			$id = isset($tokens[2]) ? intval($tokens[2]) : 0;
   			$tipo = isset($tokens[3]) ? $tokens[3] : 0;
   			
   			$midia = DB::PegaInstancia()->query("SELECT * FROM noticia_{$tipo} where id = {$id}")->fetch(PDO::FETCH_OBJ);
   			
   			$delete= DB::PegaInstancia()->query("DELETE FROM noticia_{$tipo} where id = {$id} limit 1");
	   		if($delete->rowCount()){

	   			flashMessage("success","Sucessso ao deletar midia");
	   		}
	   		else{
	   			flashMessage("error","Erro ao deletar midia");
	   		}


	   		header("Location: " . ROOT . "admin/noticias/midia/{$midia->noticia_id}");
	   		break; 	
	   	default:
	   		$noticias = DB::PegaInstancia()->query("SELECT * FROM noticia ORDER BY data desc")->fetchAll(PDO::FETCH_OBJ);
	   		include_once "templates/noticia/listagem.php";

   			break;
	   	case 'editar':
	   		$id = isset($tokens[2]) ? intval($tokens[2]) : 0;
	   		$query = DB::PegaInstancia()->query("SELECT * FROM noticia where id = {$id} LIMIT 1");

	   		if (!$query->rowCount()) {
	   			flashMessage("warn", "Notícia não encontrada...");
	   			header("Location: " . ROOT . "admin/noticias");
	   			exit;
	   		}

	   		$noticia = $query->fetch(PDO::FETCH_OBJ);
	   		$query = DB::PegaInstancia()->query("SELECT * FROM categoria ORDER BY descricao asc ");

	 		$temp = $query->fetchAll(PDO::FETCH_OBJ);
	 		$categorias = array();

	 		foreach ($temp as $categoria) {
	 			$categorias[$categoria->id] = $categoria->descricao;
	 		}
	   		include_once "templates/noticia/editar.php";

	   		break;
	 	case 'adicionar':
	 		$query = DB::PegaInstancia()->query("SELECT * FROM categoria ORDER BY descricao asc ");

	 		$temp = $query->fetchAll(PDO::FETCH_OBJ);
	 		$categorias = array();

	 		foreach ($temp as $categoria) {
	 			$categorias[$categoria->id] = $categoria->descricao;
	 		}
	   		include_once "templates/noticia/add.php";
	   		break; 
	   	case 'deletar':
	   		$id = isset($tokens[2]) ? intval($tokens[2]) : 0;

	   		DB::PegaInstancia()->query("DELETE FROM noticia_imagem WHERE noticia_id = {$id}");
	   		DB::PegaInstancia()->query("DELETE FROM noticia_video WHERE noticia_id = {$id}");

	   		$query = DB::PegaInstancia()->query("DELETE FROM noticia where id = {$id}");
	   		if($query->rowCount()){

	   			flashMessage("success","Sucessso ao deletar notícia");
	   		}
	   		else{
	   			flashMessage("error","Erro ao deletar notícia");
	   		}

	   		header("Location: " . ROOT . "admin/noticias");
	   		break; 	
	   	default:
	   		$pagina = intval($acao) > 1 ? intval($acao) : 1;

	   		$offset = ($pagina * 20) - 20;

	   		$noticias = DB::PegaInstancia()->query("SELECT * FROM noticia ORDER BY data desc LIMIT 20 OFFSET {$offset}")->fetchAll(PDO::FETCH_OBJ);
	 		$total = DB::PegaInstancia()->query("SELECT count(*) as total FROM noticia LIMIT 1")->fetch(PDO::FETCH_OBJ)->total;
	 		
	 		$paginador = new Paginador($total,20,$pagina,ROOT.'admin/noticias/%d');
	 		$paginacao = $paginador->renderiza();

	   		include_once "templates/noticia/listagem.php";
	}
