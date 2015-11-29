<?php

namespace SQL;

/* Use */
use Data\Database;
use Exception;

class MontaSQL
{
	private $object   = null;

	public function __construct($object)
	{
		$this->object = $object;
	}

	private function ShowException(Exception $e)
	{
		echo "<b>Error: </b>" . $e->getMessage() . "<br>";
		echo "Ocorreu um erro na linha <b>" . $e->getLine() . "</b> no arquivo <b>" . $e->getFile() . "</b><br>";
		foreach ($e->getTrace() as $key => $value) {
			echo "Ocorreu uma exception na linha <b>" . $value["line"] . "</b> na classe <b>" . $value["class"] . "</b> na função <b>" . $value["function"] . "</b><br>";
		}
	}

	public function GetPKs()
	{
		$obj = $this->object;
		$pk  = Array();
		$tb  = $obj->GetTableName();
		$sql = "";

		$sql  = "SHOW   KEYS\n";
		$sql .= "  FROM $tb\n";
		$sql .= " WHERE Key_Name = 'PRIMARY'";
		$sql = trim($sql);

		$pks = Database::ExecuteQuery($sql);
		$c   = count($pks);

		for ($i = 0; $i < $c; $i++)
		{
			$pk[$i] = $pks[$i]["Column_name"];
		}

		if ($pks == "" || $pks == null)
			throw new Exception("Ocorreu um erro ao tentar buscar PKs da tabela", 404);

		return $pk;
	}
}
?>