<?php

namespace DataAccess;

/* Class */
require "/Entities/Usuario.php";
require "/Command/Command.php";

/* Use */
use Entities\Usuario;
use Command\Command;

class UsuarioDataAccess
{
	public function __construct()
	{
	}

	public function Inserir(Usuario $obj)
	{
		$cmd = new Command();
		$cmd->ExecuteInsert($obj);
	}

	public function Alterar(Usuario $obj)
	{
		$cmd = new Command();
		$cmd->ExecuteUpdate($obj);
	}

	public function Excluir(Usuario $obj)
	{
		$cmd = new Command();
		$cmd->ExecuteDelete($obj);
	}

	public function Selecionar(Usuario $obj)
	{
		$cmd = new Command();
		return $cmd->ExecuteSelect($obj);
	}

	public function SelecionarTodos()
	{
		$obj = new Usuario();
		$cmd = new Command();
		return $cmd->ExecuteSelect($obj);
	}
}

?>