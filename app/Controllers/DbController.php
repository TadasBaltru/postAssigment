<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use Core\Database;

final class DbController extends Controller
{
	public function migrate(): string
	{
		$path = __DIR__ . '/../../database/schema.sql';
		if (!is_file($path)) {
			http_response_code(500);
			return 'schema.sql not found';
		}
		$sql = file_get_contents($path);
		if ($sql === false) {
			http_response_code(500);
			return 'Failed to read schema.sql';
		}

		$db = Database::getInstance();
		if (!$db->multi_query($sql)) {
			http_response_code(500);
			return 'Migration error: ' . $db->error;
		}
		// flush remaining results for multi_query
		do {
			if ($res = $db->store_result()) {
				$res->free();
			}
		} while ($db->more_results() && $db->next_result());

		return 'Database migrated successfully';
	}
}




