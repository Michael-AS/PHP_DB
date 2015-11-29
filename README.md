# PHP_DB

Banco de dados orientado ao objeto na linguagem PHP

Esta biblioteca possibilita o uso de objetos no banco de dados, apenas utilizando os métodos de Selecionar, Inserir, Alterar e Excluir fazendo com que seja possível manipular os dados sem o uso de "SQL puro". Ou seja, o usuário da biblioteca apenas precisa passar o objeto como parâmetro e pronto.

No caso do método selecionar, ele precisa que o objeto passado por parâmetro receba o retorno do mesmo.

    $usuario        = new Usuario();
    $usuario->Login = "teste";
    $da             = new UsuarioDataAccess();
    $resultado      = $da->Selecionar($usuario);

Desta forma você recebe uma lista com objetos populados com os dados encontrados no banco de dados ou nulo, caso não encontre.

Nesta nova atualização, não é mais necessário utilizar uma Primary Key para buscar no banco, porém ainda estou estudando uma forma de que seja necessário, mas que o usuário possa buscar com outros critérios de seleção.

Uma alteração também foi o uso de PDO com Factory, necessitando de um *config.ini* para que o banco seja instanciado e utilizado sem problemas.
