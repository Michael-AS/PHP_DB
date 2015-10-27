<?php

require"GerenciadorSQL.php"
require"TiposSQL.php";
require"Database.php";

class Command
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

	private function MontaWhere($num_fields,$fields,$values)
	{
		$sql = null;
		$pks = $this->GetPKs();
		$qpk = 0;

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

	private function MontaWherePK($num_fields,$fields,$values)
	{
		$sql = null;
		$pks = $this->GetPKs();
		$qpk = count($pks);
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

	private function MontaUpdate($num_fields,$fields,$values)
	{
		$sql = null;
		$pks = $this->GetPKs();
		for ($i = 0; $i < $num_fields; $i++)
		{
			if (@$fields[$i] != @$pks[$i])
			{
				if ($i < $num_fields - 1)
					$sql .= $fields[$i] . " = " . $values[$i][0] . ", ";
				else if ($i == $num_fields - 1)
					$sql .= "       " . $fields[$i] . " = " . $values[$i][0];
				else
					$sql .= "       " . $fields[$i] . " = " . $values[$i][0] . ", ";
			}
		}

		return $sql;
	}

	private function MontaFieldsInsert($num_fields,$fields)
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

	private function MontaValuesInsert($num_fields,$values)
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

	private function GetPKs()
	{
		$obj = $this->object;
		$pk  = Array();
		$tb  = $obj->GetTableName();
		$sql =null;

		$sql  = "SHOW   KEYS";
		$sql .= "  FROM $tb";
		$sql .= " WHERE Key_Name = 'PRIMARY'";
		$sql = trim($sql);

		$pks = Database::Executar($sql,TiposSQL::SELECT);
		$i   = 0;

		foreach ($pks as $key => $value)
		{
			$pk[$i] = $value[4];
			$i++;
		}

		return $pk;
	}

	public function Select()
	{
		try
		{
			$obj        = $this->object;
			$fields     = GerenciadorSQL::GetFields($obj,false);
			$values     = GerenciadorSQL::GetValues($obj,$fields,false);
			$numf       = count($values);
			$sql        = null;

			$sql       .= "SELECT *";
			$sql       .= "  FROM " . $obj->GetTableName();
			$sql       .= $this->MontaWhere($numf,$fields,$values);
			$sql        = trim($sql);

			$retorno    = Database::Executar($sql,TiposSQL::SELECT);

			$props      = GerenciadorSQL::GetProperties($obj);
			$reflection = new ReflectionClass($obj);
			$i          = 0;

			if (count($retorno) > 1)
			{
				return $retorno;
			}
			else
			{
				foreach($props as $key => $value)
				{
					$reflection->getProperty($value)->setValue($obj,$retorno[0][$i]);
					$i++;
				}
				return $obj;
			}
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}

	public function Insert()
	{
		try
		{
			$obj    = $this->object;
			$fields = GerenciadorSQL::GetFields($obj,true);
			$values = GerenciadorSQL::GetValues($obj,$fields,true);
			$numf   = count($values);
			$sql    = null;

			$sql   .= "INSERT INTO " . $obj->GetTableName();
			$sql   .= "(" . $this->MontaFieldsInsert($numf,$fields) . ")";
			$sql   .= " VALUES ";
			$sql   .= "(" . $this->MontaValuesInsert($numf,$values) . ")";
			$sql    = trim($sql);

			Database::Executar($sql,TiposSQL::INSERT);
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}

	public function Update()
	{
		try
		{
			$obj    = $this->object;
			$fields = GerenciadorSQL::GetFields($obj,true);
			$values = GerenciadorSQL::GetValues($obj,$fields,true);
			$numf   = count($values);
			$sql    = null;

			$sql   .= "UPDATE " . $obj->GetTableName();
			$sql   .= "   SET " . $this->MontaUpdate($numf,$fields,$values);
			$sql   .= $this->MontaWherePK($numf,$fields,$values);
			$sql    = trim($sql);

			Database::Executar($sql,TiposSQL::UPDATE);
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}

	public function Delete()
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

			$retorno = Database::Executar($sql,TiposSQL::DELETE);
		}
		catch(Exception $e)
		{
			$this->ShowException($e);
		}
	}
}
?>
