// criando uma query sql e colocando ela em uma variável
            $busca = $banco->query("Select * from jogos");

            // Caso a busca resulte em falha:
            if(!$busca){
                echo "<p>
                        Falha na busca: $banco->error
                    </p>";
            }
            // caso a busca de certo:
            else{
                // '$resultado = $busca->fetch_object();' pegando o resultado da query e inserindo dentro de um objeto chamado 'resultado'


                // usando um looping pra mostrar o resultado da busca
                while ($resultado = $busca->fetch_object()){
                    print_r($resultado);
                }
            }