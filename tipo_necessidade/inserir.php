<?php

include_once "../conexao.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo 'descricao_necessidade' está definido
    if (isset($_POST['descricao_necessidade'])) {
        // Pega a descrição da necessidade
        $descricao = $_POST['descricao_necessidade'];

        // Prepara a consulta SQL
        $query = "INSERT INTO tipo_necessidade (descricao) VALUES (?)";

        // Conecta ao banco de dados
        $conexao = conectar();

        // Prepara a declaração
        $stmt = mysqli_prepare($conexao, $query);

        if ($stmt) {
            // Vincula os parâmetros
            mysqli_stmt_bind_param($stmt, "s", $descricao);

            // Executa a declaração
            if (mysqli_stmt_execute($stmt)) {
                echo "<h2>Necessidade Adicionada</h2>";
                echo '<a href="../admin.php?abrir=2">Retornar para usuários</a>';
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