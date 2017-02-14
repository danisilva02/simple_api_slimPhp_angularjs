<?php

require 'Slim/Slim.php';
require 'Db.class.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$db = new Db;

session_start();

header("Content-Type: application/json");

$app->get('/testeFirebase', function () use ($app) {
    
$DEFAULT_TODO_PATH = 'https://controle-app.firebaseio.com/clientes';  
  
//$firebase = new Firebase('https://controle-app.firebaseio.com/clientes');
$name = $firebase->get('https://controle-app.firebaseio.com/clientes');
  
echo json_encode(array("teste"=>$name_array));    
    
});

/*$app->get('/getProdutoFrontend(/:idpost)', function ($idpost = NULL) use ($app, $db) {
    
        if($idpost==NULL){
            $where = "";
            $limit = " LIMIT 6";
        } else {
            $where = sprintf(' AND idpost = %s ', $idpost); 
            $limit = "";
        }
    
        
    
        $consulta = $db->con()->prepare("SELECT
                                            idpost,
                                            posttitulo,
                                            postdescricao,
                                            posttexto,
                                            poststatus
                                        FROM
                                            post
                                        WHERE
                                            poststatus = 1
                                        
                                        ".$where."
                                        ORDER BY
                                            postdata DESC,
                                            posttitulo ASC
                                        ".$limit);
        $consulta->execute();
        $produtos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        $produtos_array = array();
        $cont = 0;
        
        foreach($produtos as $not){
            
            $produtos_array[$cont]['post']['dados'] = $not;
            
            $consulta = $db->con()->prepare("SELECT
                                                idimagemPost,
                                                imagemtitulo,
                                                imagemarquivo
                                            FROM
                                                imagemPost
                                            WHERE
                                                post_idpost = :IDPOST
                                            ");
            $consulta->bindParam(':IDPOST', $not['idpost']);
            $consulta->execute();
            $produtos_array[$cont]['post']['imagens'] = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $cont++;
        }
    
        echo json_encode(array("produtos"=>$produtos_array));
        
    }
);*/


$app->get('/listaProdutosHome', function () use ($app, $db) {
            
        $consulta = $db->con()->prepare("SELECT
                                            idpost,
                                            posttitulo,
                                            postdescricao,
                                            posttexto,
                                            imagempost,
                                            poststatus
                                        FROM
                                            post
                                        WHERE
                                            poststatus = 1
                                        ");
        $consulta->execute();
        $postTeste = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("postTeste"=>$postTeste));
        
    }
);

$app->get('/listaTodosArtigos', function () use ($app, $db) {
            
        $consulta = $db->con()->prepare("SELECT
                                            idpost,
                                            posttitulo,
                                            postdescricao,
                                            posttexto,
                                            imagempost,
                                            poststatus
                                        FROM
                                            post
                                        WHERE
                                            poststatus = 1
                                        ");
        $consulta->execute();
        $postTodos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("postTodos"=>$postTodos));
        
    }
);

$app->get('/listaAutorHome', function () use ($app, $db) {
            
        $consulta = $db->con()->prepare("SELECT
                                            idautor,
                                            autornome,
                                            autorcategoria_idautorcategoria
                                        FROM
                                            autor
                                        WHERE
                                            autostatus = 1 AND autorcategoria_idautorcategoria = 1
                                        ");
        $consulta->execute();
        $autor = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("autor"=>$autor));
        
    }
);

$app->get('/listaEventoHome', function () use ($app, $db) {
            
        $consulta = $db->con()->prepare("SELECT
                                            idevento,
                                            eventotitulo,
                                            eventodescricao,
                                            eventodata
                                        FROM
                                            evento
                                        WHERE
                                            eventostatus = 1
                                        ");
        $consulta->execute();
        $evento = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("evento"=>$evento));
        
    }
);

$app->get('/detalhesPost/:idproduto', function ($idproduto) use ($app, $db) {
    
        $idproduto = (int)$idproduto;
            
        $consulta = $db->con()->prepare("SELECT
                                            idpost,
                                            posttitulo,
                                            postdescricao,
                                            posttexto,
                                            imagempost,
                                            poststatus
                                        FROM
                                            post
                                        WHERE
                                            idpost = :IDPRODUTO
                                        ");
        $consulta->bindParam(':IDPRODUTO', $idproduto);
        $consulta->execute();
    
        $produto = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("produto"=>$produto));
        
    }
);

