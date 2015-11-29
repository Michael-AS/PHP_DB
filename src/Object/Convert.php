<?php

namespace Object;

/* Use */
use Exception;
use ReflectionClass;

class Convert
{
	public function __construct()
	{
	}

	private static function ShowException(Exception $e)
	{
		echo "<b>Error: </b>" . $e->getMessage() . "<br>";
		echo "Ocorreu um erro na linha <b>" . $e->getLine() . "</b> no arquivo <b>" . $e->getFile() . "</b><br>";
		foreach ($e->getTrace() as $key => $value) {
			echo "Ocorreu uma exception na linha <b>" . $value["line"] . "</b> na classe <b>" . $value["class"] . "</b> na função <b>" . $value["function"] . "</b><br>";
		}
	}

	public static function ToObject($arrayObject, $fields, $props, $reflection, $obj)
	{
		try
		{
			$o       = 0;
			$Objects = Array();
			foreach($arrayObject as $index => $valor)
			{
				$i        = 0;
				$objArray = $valor;
				$objeto   = $reflection->newInstance();
				foreach($props as $key => $value)
				{
					$reflection->getProperty($value)->setValue($objeto, $objArray[$fields[$i]]);
					$i++;
				}
				$Objects[$o] = $objeto;
				$o++;
			}
			return $Objects;
		}
		catch(Exception $e)
		{
			self::ShowException($e);
		}
	}
}
?>