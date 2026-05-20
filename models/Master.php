<?php
require_once __DIR__ . '/../config/database.php';

class Master {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        return $this->pdo->query("
            SELECT m.*,
                   (SELECT COUNT(*) FROM talib_muwazzaf WHERE master_id=m.id) AS nb_talib
            FROM masters m ORDER BY m.annee DESC, m.nom_master
        ")->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM masters WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getTalib(int $masterId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM talib_muwazzaf WHERE master_id=? ORDER BY nom_complet");
        $stmt->execute([$masterId]);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO masters (nom_master, annee, universite, specialite) VALUES (?,?,?,?)"
        );
        return $stmt->execute([
            trim($data['nom_master']),
            trim($data['annee']      ?? ''),
            trim($data['universite'] ?? ''),
            trim($data['specialite'] ?? ''),
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE masters SET nom_master=?, annee=?, universite=?, specialite=? WHERE id=?"
        );
        return $stmt->execute([
            trim($data['nom_master']),
            trim($data['annee']      ?? ''),
            trim($data['universite'] ?? ''),
            trim($data['specialite'] ?? ''),
            $id,
        ]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM masters WHERE id=?")->execute([$id]);
    }
}
