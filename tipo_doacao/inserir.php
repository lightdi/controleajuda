<?php

include_once "../conexao.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo 'descricao_necessidade' está definido
    if (isset($_POST['descricao_necessidade'])) {
        // Pega a descrição da necessidade
        $descricao = $_POST['descricao_necessidade'];

        // Prepara a consulta SQL utilizando prepared statements
        $query = "INSERT INTO tipo_doacao (descricao) VALUES (?)";

        // Conecta ao banco de dados
        $conexao = conectar();

        // Prepara a declaração
        $stmt = mysqli_prepare($conexao, $query);

        if ($stmt) {
            // Vincula os parâmetros
            mysqli_stmt_bind_param($stmt, "s", $descricao);

            // Executa a declaração
            if (mysqli_stmt_execute($stmt)) {
                // Feito com sucesso, exibe mensagem e botão para retornar
                ?>

                <!DOCTYPE html>
                <html lang="pt">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Necessidade Adicionada</title>
                    <!-- Bootstrap CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body>
                    <div class="container mt-5">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Necessidade Adicionada!</h4>
                            <p>A necessidade foi adicionada com sucesso.</p>
                            <hr>
                            <a href="../admin.php?abrir=2" class="btn btn-primary">Retornar para Necessidade</a>
                        </div>
                    </div>

                    <!-- Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                </body>
                </html>

                <?php
            } else {
                echo "Erro ao adicionar necessidade: " . mysqli_stmt_error($stmt);
            }

            // Fecha a declaração
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao preparar a declaração: " . mysqli_error($conexao);
        }

        // Fecha a conexão
        mysqli_close($conexao);
    } else {
        echo "Descrição da necessidade não fornecida.";
    }
}

?> 