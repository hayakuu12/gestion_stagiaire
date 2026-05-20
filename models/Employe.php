<?php
require_once __DIR__ . '/../config/database.php';

class Employe {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        return $this->pdo->query("SELECT * FROM employes ORDER BY nom_complet")->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM employes WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO employes (nom_complet, cin, telephone, specialite) VALUES (?,?,?,?)"
        );
        return $stmt->execute([
            trim($data['nom_complet']),
            trim($data['cin']       ?? ''),
            trim($data['telephone'] ?? ''),
            trim($data['specialite']?? ''),
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE employes SET nom_complet=?, cin=?, telephone=?, specialite=? WHERE id=?"
        );
        return $stmt->execute([
            trim($data['nom_complet']),
            trim($data['cin']       ?? ''),
            trim($data['telephone'] ?? ''),
            trim($data['specialite']?? ''),
            $id,
        ]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM employes WHERE id=?")->execute([$id]);
    }
}
