<?php
require_once __DIR__ . '/../config/database.php';

class FormationBase {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        return $this->pdo->query("
            SELECT fb.*, e.nom_complet, sv.nom_ar AS service_nom
            FROM formations_base fb
            JOIN employes e ON fb.employe_id = e.id
            LEFT JOIN services sv ON fb.service_id = sv.id
            ORDER BY fb.date_debut DESC
        ")->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("
            SELECT fb.*, e.nom_complet, sv.nom_ar AS service_nom
            FROM formations_base fb
            JOIN employes e ON fb.employe_id = e.id
            LEFT JOIN services sv ON fb.service_id = sv.id
            WHERE fb.id=?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO formations_base (employe_id, service_id, date_debut, date_fin, rapport) VALUES (?,?,?,?,?)"
        );
        return $stmt->execute([
            (int)$data['employe_id'],
            $data['service_id'] ?: null,
            $data['date_debut'] ?: null,
            $data['date_fin']   ?: null,
            $data['rapport']    ?? null,
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE formations_base SET employe_id=?, service_id=?, date_debut=?, date_fin=? WHERE id=?"
        );
        return $stmt->execute([
            (int)$data['employe_id'],
            $data['service_id'] ?: null,
            $data['date_debut'] ?: null,
            $data['date_fin']   ?: null,
            $id,
        ]);
    }

    public function updateRapport(int $id, string $path): bool {
        return $this->pdo->prepare("UPDATE formations_base SET rapport=? WHERE id=?")->execute([$path, $id]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM formations_base WHERE id=?")->execute([$id]);
    }
}
