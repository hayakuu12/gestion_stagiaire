<?php
require_once __DIR__ . '/../config/database.php';

class FormationContinue {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        return $this->pdo->query("
            SELECT fc.*,
                   (SELECT COUNT(DISTINCT date_dars) FROM durus WHERE formation_id=fc.id) AS nb_jours
            FROM formations_continues fc ORDER BY fc.date_debut DESC
        ")->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM formations_continues WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getDurus(int $formationId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM durus WHERE formation_id=? ORDER BY date_dars, heure");
        $stmt->execute([$formationId]);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO formations_continues (sujet, lieu, date_debut) VALUES (?,?,?)"
        );
        return $stmt->execute([
            trim($data['sujet']),
            trim($data['lieu']      ?? ''),
            $data['date_debut'] ?: null,
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE formations_continues SET sujet=?, lieu=?, date_debut=? WHERE id=?"
        );
        return $stmt->execute([
            trim($data['sujet']),
            trim($data['lieu']      ?? ''),
            $data['date_debut'] ?: null,
            $id,
        ]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM formations_continues WHERE id=?")->execute([$id]);
    }

    public function getLastInsertId(): int {
        return (int)$this->pdo->lastInsertId();
    }
}
