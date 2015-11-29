<?php

namespace SQL;

/* Use */
use Exception;

class MontaDelete
{
	private $object = null;

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

	private function MontaWherePK($num_fields,$fields,$values)
	{
		$sql      = null;
		$montasql = new MontaSQL($this->object);
		$pks      = $montasql->GetPKs();
		$qpk      = count($pks);
		for ($i = 0; $i < $num_fields; $i++)
		{
			if (@$fields[$i] == @$pks[$i])
			{
				if ($i < $num_fields - 1)
					$sql .= " WHERE " . $fields[$i] . " = " . $values[$i][0];
				else if ($i == $num_fields - 1)
					$sql .= "   AND " . $fields[$i] . " = " . $values[$i][0];
				else
					$sql .= "   AND " . $fields[$i] . " = " . $values[$i][0];
			}
		}

		if ($sql == null)
			throw new Exception("PK não informada", 404);

		return $sql;
	}

	public function GetSQL()
	{
		try
		{
			$obj     = $this->object;
			$fields  = GerenciadorSQL::GetFields($obj,true);
			$values  = GerenciadorSQL::GetValues($obj,$fields,true);
			$numf    = count($values);
			$retorno = false;
			$sql     = null;

			$sql    .= "DELETE FROM " . $obj->GetTableName();
			$sql    .= $this->MontaWhere($numf,$fields,$values);
			$sql     = trim($sql);

			return $sql;
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}
}
?>
