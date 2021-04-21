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
?>