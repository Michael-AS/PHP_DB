<?php

class GerenciadorSQL
{
	public function __construct()
	{
	}

	public static function GetProperties($obj)
	{
		$vars    = get_object_vars($obj);
		$campos  = Array();
		$i       = 0;

		foreach ($vars as $key => $value) {
			if ($key != "PREFIX")
			{
				$campos[$i] = $key;
				$i++;
			}
		}

		return $campos;
	}

	public static function GetFields($obj, $getNull)
	{
		if (isset($obj))
		{
			$prefixo = $obj->GetPrefix();
			$vars    = get_object_vars($obj);
			$campos  = Array();
			$i       = 0;

			if (!$getNull)
			{
				foreach ($vars as $key => $value) {
					if ($key != "PREFIX")
					{
						if (isset($value))
						{
							$campos[$i] = $prefixo . strtolower($key);
							$i++;
						}
					}
				}
			}
			else
			{
				foreach ($vars as $key => $value) {
					if ($key != "PREFIX")
					{
						$campos[$i] = $prefixo . strtolower($key);
						$i++;
					}
				}
			}

			return $campos;
		}
		else
		{
			return null;
		}
	}

	public static function GetValues($obj, $fields, $getNull)
	{
		if (isset($obj))
		{
			$vars   = get_object_vars($obj);
			$values = Array();
			$sql    = Array();
			$i      = 0;

			foreach ($vars as $key => $value) {
				if ($key != "PREFIX")
				{
					$values[$i] = $value;
					$i++;
				}
			}

			$i = 0;

			if (!$getNull)
			{
				foreach ($values as $key => $value) {
					if (isset($value))
					{
						$sql[$i] = Array(
							0 => "'$value'"
						);
						$i++;
					}
				}
			}
			else
			{
				foreach ($values as $key => $value) {
					$sql[$i] = Array(
						0 => "'$value'"
					);
					$i++;
				}
			}

			return $sql;
		}
		else
		{
			return null;
		}
	}
}

?>