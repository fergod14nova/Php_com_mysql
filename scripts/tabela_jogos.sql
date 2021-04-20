insert into jogos (cod, nome, genero, produtora, descricao, nota, capa) values 
(1, 'Mario Odissey', 2, 3, 'DESCRIÇÃO AUSENTE POR ENQUANTO.', 9.50, 'mario.png'),
(2, 'Call of Dutty', 1, 5, 'DESCRIÇÃO AUSENTE POR ENQUANTO.', 3.50, 'cod.png'),
(3, 'League of Legends', 1, 2, 'DESCRIÇÃO AUSENTE POR ENQUANTO.', 8.50, 'lol.png');

/*Como fazer Join entre tabelas*/
SELECT * FROM jogos j JOIN generos g ON j.genero = g.cod;

/*Outra maneira, adicionando mais um join*/
SELECT p.produtora, j.nome, g.genero, j.descricao, j.nota FROM jogos j JOIN generos g ON j.genero = g.cod JOIN produtoras p ON j.produtora = p.cod;
/*
Apelido de cada Join:
	p = produtora
	j = jogos
	g = genero
o param. JOIN serve para indicar o apelido do Join,
Ex: JOIN TABELA = APELIDO --> JOIN genero g

o param. ON serve para indicar as chaves estrangeiras
ex: "JOIN produtoras p ON j.produtora = p.cod;" --> a chave estrangeira presente na tabela (jogos) está no campo "produtora" e está ligada a chave
primária da tabela produtora, presente no campo "cod";
*/

