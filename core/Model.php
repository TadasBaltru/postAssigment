<?php

declare(strict_types=1);

namespace Core;

use mysqli;

abstract class Model
{
    protected string $table;

    protected function db(): mysqli
    {
        return Database::getInstance();
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE `id` = ? LIMIT 1";
        $stmt = $this->db()->prepare($sql);
        if ($stmt === false) {
            throw new \RuntimeException('Prepare failed: ' . $this->db()->error);
        }
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new \RuntimeException('Execute failed: ' . $stmt->error);
        }
        $res = $stmt->get_result();
        $row = $res ? $res->fetch_assoc() : null;
        $stmt->close();
        return $row ?: null;
    }

    public function all(): array
    {
        $sql = "SELECT * FROM `{$this->table}`";
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

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `{$this->table}` WHERE `id` = ?";
        $stmt = $this->db()->prepare($sql);
        if ($stmt === false) {
            throw new \RuntimeException('Prepare failed: ' . $this->db()->error);
        }
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        if (!$ok) {
            throw new \RuntimeException('Execute failed: ' . $stmt->error);
        }
        $affected = $stmt->affected_rows;
        $stmt->close();
        return $affected > 0;
    }

    public function insert(array $data): int
    {
        if ($data === []) {
            throw new \InvalidArgumentException('insert(): $data cannot be empty');
        }
        $columns = array_keys($data);
        $placeholders = rtrim(str_repeat('?,', count($columns)), ',');
        $colsEsc = array_map(fn(string $c) => '`' . $c . '`', $columns);
        $sql = 'INSERT INTO `' . $this->table . '` (' . implode(',', $colsEsc) . ') VALUES (' . $placeholders . ')';
        $stmt = $this->db()->prepare($sql);
        if ($stmt === false) {
            throw new \RuntimeException('Prepare failed: ' . $this->db()->error);
        }
        [$types, $values] = $this->buildParamTypesAndValues($data);
        $stmt->bind_param($types, ...$values);
        if (!$stmt->execute()) {
            throw new \RuntimeException('Execute failed: ' . $stmt->error);
        }
        $id = $stmt->insert_id;
        $stmt->close();
        return $id;
    }

    public function update(int $id, array $data): bool
    {
        if ($data === []) {
            throw new \InvalidArgumentException('update(): $data cannot be empty');
        }
        $assignments = [];
        foreach (array_keys($data) as $col) {
            $assignments[] = '`' . $col . '` = ?';
        }
        $sql = 'UPDATE `' . $this->table . '` SET ' . implode(', ', $assignments) . ' WHERE `id` = ?';
        $stmt = $this->db()->prepare($sql);
        if ($stmt === false) {
            throw new \RuntimeException('Prepare failed: ' . $this->db()->error);
        }
        [$types, $values] = $this->buildParamTypesAndValues($data);
        $types .= 'i';
        $values[] = $id;
        $stmt->bind_param($types, ...$values);
        $ok = $stmt->execute();
        if (!$ok) {
            throw new \RuntimeException('Execute failed: ' . $stmt->error);
        }
        $affected = $stmt->affected_rows;
        $stmt->close();
        return $affected > 0;
    }

    /**
     * @param array<string, mixed> $data
     * @return array{0: string, 1: array<int, mixed>}
     */
    private function buildParamTypesAndValues(array $data): array
    {
        $types = '';
        $values = [];
        foreach ($data as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } elseif (is_null($value)) {
                $types .= 's';
                $value = null;
            } else {
                $types .= 's';
                $value = (string) $value;
            }
            $values[] = $value;
        }
        return [$types, $values];
    }
}
