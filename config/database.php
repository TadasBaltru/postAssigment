<?php
declare(strict_types=1);

return [
	'host' => getenv('DB_HOST') ?: 'db',
	'port' => (int) (getenv('DB_PORT') ?: 3306),
	'database' => getenv('DB_NAME') ?: 'postass',
	'username' => getenv('DB_USER') ?: 'postass',
	'password' => getenv('DB_PASSWORD') ?: 'postass',
	'charset' => 'utf8mb4',
];


