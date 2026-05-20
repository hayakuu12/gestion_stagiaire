<?php
require_once __DIR__ . '/../config/database.php';

class Wahda {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT w.*, f.talib_id FROM wahedat w JOIN fusul f ON w.fasl_id=f.id WHERE w.id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare("INSERT INTO wahedat (fasl_id, nom_wahda, nuqta) VALUES (?,?,?)");
        return $stmt->execute([
            (int)$data['fasl_id'],
            trim($data['nom_wahda']),
            $data['nuqta'] !== '' ? $data['nuqta'] : null,
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare("UPDATE wahedat SET nom_wahda=?, nuqta=? WHERE id=?");
        return $stmt->execute([
            trim($data['nom_wahda']),
            $data['nuqta'] !== '' ? $data['nuqta'] : null,
            $id,
        ]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM wahedat WHERE id=?")->execute([$id]);
    }

    public function getTalibIdByWahda(int $id): int {
        $stmt = $this->pdo->prepare("SELECT f.talib_id FROM wahedat w JOIN fusul f ON w.fasl_id=f.id WHERE w.id=?");
        $stmt->execute([$id]);
        return (int)($stmt->fetchColumn() ?? 0);
    }
}
