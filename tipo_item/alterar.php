<?php

include_once "../conexao.php";

// Verifica se o ID foi fornecido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Pega o ID para alterar
    $id = $_GET['id'];

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o campo 'descricao_item' está definido
        if (isset($_POST['descricao_item'])) {
            // Pega a descrição da item
            $descricao = $_POST['descricao_item'];

            // Prepara a consulta SQL utilizando prepared statements
            $query = "UPDATE tipo_item SET descricao = ? WHERE id = ?";

            // Conecta ao banco de dados
            $conexao = conectar();

            // Prepara a declaração
            $stmt = mysqli_prepare($conexao, $query);

            if ($stmt) {
                // Vincula os parâmetros
                mysqli_stmt_bind_param($stmt, "si", $descricao, $id);

                // Executa a declaração
                if (mysqli_stmt_execute($stmt)) {
                    echo '<!DOCTYPE html>
                <html lang="pt">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>item Removido</title>
                    <!-- Bootstrap CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body>
                    <div class="container mt-5">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Item Alterado!</h4>
                            <p>A item foi Alterado com sucesso.</p>
                            <hr>
                            <a href="../admin.php?abrir=3" class="btn btn-primary">Retornar para item</a>
                        </div>
                    </div>

                    <!-- Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                </body>
                </html>';
                } else {
                    echo "Erro ao alterar registro: " . mysqli_stmt_error($stmt);
                }

                // Fecha a declaração
                mysqli_stmt_close($stmt);
            } else {
                echo "Erro ao preparar a declaração: " . mysqli_error($conexao);
            }

            // Fecha a conexão
            mysqli_close($conexao);
        } else {
            echo "Descrição da item não fornecida.";
        }
    } else {
        // Busca os dados atuais do registro
        $conexao = conectar();
        $query = "SELECT descricao FROM tipo_item WHERE id = ?";
        $stmt = mysqli_prepare($conexao, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $descricao);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conexao);
        } else {
            echo "Erro ao preparar a declaração: " . mysqli_error($conexao);
            exit;
        }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Tipo de item</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Alteração de Tipo de item</h2>
                    </div>
                    <div class="card-body">
                        <!-- Formulário de alteração -->
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="descricao_item" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="descricao_item" name="descricao_item" value="<?php echo htmlspecialchars($descricao); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <a href="../admin.php?abrir=3" class="btn btn-secondary">Retornar</a>
                        </form>
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