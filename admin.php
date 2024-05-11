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
                <a class="nav-link active" aria-current="page" href="#">Quem precisa</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Quem doa</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Quem transporta</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Gerenciamento</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
                </li>

        
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

<div class="container">

<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            Controle de Usuários
        </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse <?php echo ($acordeao_aberto == 1) ? 'show' : ''; ?>" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Liberado</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Liberar</th>
                    <th scope="col">Autorizar</th>
                    <th scope="col">Remover</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        //Conexao com o banco de dados
                        $conexao = conectar();
                            
                        //Criando URL
                        $query = "SELECT * FROM usuario";
            
                        $result = mysqli_query($conexao, $query); //or die ("Error in query: $query. ".mysqli_error($conexao));
       
                       
                        if ( mysqli_num_rows($result) == 0)
                        {   
                            printf('<div class="alert alert-danger" role="alert">Erro: %s </div>', "Não foi possível encontrar o registro ou usário e senha não confere!");
            
                        }else{

                            while($linha = mysqli_fetch_array ($result) )
                            {  
                             
                                //Imprimi linha 
                                echo '<tr>
                                <th scope="row">'.$linha['id'].'</th>
                                <td>'.$linha['nome'].'</td>
                                <td>'.$linha['email'].'</td>
                                <td>'.($linha['liberado'] ==1 ? "Sim":"Não") .'</td>
                                <td>'.($linha['admin'] ==1 ? "Sim":"Não").'</td>
                                <td><a class="link-primary" href="usuario_comando/liberar.php?id='.$linha['id'].'">'.($linha['liberado'] ==1 ? "Restringir":"Liberar").'</a></td>
                                <td><a class="link-primary" href="usuario_comando/autorizar.php?id='.$linha['id'].'">'. ($linha['admin'] ==0 ? "Autorizar":"Desautorizar") .'</a></td>
                                <td><a class="link-primary" href="usuario_comando/remover.php?id='.$linha['id'].'">Remover</a></td>
                                </tr>';
                            }
                            
                        }
                        mysqli_close($conexao);

                    ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Cadastor de Necessidade
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse <?php echo ($acordeao_aberto == 2) ? 'show' : ''; ?>" data-bs-parent="#accordionFlushExample">
        <!-- Adicione padding ao formulário -->
        <form class="row p-3 align-items-end" action="tipo_necessidade/inserir.php" method="POST">
            <div class="col">
                <div class="row g-3 align-items-center">
                    <!-- Remova a tag <div> não utilizada -->
                    <div class="mb-3">
                        <label for="descricao_necessidade">Descrição</label>
                        <input name="descricao_necessidade" type="text" class="form-control" id="descricao_necessidade" placeholder="Descrição">
                    </div>
                </div>
            </div>
            <div class="col p-3">
                <!-- Remova a tag </br> não utilizada -->
                <button type="submit" class="btn btn-primary">Inserir</button>
            </div>
        </form>
        <div class="accordion-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Remover</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Conexao com o banco de dados
                    $conexao = conectar();

                    //Criando URL
                    $query = "SELECT * FROM tipo_necessidade";

                    $result = mysqli_query($conexao, $query);

                    // Verifica se há resultados na consulta
                    if (mysqli_num_rows($result) == 0) {
                        // Exibe mensagem de erro caso não haja resultados
                        printf('<div class="alert alert-danger" role="alert">Erro: %s </div>', "Não foi possível encontrar o registro ou usuário e senha não conferem!");
                    } else {
                        while ($linha = mysqli_fetch_array($result)) {
                            //Imprime linha da tabela com os dados do banco
                            echo '<tr>
                                <th scope="row">' . $linha['id'] . '</th>
                                <td>' . $linha['descricao'] . '</td>
                                <td><a class="link-primary" href="tipo_necessidade/alterar.php?id=' . $linha['id'] . '">Alterar</a></td>
                                <td><a class="link-primary" href="tipo_necessidade/remover.php?id=' . $linha['id'] . '">Remover</a></td>
                                </tr>';
                        }
                    }
                    mysqli_close($conexao);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Cadastro de Tipo de Itens
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse <?php echo ($acordeao_aberto == 3) ? 'show' : ''; ?>" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <!-- Adicione padding ao formulário -->
            <form class="row p-3 align-items-end" action="tipo_item/inserir.php" method="POST">
                <div class="col">
                    <div class="row g-3 align-items-center">
                        <!-- Remova a tag <div> não utilizada -->
                        <div class="mb-3">
                            <label for="descricao_item">Descrição</label>
                            <input name="descricao_item" type="text" class="form-control" id="descricao_necessidade" placeholder="Descrição">
                        </div>
                    </div>
                </div>
                <div class="col p-3">
                    <!-- Remova a tag </br> não utilizada -->
                    <button type="submit" class="btn btn-primary">Inserir</button>
                </div>
            </form>
            <div class="accordion-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Descricao</th>
                            <th scope="col">Alterar</th>
                            <th scope="col">Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Conexao com o banco de dados
                        $conexao = conectar();

                        //Criando URL
                        $query = "SELECT * FROM tipo_item";

                        $result = mysqli_query($conexao, $query);

                        // Verifica se há resultados na consulta
                        if (mysqli_num_rows($result) == 0) {
                            // Exibe mensagem de erro caso não haja resultados
                            printf('<div class="alert alert-danger" role="alert">Erro: %s </div>', "Não há itens!");
                        } else {
                            while ($linha = mysqli_fetch_array($result)) {
                                //Imprime linha da tabela com os dados do banco
                                echo '<tr>
                                    <th scope="row">' . $linha['id'] . '</th>
                                    <td>' . $linha['descricao'] . '</td>
                                    <td><a class="link-primary" href="tipo_item/alterar.php?id=' . $linha['id'] . '">Alterar</a></td>
                                    <td><a class="link-primary" href="tipo_item/remover.php?id=' . $linha['id'] . '">Remover</a></td>
                                    </tr>';
                            }
                        }
                        mysqli_close($conexao);
                        ?>
                    </tbody>
                </table>
            </div>                    

        </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
        Cadastro de Cidade
      </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse <?php echo ($acordeao_aberto == 4) ? 'show' : ''; ?>" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <!-- Adicione padding ao formulário -->
            <form class="row p-3 align-items-end" action="cidade/inserir.php" method="POST">
                <div class="col">
                    <div class="row g-3 align-items-center">
                        <!-- Remova a tag <div> não utilizada -->
                        <div class="mb-3">
                            <label for="nome_cidade">Cidade</label>
                            <input name="nome_cidade" type="text" class="form-control" id="nome_cidade" placeholder="Cidade">
                        </div>
                    </div>
                </div>
                <div class="col p-3">
                    <!-- Remova a tag </br> não utilizada -->
                    <button type="submit" class="btn btn-primary">Inserir</button>
                </div>
            </form>
            <div class="accordion-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Descricao</th>
                            <th scope="col">Alterar</th>
                            <th scope="col">Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Conexao com o banco de dados
                        $conexao = conectar();

                        //Criando URL
                        $query = "SELECT * FROM cidade";

                        $result = mysqli_query($conexao, $query);

                        // Verifica se há resultados na consulta
                        if (mysqli_num_rows($result) == 0) {
                            // Exibe mensagem de erro caso não haja resultados
                            printf('<div class="alert alert-danger" role="alert">Erro: %s </div>', "Não há itens!");
                        } else {
                            while ($linha = mysqli_fetch_array($result)) {
                                //Imprime linha da tabela com os dados do banco
                                echo '<tr>
                                    <th scope="row">' . $linha['id'] . '</th>
                                    <td>' . $linha['nome_cidade'] . '</td>
                                    <td><a class="link-primary" href="cidade/alterar.php?id=' . $linha['id'] . '">Alterar</a></td>
                                    <td><a class="link-primary" href="cidade/remover.php?id=' . $linha['id'] . '">Remover</a></td>
                                    </tr>';
                            }
                        }
                        mysqli_close($conexao);
                        ?>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
  </div>
</div>

</div>