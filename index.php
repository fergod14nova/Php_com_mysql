<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE ÍCONS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      

    <link rel="stylesheet" href="estilos/estilo.css">
    <title>Estudonauta</title>

</head>

<body>


    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";


        // RECEBENDO GET DO FORM DE PESQUISA E ATRIBUINDO A VARIÁVEL 'ORDEM'
        $ordem = $_GET['parm'] ?? "nome";

        //RECEBENDO DADOS VINDO DA CAIXA DE PESQUISA
        $chave = $_GET['pesquisar'] ?? ""; 
    ?>
    <div id="corpo">
        <?php include_once "header.php"; ?>

        <h1>Escolha seu jogo</h1>

        <!-- FORM DE PESQUISA -->
            <form action="index.php" method="get" id="busca">
                <!-- ENVIANDO UM PARAMENTRO ATRAVÉS DO GET -->
                Ordenar:
                    <a href="index.php?parm=nome&pesquisar=<?php echo "$chave"; ?>">Nome</a> |
                    <a href="index.php?parm=prod&pesquisar=<?php echo "$chave"; ?>">Produtora</a> |
                    <a href="index.php?parm=n1&pesquisar=<?php echo "$chave"; ?>">Nota Alta</a> |
                    <a href="index.php?parm=n2&pesquisar=<?php echo "$chave"; ?>">Nota Baixa</a> |
                    <!-- 
                        Os links acima irão passar dois parâmetros, o de ordem e o de pesquisa, pra isso usamos o sinal de & para concatenar os dois parametros
                        esses parametros vão passar pra ordem e chave
                     -->
                    <a href="index.php">Mostrar todos |</a>
                Buscar: <input type="text" name="pesquisar" size="10" maxlength="40"/>
                <!-- Esse campo é responsável pela variável Chave -->
                <input type="submit" value="OK"/>
            </form>
        <!-- FORM DE PESQUISA -->

        <table class="listagem">
        <?php
            // fazendo busca no banco de dados
            $query = "SELECT j.cod, j.nome, g.genero, p.produtora, j.capa FROM jogos j JOIN generos g ON j.genero = g.cod JOIN produtoras p ON j.produtora = p.cod ";
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
            // CRIANDO RESPOSTA PARA O FORM DE PESQUISA
            if(!empty($chave)){
                // empty verifica se está vazio, como está acompanhado de NOT! então é SE NÃO ESTIVER VAZIO
                $query .= "WHERE j.nome like '%$chave%' OR p.produtora like '%$chave' OR g.genero like '%$chave' ";

                /**
                 * basicamente está sendo acrescentado a query SQL o comando de pesquisar os nomes dos jogos 'j.nome' onde tenha a palavra
                 * passada pelo input em qualquer lugar, $chave é a variável que armazena o valor digitado pelo usuário
                 * como está sendo usado GET a chave vem pela URL e o form aponta para o próprio index.php
                 * o sinal de % é conhecido como CORINGA ou seja, vai procurar em qualquer lugar do registro.
                 * 
                 *  OR p.produtora like '%$chave%' OR g.generos like '%$chave%' 
                 */
            }

            // CRIANDO FORM DE ORDENAÇÃO DOS RESULTADOS
            // ESTRUTURA DE CASO
            switch ($ordem){
                case "prod":
                    $query .= "ORDER BY p.produtora";
                    break;
                case "n1":
                    $query .= "ORDER BY j.nota DESC";
                    break;
                case "n2":
                    $query .= "ORDER BY j.nota ASC";
                    break;
                default:
                    $query .= "ORDER BY j.nome";
            }
            /**
             * EXPLICANDO O CÓDIGO ACIMA
             * a estrutura de caso vai verificar qual foi o parametro passado para a variável ordem
             * o parametro está sendo passado através de GET
             * o que estiver dentro de GET será usado para escolher a ordem da query SQL
             * o sinal de ponto e igualdade '.=' é usado para concatenar e atribuir, ou seja
             * depois da query digitada acima, será acrescentado ORDER BY e o campo escolhido e passado pelo GET
             * 
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
                            echo "<br>";
                            echo "[$reg->genero] ";
                            echo "$reg->produtora";
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