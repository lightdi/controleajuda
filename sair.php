<?php
session_start();
unset($_SESSION["loged"]);
header('Location: admin.php');
?>