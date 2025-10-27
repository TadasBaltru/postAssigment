<?php
declare(strict_types=1);

namespace Core;

use mysqli;

final class Database
{
	private static ?mysqli $instance = null;

	public static function getInstance(): mysqli
	{
		if (self::$instance instanceof mysqli) {
			return self::$instance;
		}

		$config = require __DIR__ . '/../config/database.php';
		$host = (string) ($config['host'] ?? 'localhost');
		$port = (int) ($config['port'] ?? 3306);
		$db = (string) ($config['database'] ?? '');
		$user = (string) ($config['username'] ?? 'root');
		$pass = (string) ($config['password'] ?? '');
		$charset = (string) ($config['charset'] ?? 'utf8mb4');

		$mysqli = @new mysqli($host, $user, $pass, $db, $port);
		if ($mysqli->connect_errno) {
			throw new \RuntimeException('MySQL connection error: ' . $mysqli->connect_error);
		}
		if (!$mysqli->set_charset($charset)) {
			throw new \RuntimeException('MySQL set charset error: ' . $mysqli->error);
		}

		self::$instance = $mysqli;
		return self::$instance;
	}
}


