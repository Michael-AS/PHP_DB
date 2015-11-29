<?php
header("Content-type: text/html; charset=UTF-8");
require "/DataAccess/UsuarioDataAccess.php";

use DataAccess\UsuarioDataAccess;
use Entities\Usuario;

$usuario = new Usuario();
$usuario->Login = "xadee";
$da = new UsuarioDataAccess();
$lista = $da->Selecionar($usuario);

foreach ($lista as $index => $object) {
	echo "<b>Login: </b>" . $object->Login . "<br>";
	echo "<b>Nome:  </b>" . $object->Nome  . "<br>";
	echo "<b>Senha: </b>" . $object->Senha . "<br>";
	echo "<hr />";
}

?>