$app->get('/detalhesAutor/:idproduto', function ($idproduto) use ($app, $db) {
    
        $idproduto = (int)$idproduto;
            
        $consulta = $db->con()->prepare("SELECT
                                            idpost,
                                            posttitulo,
                                            postdescricao,
                                            posttexto,
                                            imagempost,
                                            poststatus
                                        FROM
                                            post
                                        WHERE
                                            autor_idautor = :IDPRODUTO
                                        ");
        $consulta->bindParam(':IDPRODUTO', $idproduto);
        $consulta->execute();
    
        $produto = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("produto"=>$produto));
        
    }
);

$app->get('/perfilAutor/:idproduto', function ($idproduto) use ($app, $db) {
    
        $idproduto = (int)$idproduto;
            
        $consulta = $db->con()->prepare("SELECT
                                            idpost,
                                            posttitulo,
                                            postdescricao,
                                            posttexto,
                                            imagempost,
                                            poststatus
                                        FROM
                                            post
                                        WHERE
                                            autor_idautor = :IDPRODUTO
                                        ");
        $consulta->bindParam(':IDPRODUTO', $idproduto);
        $consulta->execute();
    
        $produto = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("produto"=>$produto));
        
    }
);


$app->post(
    '/login',
    function () use ($app) {
        
        $data = json_decode($app->request()->getBody());
        $usuario = (isset($data->usuario)) ? $data->usuario : "";
	    $senha   = (isset($data->senha)) ? $data->senha : "";
        
        if($usuario=="DanielDga3843" && $senha=="123456"){
            
            $_SESSION['logado']=true;
            
            echo json_encode(array("logado"=>true));
        } else {
            echo json_encode(array("logado"=>false));   
        }
        
    }
);

$app->post(
    '/loginSistema',
    function () use ($app) {
        
       $data = json_decode($app->request()->getBody());
       $usuario = (isset($data->usuario)) ? $data->usuario : "";
	   $senha   = (isset($data->senha)) ? $data->senha : "";
        
       $consulta = $db->con()->prepare("SELECT
                                            autorlogin
                                        FROM
                                            autor
                                        WHERE
                                            autorlogin = :USUARIO
                                        ");
        $consulta->bindParam(':USUARIO', $usuario);
        $consulta->execute();
    
        $produto = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("produto"=>$produto));
       
        
        
    }
);

$app->get(
    '/logout',
    function () use ($app) {
        session_destroy();
        header("Location: ../painel/index.php");
        exit;
    }
);



$app->get('/perfilusuario/:idproduto', 'auth', function ($idproduto) use ($app, $db) {
        $idproduto = (string)$idproduto;
    
        $consulta = $db->con()->prepare("SELECT
                                            idautor,
                                            autoremail,
                                            autorlogin,
                                            autornome,
                                            autorsenha,
                                            autortelefone,
                                            autorcategoria_idautorcategoria
                                        FROM
                                            autor
                                        WHERE
                                            autorlogin = :IDPRODUTO                                         
                                        
                                        ");
        $consulta->bindParam(':IDPRODUTO', $idproduto);
        $consulta->execute();
        $produtos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("produto"=>$produtos[0]));
        
    }
);

$app->get('/postusuarioPainel/:idproduto', 'auth', function ($idproduto) use ($app, $db) {
    
        $idproduto = (int)$idproduto;
            
        $consulta = $db->con()->prepare("SELECT
                                            idpost,
                                            posttitulo,
                                            postdescricao,
                                            posttexto,
                                            imagempost,
                                            poststatus
                                        FROM
                                            post
                                        WHERE
                                            autor_idautor = :IDPRODUTO
                                        ");
        $consulta->bindParam(':IDPRODUTO', $idproduto);
        $consulta->execute();
    
        $produto = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("produto"=>$produto));
        
    }
);



function auth(){
    if(isset($_SESSION['logado'])){
        return true;
    } else {
        $app = \Slim\Slim::getInstance();
        echo json_encode(array("loginerror"=>true,"msg"=>"Acesso Negado"));
        $app->stop();
    }
}


$app->run();
