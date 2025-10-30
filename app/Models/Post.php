<?php
declare(strict_types=1);

namespace App\Models;

use Core\Model;

final class Post extends Model
{
	protected string $table = 'posts';

	/**
	 * @param array{group_id?: int|null, date?: string|null} $filters
	 */
	public function all(array $filters = []): array
	{
		$where = [];
		$types = '';
		$params = [];

		$groupId = isset($filters['group_id']) ? (int) $filters['group_id'] : 0;
		if ($groupId > 0) {
			$where[] = 'g.id = ?';
			$types .= 'i';
			$params[] = $groupId;
		}

		$date = isset($filters['date']) ? trim((string) $filters['date']) : '';
		if ($date !== '') {
			$where[] = 'DATE(p.post_date) = ?';
			$types .= 's';
			$params[] = $date;
		}

		$sql = 'SELECT 
				p.id,
				p.person_base_id,
				p.content,
				p.post_date,
				per.name AS person_name,
				per.surname AS person_surname,
				g.name AS group_name
			FROM posts p
			JOIN persons per 
				ON per.id = (
					SELECT id 
					FROM persons 
					WHERE base_id = p.person_base_id 
					AND valid_from <= p.post_date
					ORDER BY valid_from DESC
					LIMIT 1
				)
			JOIN `groups` g 
				ON g.id = per.group_id
			';

		if ($where) {
			$sql .= ' WHERE ' . implode(' AND ', $where);
		}
		$sql .= ' ORDER BY p.post_date DESC, p.id DESC';

		$stmt = $this->db()->prepare($sql);
		if ($stmt === false) {
		
			throw new \RuntimeException('Prepare failed: ' . $this->db()->error);
		}
		if ($types !== '') {
			$stmt->bind_param($types, ...$params);
		}
		if (!$stmt->execute()) {
			$err = $stmt->error;
			$stmt->close();
			throw new \RuntimeException('Execute failed: ' . $err);
		}
		$res = $stmt->get_result();
		$rows = [];
		while ($row = $res->fetch_assoc()) {
			$rows[] = $row;
		}
		$stmt->close();
		return $rows;
	}

	public function find($id): array
	{
		$sql = 'SELECT 
				p.id,
				p.person_base_id,
				p.content,
				p.post_date,
				per.name AS person_name,
				per.surname AS person_surname,
				g.name AS group_name
			FROM posts p
			JOIN persons per 
				ON per.id = (
					SELECT id 
					FROM persons 
					WHERE base_id = p.person_base_id 
					AND valid_from <= p.post_date
					ORDER BY valid_from DESC
					LIMIT 1
				)
			JOIN `groups` g 
				ON g.id = per.group_id
			 WHERE p.id = ?';		
		$stmt = $this->db()->prepare($sql);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		return $stmt->get_result()->fetch_assoc() ?? [];
	}
}
