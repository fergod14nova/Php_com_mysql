<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes</title>

    <link rel="stylesheet" href="estilos/estilo.css">
</head>
<body>
    <?php
    // PARTE DE INCLUDES
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
    ?>

    <div id="corpo">
        <?php
            // Puxando o código do jogo
            $c = $_GET['cod'] ?? "Falha ao carregar jogo"; 
            $busca = $banco->query("SELECT * FROM jogos WHERE cod='$c'");
            /*
                A variável C receberá o código que veio via GET pela URL,
                caso não consiga '??' ele receberá "Falha ao carregar jogo"
            */
        ?>
        <h1>Detalhes do Jogo</h1>
        <table class='detalhes'>
            <?php
                if(!$busca) {
                    echo "<tr><td>Busca falhou! Consulte o Erro: $banco->error";
                } else {
                    if($busca->num_rows == 1) {
                        // caso a busca resulte em um resultado igual a 1, os dados do resultado serão colocados dentro de um objeto chamado 'reg'
                        $reg = $busca->fetch_object();

                        // Criando função pra chamar imagem
                        $img = thumb($reg->capa);

                        // Criando tabela para exibir os resultados
                        echo "<tr><td rowspan='3'><img src='$img' class='img_full'>";
                        echo "<td><h2>$reg->nome</h2>";
                        echo "<tr><td>$reg->descricao";
                        echo "<tr><td>Admin";
                    } else {
                        echo "<tr><td>Nenhum Registro Encotrado";
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>