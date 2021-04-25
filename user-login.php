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
                 $query_verf = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$user' LIMIT 1";
                 $busca = $banco->query($query_verf);
                //  Buscando usuário

                // verificando se encontrou
                if(!$busca){
                    echo msg_erro('Falha ao acessar banco.'); //xiii, deu ruim
                
                    // caso encontre, iremos testar a senha
                } else {
                    if($busca->num_rows >0){ //verificando se a busca retornou resultados
                        $reg = $busca->fetch_object(); //armazena os dados vindos do banco de dados (caso retorne)
                    // verificando se a senha foi encontrada
                        if(testarHash($senha, $reg->senha)){
                            echo msg_sucesso('Logado com sucesso!');

                            // Atibuindo valores para as variáveis de sessão
                            $_SESSION['user'] = $reg->usuario;
                            $_SESSION['nome'] = $reg->nome;
                            $_SESSION['tipo'] = $reg->tipo;

                        } else {
                            echo msg_erro('Senha Inválida'); //senha errada
                        }
                    } else {
                        echo msg_erro('Usuário não encontrado!'); //não controu registros
                    }
                }
             }
             echo voltar();
        ?>
    </div>
</body>
</html>