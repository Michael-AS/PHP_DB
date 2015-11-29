<?php

namespace SQL;

/* Use */
use Exception;

class MontaInsert
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

	private function MontaFieldsInsert($num_fields, $fields)
	{
		$sql = null;
		for ($i = 0; $i < $num_fields; $i++)
		{
			if ($i == $num_fields - 1)
				$sql .= $fields[$i];
			else
				$sql .= $fields[$i] . ", ";
		}

		return $sql;
	}

	private function MontaValuesInsert($num_fields, $values)
	{
		$sql = null;
		for ($i = 0; $i < $num_fields; $i++)
		{
			if ($i == $num_fields - 1)
				$sql .= $values[$i][0];
			else
				$sql .= $values[$i][0] . ", ";
		}

		return $sql;
	}

	public function GetSQL()
	{
		try
		{
			$obj    = $this->object;
			$fields = GerenciadorSQL::GetFields($obj, true);
			$values = GerenciadorSQL::GetValues($obj, $fields, true);
			$numf   = count($values);
			$sql    = null;

			$sql   .= "INSERT INTO " . $obj->GetTableName();
			$sql   .= "(" . $this->MontaFieldsInsert($numf,$fields) . ")";
			$sql   .= " VALUES ";
			$sql   .= "(" . $this->MontaValuesInsert($numf,$values) . ")";
			$sql    = trim($sql);

			return $sql;
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}
}
?>
