<?php
declare(strict_types=1);

namespace App\Models;

use Core\Model;

final class Person extends Model
{
	protected string $table = 'persons';
	
	public function allUnique(): array
	{
		$sql = 'SELECT DISTINCT base_id, name, surname FROM persons';
		$res = $this->db()->query($sql);
		if ($res === false) {
			throw new \RuntimeException('Query failed: ' . $this->db()->error);
		}
		$rows = [];
		while ($row = $res->fetch_assoc()) {
			$rows[] = $row;
		}
		$res->free();
		return $rows;
	}
	public function findByBaseIdAndDate(int $baseId, string $date): array
	{
		$sql = 'SELECT * FROM persons WHERE base_id = ? AND valid_from <= ? ORDER BY valid_from DESC LIMIT 1';
		$stmt = $this->db()->prepare($sql);
		$stmt->bind_param('is', $baseId, $date);
		$stmt->execute();
		$res = $stmt->get_result();
		return $res->fetch_assoc() ?? [];
	}
}




