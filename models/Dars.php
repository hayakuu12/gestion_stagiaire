<?php
require_once __DIR__ . '/../config/database.php';

class Dars {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO durus (formation_id, nom_dars, date_dars, heure) VALUES (?,?,?,?)"
        );
        return $stmt->execute([
            (int)$data['formation_id'],
            trim($data['nom_dars']),
            $data['date_dars'] ?: null,
            trim($data['heure'] ?? ''),
        ]);
    }

    public function delete(int $id): bool {
        // Get formation_id before deleting (for redirect)
        $row = $this->pdo->prepare("SELECT formation_id FROM durus WHERE id=?");
        $row->execute([$id]);
        $this->lastFormationId = (int)($row->fetch()['formation_id'] ?? 0);
        return $this->pdo->prepare("DELETE FROM durus WHERE id=?")->execute([$id]);
    }

    public int $lastFormationId = 0;
}
