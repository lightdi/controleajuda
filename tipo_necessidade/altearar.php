<?php

include_once "../conexao.php";

// Verifica se o ID foi fornecido
if (isset($_GET['id'])) {
    // Pega o ID para alterar
    $id = $_GET['id'];

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o campo 'descricao_necessidade' está definido
        if (isset($_POST['descricao_necessidade'])) {
            // Pega a descrição da necessidade
            $descricao = $_POST['descricao_necessidade'];

            // Prepara a consulta SQL
            $query = "UPDATE tipo_necessidade SET descricao = ? WHERE id = ?";

            // Conecta ao banco de dados
            $conexao = conectar();

            // Prepara a declaração
            $stmt = mysqli_prepare($conexao, $query);

            if ($stmt) {
                // Vincula os parâmetros
                mysqli_stmt_bind_param($stmt, "si", $descricao, $id);

                // Executa a declaração
                if (mysqli_stmt_execute($stmt)) {
                    echo "<h2>Registro alterado com sucesso</h2>";
                    echo '<a href="../admin.php">Retornar para usuários</a>';
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
            echo "Descrição da necessidade não fornecida.";
        }
    } else {
        // Busca os dados atuais do registro
        $conexao = conectar();
        $query = "SELECT descricao FROM tipo_necessidade WHERE id = ?";
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

<!-- Formulário de alteração -->
<form action="" method="post">
    <div class="mb-3">
        <label for="descricao_necessidade" class="form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao_necessidade" name="descricao_necessidade" value="<?php echo htmlspecialchars($descricao); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
</form>

<?php
    }
} else {
    echo "ID não fornecido.";
}
?>