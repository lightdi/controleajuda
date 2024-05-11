<?php

include_once "../conexao.php";

// Protege contra SQL Injection
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID inválido";
    exit; // Encerra o script se o ID for inválido
}

// Prepara a consulta SQL utilizando prepared statements
$query = "UPDATE usuario SET admin = NOT admin WHERE id = ?";

// Conecta ao banco de dados
$conexao = conectar();

// Prepara a declaração
$stmt = mysqli_prepare($conexao, $query);

// Vincula os parâmetros
mysqli_stmt_bind_param($stmt, "i", $id);

// Executa a declaração
mysqli_stmt_execute($stmt);

// Fecha a declaração
mysqli_stmt_close($stmt);

// Fecha a conexão
mysqli_close($conexao);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Usuário Alterado</h2>
                    </div>
                    <div class="card-body">
                        <p class="text-center">O status do usuário foi alterado com sucesso.</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="../admin.php?abrir=1" class="btn btn-primary">Retornar para usuários</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, caso você precise de funcionalidades do Bootstrap que dependam de JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>