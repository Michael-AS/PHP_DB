<?php

class Database
{
	private static $conexao = null;

	public function __construct()
	{
	}

	public static function Conectar()
	{
		self::$conexao = mysqli_connect("localhost", "root", "");
	}

	public static function SelectDB($db)
	{
		if (isset(self::$conexao))
			mysqli_select_db(self::$conexao, $db);
	}

	public static function Desconectar()
	{
		if (isset(self::$conexao))
			mysqli_close(self::$conexao);
		self::$conexao = null;
	}

	public static function Executar($sql, $tiposql)
	{
		try
		{
			self::Conectar();
			self::SelectDB("base");
			
			// Set connection var
			$conexao = self::$conexao;

			switch ($tiposql) {
				case 0:  // INSERT
				case 1:  // UPDATE
				case 2:  // DELETE
					mysqli_query($conexao, $sql);
					break;

				case 3:  // SELECT
					$result = Array();
					$query =  mysqli_query($conexao, $sql);
					while ($r = mysqli_fetch_array($query))
					{
						$result[] = $r;
					}
					return $result;
					break;
			}

			self::Desconectar();
		}
		catch (Exception $e)
		{
			throw $e;
			
		}
	}
}

?>