<?php
// CRIANDO VARIÁVEIS DE SESSÃO

session_start(); //iniciando sessão

// ISSET --> Verifica se uma variável foi definida, retorna valor boll
if(!isset($_SESSION['user'])){ //caso a variável de sessão não '!' foi definida, retorne o seguinte:
    $_SESSION['user'] = "";
    $_SESSION['nome'] = "";
    $_SESSION['tipo'] = "";
}





// FUNÇÃO DE CRIPTOGRAFAR UMA SENHA
function cripto($senha) {
    // A variável $C é responsável por guardar a senha criptografada.
    $c = '';
    // Criando laço de enquanto
    for($pos = 0; $pos < strlen($senha); $pos++){
        $letra = ord($senha[$pos]) + 1; //pega a letra na posição atual e avança 1 casa
        $c .= chr($letra); //concatena com o resultado do último bloco
        /**
        * ord --> mostra a posição da letra na tabela de caracteres ex: letra a = 97
        * chr --> é o inverso de ord, mostra a letra de um código ex numero 97 = a
        * o + 3 ali em cima faz com que a posição da letra avança 3 letras
        * ou seja, se a posição 1° for a letra A ela passa a ser a letra B
        * strlen --> é um método usado para contar numero de caracteres presentes em uma variável
        *EX avançado 1 casa: JORGE = KPSHF
         */
    }
    return $c;
}

// FUNÇÃO PARA CRIAR HASH
function gerarHash($senha) {
    $txt = cripto($senha);
    $hash = password_hash($txt, PASSWORD_DEFAULT);
    return $hash;
}


// FUNÇÃO PARA TESTAR SE A HASH E A SENHA SÃO COMPATÍVEIS
function verificarHash($senha, $hash)
{
    $res = password_verify($senha, $hash); // 1 = "confere", vazio = "não confere"
    // teste é a senha criada, em seguida temos a mesma senha em formato de hash
    if ($res == 1) {
        echo "Senha válidada com sucesso!";
    } else {
        echo "Senha não confere";
    }
}




// $teste = 'Jorge';
// echo "SENHA INICIAL --> ".$teste."</br>";
// echo "SENHA CRIPTOGRAFADA --> ".cripto($teste)."</br>";
// echo "SENHA COM HASH --> ".gerarHash($teste)."</br>";

// OPERADOR TERNÁRIO
/**
* ()?"Verdadeiro" : "Falso";
 * só pode ser usado caso o resultado do método usado retorne um valor lógico
 * 
 * ex de como fazer um if ternário
 * echo (1>0)?"Sim 1 é maior do que 0":"Não 0 é maior";
 * 
 * nesse caso o teste se encontra dentro de parênteses
 */



