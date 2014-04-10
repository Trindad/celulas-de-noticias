<?php

	session_start();
	require_once('lib/bd.php');
	require_once('lib/url.php');
	require_once('lib/html.php');
	require_once('lib/misc.php');
	require_once('lib/paginador.php');

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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <title>Bootbusiness | Give unique title of the page here</title>
    <!-- Bootstrap -->
    <link href="<?php echo ROOT ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="<?php echo ROOT ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="<?php echo ROOT ?>assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo ROOT ?>assets/css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="<?php echo ROOT ?>assets/css/boot-business.css" rel="stylesheet">
    <link href="<?php echo ROOT ?>assets/js/colorbox/example3/colorbox.css" rel="stylesheet">
    <link href="<?php echo ROOT ?>assets/estilos/estilos.css" rel="stylesheet">
  </head>
  <body>
    <!-- Start: HEADER -->
    <header>
      <!-- Start: Navigation wrapper -->
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <a href="<?php echo ROOT ?>" class="brand brand-bootbus">Células de Notícias</a>
            <!-- Below button used for responsive navigation -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Start: Primary navigation -->
            <div class="nav-collapse collapse">        
              <ul class="nav pull-right">
    			<?php
    				//PDO abstrai o acesso aos dados permitindo migrar para outro SGBD
    				$categorias = DB::PegaInstancia()->query("SELECT * FROM categoria WHERE categoria_pai IS NULL")->fetchAll(PDO::FETCH_OBJ);

    				foreach ($categorias as $categoria) {
    				 	$subcategorias = DB::PegaInstancia()->query("SELECT * FROM categoria WHERE categoria_pai = {$categoria->id}")->fetchAll(PDO::FETCH_OBJ);

    				 	if (!empty($subcategorias)) {
    				 		$root = ROOT;

    				 		echo <<<EOD
    				 <li class="dropdown">
		                <a href="{$root}categoria/{$categoria->id}" class="dropdown-toggle" data-toggle="dropdown">{$categoria->descricao}<b class="caret"></b></a>
		                <ul class="dropdown-menu">
EOD;
							foreach ($subcategorias as $subcat) {
								echo "<li><a href='" . ROOT . "categoria/{$subcat->id}'>{$subcat->descricao}</a></li>";
							}

							echo "</ul></li>";
    				 	} else {
    				 		echo "<li><a href='" . ROOT . "categoria/{$categoria->id}'>{$categoria->descricao}</a></li>";
    				 	}

    				} 
    			?>
                <li><a href="<?php echo  ROOT. "login"?> ">Entrar</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- End: Navigation wrapper -->   
    </header>
    <!-- End: HEADER -->
    <!-- Start: MAIN CONTENT -->
    <div class="content container">
	<?php

    	if(file_exists("paginas/{$tokens[0]}.php")){
            require_once "paginas/{$tokens[0]}.php";
    	}
    	else
    	{
    	    require_once "paginas/home.php";
    	
    	}

    ?>
    </div>
    <!-- End: MAIN CONTENT -->
    <!-- Start: FOOTER -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="span3">
            <h4>Redes Sociais</h4>
            <div class="social-icons-row">
              <a href="http://twitter.com"><i class="icon-twitter"></i></a>
              <a href="http://www.facebook.com/"><i class="icon-facebook"></i></a>
              <a href="http://linkedin.com"><i class="icon-linkedin"></i></a>                                         
            </div>
            <div class="social-icons-row">
              <a href="http://plus.google.com"><i class="icon-google-plus"></i></a>              
              <a href="http://github.com"><i class="icon-github"></i></a>       
            </div>

          </div>     
          <div class="span3 offset6">
          	<h3 class='aluna'>Silvana Trindade</h3>
          </div>
        </div>
      </div>
      <hr class="footer-divider">
      <div class="container">
        <p>
          &copy; <?php echo date("Y") ?> &ndash; Células de Noticias.
        </p>
      </div>
    </footer>
    <!-- End: FOOTER -->
    <script type="text/javascript" src="<?php echo ROOT ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT ?>assets/js/boot-business.js"></script>
    <script type="text/javascript" src="<?php echo ROOT ?>assets/js/colorbox/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT ?>assets/js/scripts.js"></script>
    <script type="text/javascript">
		    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		    var disqus_shortname = 'clulasdenotcias'; // required: replace example with your forum shortname
		    var disqus_developer = 1;

		    /* * * DON'T EDIT BELOW THIS LINE * * */
		    (function() {
		        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
		        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		    })();
		</script>
  </body>
</html>