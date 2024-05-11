<?php

    function conectar()
    {
        //$conexao = mysqli_connect('localhost', 'adsonddsDB2', '!Ifpb123', 'adsonddsDB2');
        $conexao = mysqli_connect('fecitec.com.br', 'fecite28_ajudars', '!controleRS', 'fecite28_controleajudars');
        return $conexao;
    }
?> 