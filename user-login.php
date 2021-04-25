<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>

    <!-- GOOGLE ÍCONS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <link rel="stylesheet" href="estilos/estilo.css">

    <style>
    /* configuração da TELA de login do usuário */
        div#corpo {
            width: 300px;   
        }

        h1{
            text-align: center;
        }

        table td{
            padding: 5px;
        }
    </style>
</head>
<body>
    <?php
    // PARTE DE INCLUDES
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        require_once "includes/login.php";
    ?>

    <div id="corpo">
        <?php
            // PEGANDO OS DADOS DO USUÁRIO
            $user = $_POST['usuario'] ?? null;
            $senha = $_POST['senha'] ?? null;

            //o sinal de ?? serve pra adicionar valor a uma variável caso ela não tenha recebido.
            /**
             * caso o valor de $user não esteja definido, ele passará a ser null
             * a mesma coisa da senha, se ela não existir, será null
             */

             if(is_null($user) || is_null($senha)){
                 //se o usuário ou a senha for null, irá ser chamado o form abaixo
                 require "user-login-form.php";

             } else{
                 echo "Os dados foram passados";
             }
        ?>
    </div>
</body>
</html>