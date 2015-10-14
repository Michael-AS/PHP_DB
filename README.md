# PHP_DB

Banco de dados orientado ao objeto na linguagem PHP

Esta biblioteca possibilita o uso de objetos no banco de dados, apenas utilizando os métodos de Selecionar, Inserir, Alterar e Excluir fazendo com que seja possível manipular os dados sem o uso de "SQL puro". Ou seja, o usuário da biblioteca apenas precisa passar o objeto como parâmetro e pronto.

No caso do método selecionar, ele precisa que o objeto passado por parâmetro receba o retorno do mesmo.

$usuario = new Usuario();
$usuario->Login = "teste"; // Inserir pelo menos uma PK, senão ele retorna uma Exception
$da = new UsuarioDataAccess();
$usuario = $da->Selecionar($usuario);

Desta forma você recebe o objeto populado com os dados encontrados no banco de dados ou nulo, caso não encontre.
