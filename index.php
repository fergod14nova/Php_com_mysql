<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="estilos/estilo.css">
    <title>Estudonauta</title>

</head>

<body>

    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
    ?>
    <div id="corpo">
        <h1>Escolha seu jogo</h1>
        <table class="listagem">

        <?php
            // fazendo busca no banco de dados
            $busca = $banco->query("Select * from jogos order by nota"); //query SQL

            // testando e exibindo resultados
            if(!$busca){
                echo "<script>alert('Erro! $banco->error')</script>";

            } else{
                if ($busca->num_rows == 0) {
                    // numero de linhas afetadas = 0
                    echo "<tr><td>Nenhum registro encontrado</td></td>";
                } else { //exibindo dados caso de certo

                    // criando looping
                    while($reg=$busca->fetch_object()){
                        //a variável 'reg' recebe o resultado da busca

                        // função pro caso da imagem faltar --> presente em funcoes.php
                        $t = thumb($reg->capa);
                        echo "<tr><td><img src='$t' class='mini'><td>$reg->nome<td>Admin";
                        // os nomes dentro do echo mostrado acima são os campo do banco de dados
                        //no caso são são os campos 'capa' e 'nome'
                    }
                }
            }
        ?>           
        </table>
    </div>
</body>
</html>