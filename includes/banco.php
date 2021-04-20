
<?php
    $banco = new mysqli("localhost", "root", "", "bd_games");
    // Conexão com o banco de dados e colocando dentro do objeto 'banco';

    // COLOCANDO O BANCO EM UTF8
    $banco->query("SET NAMES 'utf8'");
    $banco->query("SET character_set_connection=utf8");
    $banco->query("SET character_set_client=utf8");
    $banco->query("SET character_set_result=utf8");

    // testando conexão
    if($banco->connect_errno){
        echo "</P>Encontrei um erro: $banco->errno -->$banco->connect_error</p>";
        die(); //parando a conexão
    }

?>