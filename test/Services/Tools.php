<?php
header("Content-type: text/html; charset=UTF-8");
require "../DataAccess/UsuarioDataAccess.php";

$usuario = new Usuario();
$usuario->Login = "master";
$da = new UsuarioDataAccess();
$usuario = $da->Selecionar($usuario);

print_r($usuario);

?>