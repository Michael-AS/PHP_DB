<?php

namespace Data;

use Data\Factory;
use PDO;

class Database
{
	private static $conexao = null;

	public function __construct()
	{
	}

	public static function Conectar()
	{
		self::$conexao = Factory::GetConnection();
	}

	public static function Desconectar()
	{
		if (isset(self::$conexao))
			//
		self::$conexao = null;
	}

	public static function ExecuteQuery($sql)
	{
		try
		{
			self::Conectar();
			$db = self::$conexao;

			if ($db == null)
				exit;

			$stmt = $db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			self::Desconectar();

			return $result;
		}
		catch (Exception $e)
		{
			throw $e;
		}
	}

	public static function ExecuteUpdate($sql)
	{
		try
		{
			self::Conectar();

			$db = self::$conexao;

			if ($db == null)
				exit;

			$stmt = $db->prepare($sql);
			$stmt->execute();

			self::Desconectar();
		}
		catch (Exception $e)
		{
			throw $e;
		}
	}
}

?>