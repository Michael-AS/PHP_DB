# PHP_DB

Banco de dados orientado ao objeto na linguagem PHP

Esta biblioteca possibilita o uso de objetos no banco de dados, apenas utilizando os métodos de Selecionar, Inserir, Alterar e Excluir fazendo com que seja possível manipular os dados sem o uso de "SQL puro". Ou seja, o usuário da biblioteca apenas precisa passar o objeto como parâmetro e pronto.

No caso do método selecionar, ele precisa que o objeto passado por parâmetro receba o retorno do mesmo.

    $usuario        = new Usuario();
    $usuario->Login = "teste";
    $da             = new UsuarioDataAccess();
    $resultado      = $da->Selecionar($usuario);

    // Aqui você pode realizar um retorno JSON de apenas 1 objeto
    echo json_encode((array) $resultado);

Desta forma você recebe uma lista com objetos populados com os dados encontrados no banco de dados ou nulo, caso não encontre.

Nesta nova atualização, se o método utilizado for um ExecuteSelectAll, o framework não exigirá que contenha uma Primary Key

    $usuario        = new Usuario();
    $usuario->Login = "teste";
    $da             = new UsuarioDataAccess();
    $resultado      = $da->SelecionarTodos();

    // Aqui você pode realizar um retorno JSON de uma lista de objetos
    echo json_encode((array) $resultado);

Uma alteração também foi o uso de PDO com Factory, necessitando de um *config.ini* para que o banco seja instanciado e utilizado sem problemas.