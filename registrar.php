<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Ouvidoria CCTIS</title>
</head>
 
<body >
    <!--class="d-flex align-items-center py4 bg-body-tertiary h-100"-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary d-flex flex-row mb-3">
        <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
            <form class="d-flex" role="search" action="php/read_registro.php" method="get">
                
                <a class="btn btn-outline-success" href="index.php">Retornar</a>
            </form>
        </div>
    </nav>
    </br>
    <div class="container ">
        
    
        <div class="containe items-center max-w-3xl mx-auto p-6 lg:p-8">
            
        <div class="flex items-center">
               <h3>Registrar como usuário</h3>
            </div>
                </br>
            <?php

                require_once('conexao.php');

                if ( isset($_POST['email']) && isset($_POST['senha'])){
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $confirm = $_POST['confirm'];

                    if ( $nome == "" || $email == "" || $senha == "" || $confirm == "")
                    {
                        printf('<div class="alert alert-danger" role="alert">Error failed: %s </div>', "Existe dados em branco");
                        exit();
                    }

                    //if( strpos( $email, "@ifpb.edu.br" ) == false) {
                    //    printf('<div class="alert alert-danger" role="alert">Error failed: %s </div>', "O e-mail a ser utilizado deve ser do domínio @ifpb.edu.br");
                    //    exit();
                    //}
                    if ( strcmp($senha, $confirm) <> 0 )
                    {
                        printf('<div class="alert alert-danger" role="alert">Error failed: %s </div>', "Senhas não conicide!");
                        exit();
                    }

                    //Conexao com o banco de dados
                    $conexao = conectar();



                    //Criando URL
                    $query = "REPLACE INTO usuario (nome, email, senha) 
                    VALUES ( '$nome','$email', MD5('$senha'))";
                    //echo $query;
                    //echo "chegou o $gtin, '$descricao', '$data_cadastro', $estoque,$preco";
                    //echo "<br> $query";

                    $result = mysqli_query($conexao, $query); //or die ("Error in query: $query. ".mysqli_error($conexao));


                    if (mysqli_error($conexao)) {
                        printf('<div class="alert alert-danger" role="alert">Erro: %s </div>', mysqli_error($conexao));
                        exit();
                    }else {
                        printf('<div class="alert alert-success" role="alert">Erro: %s </div>', "Seu foi adicionado com sucesso!" );
                        exit();
                    }

                    

                    mysqli_close($conexao);
                }
            
            ?>
        
            <div>
                <form action="" method="post">
                    <input class="form-control me-2" type="text" name="nome" placeholder="Digite seu Nome" aria-label="Entrar">
                    </br> 
                    <input class="form-control me-2" type="email" name="email" placeholder="Digite seu email" aria-label="Entrar"> 
                    </br>
                    <input class="form-control me-2" type="password" name="senha" placeholder="Digite sua senha" aria-label="Entrar">
                    </br>
                    <input class="form-control me-2" type="password" name="confirm" placeholder="Confirme sua senha" aria-label="Entrar">
                    </br>
                    <button type="submit" class="btn btn-primary w-100 py-2">Registrar</button>
        
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>