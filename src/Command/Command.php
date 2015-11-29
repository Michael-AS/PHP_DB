<?php

namespace Command;

/* Class */
require "/Data/Factory.php";
require "/Data/Database.php";
require "/SQL/GerenciadorSQL.php";
require "/SQL/MontaSQL.php";
require "/SQL/MontaSelect.php";
require "/SQL/MontaInsert.php";
require "/SQL/MontaUpdate.php";
require "/SQL/MontaDelete.php";
require "/Object/Convert.php";

/* Use */
use Data\Database;
use SQL\GerenciadorSQL;
use SQL\MontaSQL;
use SQL\MontaSelect;
use SQL\MontaInsert;
use SQL\MontaUpdate;
use SQL\MontaDelete;
use Object\Convert;
use Exception;
use ReflectionClass;

class Command
{
	public function __construct()
	{
	}

	private function ShowException(Exception $e)
	{
		echo "<b>Error: </b>" . $e->getMessage() . "<br>";
		echo "Ocorreu um erro na linha <b>" . $e->getLine() . "</b> no arquivo <b>" . $e->getFile() . "</b><br>";
		foreach ($e->getTrace() as $key => $value) {
			echo "Ocorreu uma exception na linha <b>" . $value["line"] . "</b> na classe <b>" . $value["class"] . "</b> na função <b>" . $value["function"] . "</b><br>";
		}
	}

	public function ExecuteSelect($obj)
	{
		try
		{
			$MontaSelect = new MontaSelect($obj);
			$sql         = $MontaSelect->GetSQL();
			$retorno     = Database::ExecuteQuery($sql);
			$fields      = GerenciadorSQL::GetFields($obj, true);
			$props       = GerenciadorSQL::GetProperties($obj);
			$reflection  = new ReflectionClass($obj);

			return Convert::ToObject($retorno, $fields, $props, $reflection, $obj);
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}

	public function ExecuteInsert($obj)
	{
		try
		{
			$MontaInsert = new MontaInsert($obj);
			$sql         = $MontaSelect->GetSQL();

			Database::ExecuteUpdate($sql);
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}

	public function ExecuteUpdate($obj)
	{
		try
		{
			$MontaUpdate = new MontaUpdate($obj);
			$sql         = $MontaUpdate->GetSQL();

			Database::ExecuteUpdate($sql);
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}

	public function ExecuteDelete($obj)
	{
		try
		{
			$MontaDelete = new MontaDelete($obj);
			$sql         = $MontaDelete->GetSQL();

			Database::ExecuteUpdate($sql);
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}
}
?>