<?php

namespace Entities;

class Usuario
{
	private $TABLE  = "adm_usu";
	private $PREFIX = "usu_";

	public $Login;
	public $Nome;
	public $Senha;

	public function __construct()
	{
	}

	public function GetPrefix()
	{
		return $this->PREFIX;
	}

	public function GetTableName()
	{
		return $this->TABLE;
	}
}

?>