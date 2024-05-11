<?php

include_once "../conexao.php";

// Verifica se o parâmetro 'id' foi fornecido
if (isset($_GET['id'])) {
    // Pega o id para autorizar
    $id = $_GET['id'];
    
    // Verifica se o usuário confirmou a exclusão
    if (isset($_GET['confirm']) && $_GET['confirm'] === '1') {
        // Prepara a consulta SQL
        $query = "DELETE FROM usuario WHERE id = $id";

        // Conecta ao banco de dados
        $conexao = conectar();

        // Executa a consulta
        if (mysqli_query($conexao, $query)) {
            echo "<h2>Usuário removido</h2>";
            echo '<a href="../admin.php?abrir=1">Retornar para usuários</a>';
        } else {
            echo "Erro ao executar a consulta: " . mysqli_error($conexao);
        }

        // Fecha a conexão
        mysqli_close($conexao);
    } else {
        // Exibe o formulário de confirmação
        echo "<h2>Tem certeza que deseja excluir este usuário?</h2>";
        echo '<a href="?id=' . $id . '&confirm=1">Sim</a> | <a href="../admin.php?abrir=1">Não</a>';
    }
} else {
    echo "ID não fornecido.";
}
?>