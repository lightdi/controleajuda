<?php

include_once "../conexao.php";

// Verifica se o parâmetro 'id' foi fornecido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Pega o id para autorizar
    $id = $_GET['id'];

    // Verifica se o usuário confirmou a exclusão
    if (isset($_GET['confirm']) && $_GET['confirm'] === '1') {
        // Prepara a consulta SQL utilizando prepared statements
        $query = "DELETE FROM tipo_necessidade WHERE id = ?";

        // Conecta ao banco de dados
        $conexao = conectar();

        // Prepara a declaração
        $stmt = mysqli_prepare($conexao, $query);

        // Verifica se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincula os parâmetros
            mysqli_stmt_bind_param($stmt, "i", $id);

            // Executa a declaração
            if (mysqli_stmt_execute($stmt)) {
                echo '<!DOCTYPE html>
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
                </html>';
                //echo '<a href="../admin.php?abrir=1" class="btn btn-primary">Retornar para usuários</a>';
            } else {
                echo "Erro ao executar a consulta: " . mysqli_stmt_error($stmt);
            }

            // Fecha a declaração
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao preparar a declaração: " . mysqli_error($conexao);
        }

        // Fecha a conexão
        mysqli_close($conexao);
    } else {
        // Exibe o formulário de confirmação
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Exclusão</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Confirmação de Exclusão</h2>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Tem certeza que deseja excluir este usuário?</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="?id=<?php echo $id; ?>&confirm=1" class="btn btn-danger">Sim</a>
                        <a href="../admin.php?abrir=2" class="btn btn-primary">Não</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, caso você precise de funcionalidades do Bootstrap que dependam de JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    }
} else {
    echo "ID não fornecido.";
}
?>