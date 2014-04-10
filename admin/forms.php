<?php

require_once "inicializa.php";

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';
    
switch ($acao):

    case 'login':
        $usuario = isset($_POST['usuario'])?$_POST['usuario']:"";
        $senha = isset($_POST['senha'])? sha1($_POST['senha']):"";
         
         if (!$usuario || !$senha) {
            header("Location: " . ROOT . "admin/login");
            exit;
         }
         
         $check = DB::PegaInstancia()->query("SELECT * from usuario where login  LIKE " . DB::PegaInstancia()->quote($usuario) . " AND senha LIKE '{$senha}' LIMIT 1");
         //var_dump($check->fetchAll(PDO::FETCH_OBJ));
         if ($check->rowCount() > 0) {
            $_SESSION['login'] = $check->fetch(PDO::FETCH_OBJ);
            header("Location: " . ROOT . "admin");
            exit;   
         }
         
         flashMessage('error', 'Usuário e/ou senha inválidos!');
         header("Location: " . ROOT . "admin/login");
         exit;
         
        break;

    case 'midia_noticia':

        $video = isset($_POST['video']) ? $_POST['video'] : '';
        $imagemDescr = DB::PegaInstancia()->quote(isset($_POST['descr']) ? $_POST['descr'] : '');
        $noticia_id = intval(isset($_POST['noticia_id']) ? $_POST['noticia_id'] : '');

        $query = parse_url($video);
        if (isset($query['query'])) {
            $query = explode("&", $query['query']);

            $uri = "";
            foreach ($query as $pedaco) {
                if (strpos($pedaco, "v=") !== FALSE) {
                    $uri = explode("=", $pedaco);
                    $uri = DB::PegaInstancia()->quote($uri[1]);
                }
            }

            if ($uri) {
                // salvar url do video em tabela "noticias_videos"
                 $sql = "INSERT INTO noticia_video (noticia_id, uri) VALUES ($noticia_id, $uri)";
                 $query = DB::PegaInstancia()->query($sql);
                if (!$query->rowCount()) {
                    flashMessage("error", "Erro ao cadastrar vídeo...");
                    header("Location: " . ROOT . "admin/noticias/midia/$noticia_id");
                    exit;
                }  
            }    
        }        

        // tratar upload de imagens

        $mimes = array(
            "image/jpeg",
            "image/png",
            "image/gif",
            "image/jpg",
        );

        if (isset($_FILES['img'])  && empty($_FILES['img']['error']) ) {
            
            if(!in_array($_FILES['img']['type'], $mimes)) {
                flashMessage('error',"Não é imagem este arquivo");
            }
            elseif($_FILES['img']['size'] > 2000000){
                flashMessage('error',"Este arquivo ultrapassou seu limite de upload");
            }
            else{
                $nomeArquivo=time() . "_" . $_FILES['img']['name'];
                if ( move_uploaded_file($_FILES['img']['tmp_name'],"../uploads/$nomeArquivo")) {
                   flashMessage('success',"Sucesso em upload de imagem");
                   $sql = "INSERT INTO noticia_imagem (noticia_id,arquivo, descricao) VALUES ($noticia_id, '$nomeArquivo',$imagemDescr)";
                   // var_dump($sql);
                    $query = DB::PegaInstancia()->query($sql);

                    if ($query->rowCount()) {
                        flashMessage("success", "Imagem cadastrada com sucesso!");
                
                    } else {
                        flashMessage("error", "Erro ao cadastrar imagem..."); 
                    }     
                }
                else
                {
                     flashMessage('error',"Erro em upload de imagem");
                }    
            }
        }
        header("Location: ".ROOT."admin/noticias/midia/$noticia_id");
        exit;
        break;

    case 'add_noticia':

        $titulo = DB::PegaInstancia()->quote(isset($_POST['titulo']) ? $_POST['titulo'] : '');
        $texto = DB::PegaInstancia()->quote(isset($_POST['texto']) ? $_POST['texto'] : '');
        $categoria = DB::PegaInstancia()->quote(isset($_POST['categoria']) ? $_POST['categoria'] : '');

        $sql = "INSERT INTO noticia (titulo, texto, categoria, data, autor) VALUES ($titulo, $texto, $categoria, NOW(), NULL)";
        //var_dump($sql);
        $query = DB::PegaInstancia()->query($sql);

        if ($query->rowCount()) {
            flashMessage("success", "Notícia cadastrada com sucesso!");
            header("Location: " . ROOT . "admin/noticias");
            exit;
        } else {
            flashMessage("error", "Erro ao cadastrar notícia...");
            header("Location: " . ROOT . "admin/noticias/add");
            exit;
        }     
        
    
        break;
    case 'editar_noticia':
        
        $titulo = DB::PegaInstancia()->quote(isset($_POST['titulo']) ? $_POST['titulo'] : '');
        $texto = DB::PegaInstancia()->quote(isset($_POST['texto']) ? $_POST['texto'] : '');
        $categoria = DB::PegaInstancia()->quote(isset($_POST['categoria']) ? $_POST['categoria'] : '');
        $id = intval(isset($_POST['id']) ? $_POST['id'] : '');

        $sql = "UPDATE noticia SET titulo = {$titulo}, texto = {$texto}, categoria = {$categoria} WHERE id = {$id} LIMIT 1";

        $query = DB::PegaInstancia()->query($sql);

        if ($query->rowCount()) {
            flashMessage("success", "Notícia alterada com sucesso!");
            header("Location: " . ROOT . "admin/noticias");
            exit;
        } else {
            flashMessage("error", "Erro ao alterar notícia...");
            header("Location: " . ROOT . "admin/noticias/editar/{$id}");
            exit;
        }

        break;

    case 'add_categoria':

        $descricao = DB::PegaInstancia()->quote(isset($_POST['descricao']) ? $_POST['descricao'] : '');
        $categoria = isset($_POST['categoria']) && $_POST['categoria'] ? intval($_POST['categoria']) : "NULL";

        $sql = "INSERT INTO categoria (descricao,categoria_pai) VALUES ($descricao, $categoria)";
        
        $query = DB::PegaInstancia()->query($sql);
        var_dump($sql);
        if ($query->rowCount()) {
            flashMessage("success", "Categoria cadastrada com sucesso!");
            header("Location: " . ROOT . "admin/categorias");
            exit;
        } else {
            flashMessage("error", "Erro ao cadastrar categoria...");
            header("Location: " . ROOT . "admin/categorias/add");
            exit;
        }     
        
    
        break;
    case 'editar_categoria':
        
        $descricao = DB::PegaInstancia()->quote(isset($_POST['descricao']) ? $_POST['descricao'] : '');
        $categoria = isset($_POST['categoria']) ? intval($_POST['categoria']) : "NULL";
        $id = intval(isset($_POST['id']) ? $_POST['id'] : '');

        $sql = "UPDATE categoria SET descricao = {$descricao}" . ($categoria != 0 ? ", categoria_pai = {$categoria}" : ', categoria_pai = NULL') . " WHERE id = {$id} LIMIT 1";

        $query = DB::PegaInstancia()->query($sql);
        var_dump($sql);

        if ($query->rowCount()) {
            flashMessage("success", "Categoria alterada com sucesso!");
            header("Location: " . ROOT . "admin/categorias");
            exit;
        } else {
            flashMessage("error", "Erro ao alterar categoria...");
            header("Location: " . ROOT . "admin/categorias/editar/{$id}");
            exit;
        }
        break;
    case 'add_usuario':

        $nome = DB::PegaInstancia()->quote(isset($_POST['nome']) ? $_POST['nome'] : '');
        $login = DB::PegaInstancia()->quote(isset($_POST['login']) ? $_POST['login'] : '');
        $senha = DB::PegaInstancia()->quote(sha1(isset($_POST['senha']) ? $_POST['senha'] : ''));
        $email = DB::PegaInstancia()->quote(isset($_POST['email']) ? $_POST['email'] : '');
        $sql = "INSERT INTO usuario (login,nome,email,senha) VALUES ($login,$nome,$email,$senha)";
        
        $query = DB::PegaInstancia()->query($sql);
        var_dump(DB::PegaInstancia()->errorinfo());
        if ($query->rowCount()) {
            flashMessage("success", "Usuario cadastrado com sucesso!");
            header("Location: " . ROOT . "admin/usuarios");
            exit;
        } else {
            flashMessage("error", "Erro ao cadastrar usuario...");
            header("Location: " . ROOT . "admin/usuarios/add");
            exit;
        }     
    
        break;
    case 'editar_usuario':
        $nome = DB::PegaInstancia()->quote(isset($_POST['nome']) ? $_POST['nome'] : '');
        $login = DB::PegaInstancia()->quote(isset($_POST['login']) ? $_POST['login'] : '');
        $senha = DB::PegaInstancia()->quote(sha1(isset($_POST['senha']) ? $_POST['senha'] : ''));
        $email = DB::PegaInstancia()->quote(isset($_POST['email']) ? $_POST['email'] : '');
        $id = intval(isset($_POST['id']) ? $_POST['id'] : '');

        $campoSenha = "";

        if (strlen(trim($_POST['senha'])) > 5) {
            $campoSenha = ", senha = $senha";
        }

        $sql = "UPDATE usuario SET nome = {$nome}, login = {$login}, email = {$email} {$campoSenha} WHERE id = {$id} LIMIT 1";

        $query = DB::PegaInstancia()->query($sql);
        
        if ( $query->rowCount() ) {
            flashMessage("success", "Usuario alterado com sucesso!");
            header("Location: " . ROOT . "admin/usuarios");
            exit;
        } else {
            flashMessage("error", "Erro ao alterar usuario...");
            header("Location: " . ROOT . "admin/usuarios/editar/{$id}");
            exit;
        }
        break;
endswitch;    
