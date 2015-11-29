<?php

namespace SQL;

/* Use */
use Exception;

class MontaSelect
{
	private $object   = null;

	public function __construct($object)
	{
		$this->object=$object;
	}

	private function ShowException(Exception $e)
	{
		echo "<b>Error: </b>" . $e->getMessage() . "<br>";
		echo "Ocorreu um erro na linha <b>" . $e->getLine() . "</b> no arquivo <b>" . $e->getFile() . "</b><br>";
		foreach ($e->getTrace() as $key => $value) {
			echo "Ocorreu uma exception na linha <b>" . $value["line"] . "</b> na classe <b>" . $value["class"] . "</b> na função <b>" . $value["function"] . "</b><br>";
		}
	}

	private function MontaWhere($num_fields, $fields, $values)
	{
		$sql      = null;
		$montasql = new MontaSQL($this->object);
		$pks      = $montasql->GetPKs();
		$qpk      = 0;

		if ($pks == "" || $pks == null)
			throw new Exception("Ocorreu um erro ao tentar buscar PKs da tabela", 404);

		for ($i = 0; $i < $num_fields; $i++)
		{
			if(@$fields[$i] == @$pks[$i])
			{
				$qpk++;
			}
		}

		if ($qpk == 0)
			throw new Exception("PK não informada", 404);
		

		for ($i = 0; $i < $num_fields; $i++)
		{
			if ($i == 0)
				$sql .= " WHERE " . $fields[$i] . " = " . $values[$i][0];
			else if ($i == $num_fields - 1)
				$sql .= "   AND " . $fields[$i] . " = " . $values[$i][0];
			else
				$sql .= "   AND " . $fields[$i] . " = " . $values[$i][0];
		}

		return $sql;
	}

	public function GetSQL($isList = false)
	{
		try
		{
			$obj        = $this->object;
			$fields     = GerenciadorSQL::GetFields($obj, false);
			$values     = GerenciadorSQL::GetValues($obj, $fields, false);
			$numf       = count($values);
			$sql        = null;

			$sql       .= "SELECT *\n";
			$sql       .= "  FROM " . $obj->GetTableName() . "\n";
			if (!$isList)
				$sql   .= $this->MontaWhere($numf, $fields, $values);
			$sql        = trim($sql);

			return $sql;
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}
}

?>