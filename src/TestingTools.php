<?php

$Login = @$_GET["Login"];

header("Content-type: text/html; charset=UTF-8");
require "/DataAccess/UsuarioDataAccess.php";

use DataAccess\UsuarioDataAccess;
use Entities\Usuario;

$usuario        = new Usuario();
$usuario->Login = $Login;
$da             = new UsuarioDataAccess();
$retorno        = $da->Selecionar($usuario);

if (!$retorno == null) {
	echo json_encode((array) $retorno);
}

?>