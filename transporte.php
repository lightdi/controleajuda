<?php
 session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de Ajuda RS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body>
    
    
    <!-- Login Form -->
    <?php 
        require_once 'conexao.php';
        include_once 'login.php';
    ?>

    <!-- Login Form final  -->

    <?php
        // Se houver um parâmetro 'abrir' na URL e corresponder a um dos IDs de acordeão, adiciona a classe 'show' para abrir automaticamente o acordeão
        if(isset($_GET['abrir'])) {
            $acordeao_aberto = $_GET['abrir'];
        } else {
            $acordeao_aberto = ""; // define como vazio se nenhum parâmetro estiver presente
        }
    ?>

    <!--  Inicio NavBar padrão -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">AjudaRS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="pedido.php">Quem precisa</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="doacao.php">Quem doa</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="transporte.php">Quem transporta</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="gerenciamento.php">Gerenciamento</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>

        
            </ul>
            <form class="d-flex" role="search" action="" method="POST">
            <?php
                        if ( isset($loged))
                        {
                            if ($loged) {
                                //echo '<div class="container-fluid">';
                                echo '<a class="navbar-brand" >Usuário: ' . $nome . '</a>';
                                echo '&nbsp;';
                                //echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
                                //echo '<span class="navbar-toggler-icon"></span>';
                                //echo '</button>';
                                
                                //echo '<a class="nav-link active" aria-current="page" href=""><p>Admin</p> </a>';
                                
                                echo '<a class="btn btn btn-danger" href="sair.php">Sair</a>';
                                //echo '</div>';
                            }
                        }else{
                           
                            echo '<input class="form-control me-2" type="email" name="email" placeholder="Digite seu email" aria-label="Entrar">';
                            echo '&nbsp;';
                            echo '<input class="form-control me-2" type="password" name="senha" placeholder="Digite sua senha" aria-label="Entrar">';
                            echo '&nbsp;';
                            echo '<button class="btn btn-outline-success" type="submit">Entrar</button>';
                            echo '&nbsp;';
                            echo '<a class="btn btn-outline-success" href="registrar.php">Registrar</a>';
                            

                        }
                        
                        
                    ?>
            </form>
            </div>
        </div>
    </nav>
    <!--  Termino NavBar padrão -->

</br>

<!-- Sem usuaário logado -->
<?php

    if ( !isset($loged)) {
        echo '<div class="container " >
                <div class="alert alert-danger container-fluid" role="alert">
                    <h4 class="alert-heading">Usuário não logado!</h4>
                    <p>É necessário realizar o login para acessar essa página.</p>
                    <hr>
                    <p>Digite o seu e-mail cadastrado e sua senha e aperte o botão Entrar.</p>
                </div>
            </div>';
        die();
    }



?>

<!-- /.container -->



  </body>

</html>