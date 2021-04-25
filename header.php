<?php
    echo "<header>";
    echo "<p class='pequeno'>";

    if(empty($_SESSION['user'])){
        echo "<a href='user-login.php'>Entrar</a>";
    } else {
        echo "Olá, <strong>". $_SESSION['nome']."</strong> | Sair";
    }

    echo "</p>";
    echo "</header>";
?>