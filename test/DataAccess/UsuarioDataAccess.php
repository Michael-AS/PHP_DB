<?php
require "../Entities/Usuario.php";
require "../Services/Command.php";

class UsuarioDataAccess
{
	public function __construct()
	{
	}

	public function Inserir(Usuario $obj)
	{
		$cmd = new Command($obj);
		$cmd->Insert();
	}

	public function Alterar(Usuario $obj)
	{
		$cmd = new Command($obj);
		$cmd->Update();
	}

	public function Excluir(Usuario $obj)
	{
		$cmd = new Command($obj);
		$cmd->Delete();
	}

	public function Selecionar(Usuario $obj)
	{
		$cmd = new Command($obj);
		return $cmd->Select();
	}

	public function SelecionarTodos()
	{
		$obj = new Usuario();
		$cmd = new Command($obj);
		return $cmd->Select();
	}
}

?>