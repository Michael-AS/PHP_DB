<?php

namespace Data;

use PDO;
use Exception;

class Factory
{
	private static $host    = "";
	private static $port    = "";
	private static $user    = "";
	private static $pwd     = "";
	private static $db      = "";
	private static $type    = "";
	private static $config  = Array();

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

	private static function LoadConfig()
	{
		chdir(dirname(realpath( __FILE__)));
		self::$config = parse_ini_file("/config.ini");
		if (self::$config != null)
		{
			self::$host = self::$config["host"];
			self::$port = self::$config["port"];
			self::$user = self::$config["login"];
			self::$pwd  = self::$config["password"];
			self::$db   = self::$config["db"];
			self::$type = self::$config["type"];
		}
		chdir(str_replace("Data", "", dirname(realpath( __FILE__))));
	}

	public static function GetConnection()
	{
		self::LoadConfig();
		$host    = self::$host;
		$port    = self::$port;
		$user    = self::$user;
		$pwd     = self::$pwd;
		$db      = self::$db;
		$type    = self::$type;

		try {
			switch ($type) {
				case "mysql":
					$dsn = "mysql:host=$host:$port;dbname=$db";
					return new PDO($dsn, $user, $pwd);
					break;

				case "sqlite":
					$dsn = "sqlite:$host";
					return new PDO($dsn);
					break;

				case "pgsql":
					$dsn = "pgsql:host=$host;dbname=$db";
					return new PDO($dsn, $user, $pwd);
					break;

				case "sqlserver":
				case "mssql":
					$dsn = "dblib:host=$host:$port;dbname=$db";
					return new PDO($dsn, $user, $pwd);
					break;
				
				default:
					$dsn = "$type:host=$host;dbname=$db";
					return new PDO($dsn, $user, $pwd);
					break;
			}
		} catch (Exception $e) {
			throw self::ShowException($e);
		}
	}
}

?>