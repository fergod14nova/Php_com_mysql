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
        <?php include_once "header.php"; ?>

        <h1>Escolha seu jogo</h1>

        <!-- FORM DE PESQUISA -->
            <form action="index.php" method="get" id="busca">
                Ordenar: Nome | Produtora | Nota Alta | Nota Baixa |
                Buscar: <input type="text" name="c" size="10" maxlength="40"/>
                <input type="submit" value="OK"/>
            </form>
        <!-- FORM DE PESQUISA -->

        <table class="listagem">
        <?php
            // fazendo busca no banco de dados
            $query = "SELECT j.cod, j.nome, g.genero, p.produtora, j.capa FROM jogos j JOIN generos g ON j.genero = g.cod JOIN produtoras p ON j.produtora = p.cod";
            /*
                EXPLICANDO O CÓDIGO ACIMA
                Tabelas:
                =================================
                Jogos --> j
                generos --> g
                ================================
                O parâmetro ON é usado para ligar as tabelas. Usamos os apelidos para pegar os campos que queremos selecionar,
                ex: 'j.cod' quer dizer o campo cod da tabela Jogos.

                depois do ON temos 'j.genero = g.cod' --> isso quer dizer que o campo 'genero' da tabela 'jogos' é uma chave estrangeira herdada da tabela 'generos', que fica armazenada no campo 'cod' da tabela..
                
            */

            $busca = $banco->query($query); //query SQL

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
                            echo "<tr><td><img src='$t' class='mini'>";
                            echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                            echo "[$reg->genero]";
                            echo "<br> $reg->produtora";
                            echo "<td>Admin";
                        // os nomes dentro do echo mostrado acima são os campo do banco de dados
                        //no caso são são os campos 'capa' e 'nome'
                    }
                }
            }
        ?>           
        </table>
    </div>

    <!-- FOOTER -->
    <?php 
        include_once "footer.php";
    ?>
</body>
</html>