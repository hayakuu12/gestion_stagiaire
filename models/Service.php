<?php
require_once __DIR__ . '/../config/database.php';

class Service {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        return $this->pdo->query("SELECT * FROM services ORDER BY nom_ar")->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM services WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare("INSERT INTO services (nom_ar, nom_fr) VALUES (?,?)");
        return $stmt->execute([trim($data['nom_ar']), trim($data['nom_fr'] ?? '')]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare("UPDATE services SET nom_ar=?, nom_fr=? WHERE id=?");
        return $stmt->execute([trim($data['nom_ar']), trim($data['nom_fr'] ?? ''), $id]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM services WHERE id=?")->execute([$id]);
    }
}
