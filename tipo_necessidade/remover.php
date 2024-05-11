<?php

include_once "../conexao.php";

// Verifica se o ID foi fornecido
if (isset($_GET['id'])) {
    // Pega o ID para remover
    $id = $_GET['id'];

    // Prepara a consulta SQL
    $query = "DELETE FROM tabela WHERE id = ?";

    // Conecta ao banco de dados
    $conexao = conectar();

    // Prepara a declaração
    $stmt = mysqli_prepare($conexao, $query);

    if ($stmt) {
        // Vincula o parâmetro
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Executa a declaração
        if (mysqli_stmt_execute($stmt)) {
            echo "<h2>Registro removido com sucesso</h2>";
            echo '<a href="../admin.php">Retornar para usuários</a>';
        } else {
            echo "Erro ao remover registro: " . mysqli_stmt_error($stmt);
        }

        // Fecha a declaração
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a declaração: " . mysqli_error($conexao);
    }

    // Fecha a conexão
    mysqli_close($conexao);
} else {
    echo "ID não fornecido.";
}

?>