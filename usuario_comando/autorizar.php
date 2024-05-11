<?php

include_once "../conexao.php";

// Pega o id para autorizar
$id = $_GET['id'];

$query = "UPDATE usuario SET admin = not admin WHERE id =". $id;

$conexao = conectar();

mysqli_query($conexao, $query);

mysqli_close($conexao);

echo "<h2> Usuario alterado </h2>";
echo "</br>";
echo '<a href="../admin.php?abrir=1">Retornar para usuarios</a>';

?>