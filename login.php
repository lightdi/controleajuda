<?php // login
        require_once 'conexao.php';
        if ( !isset($_SESSION["loged"]) )
        {
            if ( isset($_POST['email']) && isset($_POST['senha'])){
                $email = $_POST['email'];
                $senha = $_POST['senha'];
    
                //Conexao com o banco de dados
                $conexao = conectar();
                    
                //Criando URL
                $query = "SELECT * FROM usuario WHERE email = '$email' AND senha = MD5('$senha')";
    
                $result = mysqli_query($conexao, $query); //or die ("Error in query: $query. ".mysqli_error($conexao));
                
    
                if ( mysqli_num_rows($result) == 0)
                {   
                    printf('<div class="alert alert-danger" role="alert">Erro: %s </div>', "Não foi possível encontrar o registro ou usário e senha não confere!");
    
                }else{
                    $linha = mysqli_fetch_array ($result);
                    
                    if ($linha['liberado'] == 1){
                        $nome = $linha['nome'];
                        $id = $linha['id'];
                        $loged = true;
    
                        //Session
                        $_SESSION["loged"] = $loged;
                        $_SESSION["nome"] = $nome;
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email; 

                    }else {
                        printf('<div class="alert alert-danger" role="alert">Erro: %s </div>', "O registro do usuário ainda não foi liberado!");
                    }

                  

                    //printf('<div class="alert alert-success" role="alert">Erro: %s </div>', "Registro encontrado");
                }
                mysqli_close($conexao);
            }

        }else {
            //Session
            $loged = $_SESSION["loged"];
            $nome = $_SESSION["nome"];
            $id = $_SESSION["id"];
            $email = $_SESSION["email"]; 

        }

?>