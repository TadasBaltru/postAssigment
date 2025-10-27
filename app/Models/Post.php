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
			// Expecting YYYY-MM-DD
			$where[] = 'DATE(p.post_date) = ?';
			$types .= 's';
			$params[] = $date;
		}

		$sql = 'SELECT 
			p.id,
			p.title,
			p.content,
			p.post_date,
			per.name AS person_name,
			per.surname AS person_surname,
			g.name AS group_name
		FROM posts p
		INNER JOIN persons per ON per.base_id = p.person_base_id
		INNER JOIN `groups` g ON g.id = per.group_id';

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
}




