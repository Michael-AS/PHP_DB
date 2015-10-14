<?php

class CustomClass
{
	private $TABLE  = "";
	private $PREFIX = "";
	
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