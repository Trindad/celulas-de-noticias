<?php
  require_once "inicializa.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Celulas de Noticias</title>
	<meta charset="utf-8" />

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo ROOT ?>admin/assets/estilos.css" />
</head>
<body>
	<div class='header'>
    
		<div class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="#">Células de Notícias</a>
        <?php if ($logado): ?>
        <ul class="nav">
          <li <?php echo ($tokens[0] == '' ? "class=\"active\"" : '') ?>><a href="<?php echo ROOT . "admin" ?>">Painel</a></li>
          <li <?php echo ($tokens[0] == 'noticias' ? "class=\"active\"" : '') ?>><a href="<?php echo ROOT."admin/noticias"?>">Notícias</a></li>
          <li><a href="<?php echo ROOT."admin/categorias"?>">Categorias</a></li>
          <li><a href="<?php echo ROOT."admin/usuarios"?>">Usuários</a></li>
        </ul>

        <ul class='nav pull-right'>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php echo $_SESSION['login']->nome ?>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="">Editar Conta</a></li>
              <li><a href="<?php echo ROOT . "admin/sair" ?>">Sair</a></li>
            </ul>
          </li>
        </ul>
        <?php endif ?>
      </div>
    </div>
    
	</div>
	<div class='container'>

    <?php showFlashMessage() ?>

    <?php

    	if(file_exists("paginas/{$tokens[0]}.php")){
            require_once "paginas/{$tokens[0]}.php";
    	}
    	else
    	{
    	    require_once "paginas/painel.php";
    	
    	}

    ?>
  </div>

<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/parsley.js/1.1.16/parsley.min.js"></script>
<script src="<?php echo ROOT ?>admin/assets/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo ROOT ?>admin/assets/js/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo ROOT ?>admin/assets/js/parsley/parsley.js"></script>
<script src="<?php echo ROOT ?>admin/assets/js/parsley/i18n/messages.pt_br.js"></script>
<script src="<?php echo ROOT ?>admin/assets/js/scripts.js"></script>
</body>
</html>
