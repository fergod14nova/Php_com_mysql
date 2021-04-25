<?php
        function thumb($arq){
            $caminho = "fotos/$arq";
            if(is_null($arq) || !file_exists($caminho)){
                // is_null que dizer se a variável for null
                // file_exists quer dizer se a variável existe
                return "fotos/indisponivel.png";
            } else{
                return $caminho;
            }
            //arq é o parámetro que será substituido
        }

        function voltar(){
            return "<a href='index.php'><span class='material-icons .md-60 .md-dark'>arrow_back</span>RETORNAR</a>";
        }

        function msg_sucesso($m) {
            $resp = "<div class='sucesso'>
                        <i class='material-icons'>check_circle</i>$m
                    </div>";
            return $resp;
        }

        function msg_aviso($m) {
            $resp = "<div class='aviso'>
                        <i class='material-icons'>info</i>$m
                    </div>";
            return $resp;

        }

        function msg_erro($m) {
            $resp = "<div class='erro'>
                        <i class='material-icons'>error</i>$m
                    </div>";
            return $resp;

        }

?>
