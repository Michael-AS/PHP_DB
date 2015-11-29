<?php

class EstabelecimentoFiscal
{
	private $TABLE  = "adm_estfis";
	private $PREFIX = "est_";

	public $Codigo;
	public $Fantasma;
	public $RSocial;
	public $CNPJ;
	public $IE;

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