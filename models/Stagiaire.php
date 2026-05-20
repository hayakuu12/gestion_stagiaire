<?php
require_once __DIR__ . '/../config/database.php';

class Stagiaire {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        return $this->pdo->query("
            SELECT s.*, sv.nom_ar AS service_nom
            FROM stagiaires s
            LEFT JOIN services sv ON s.service_id = sv.id
            ORDER BY s.created_at DESC
        ")->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("
            SELECT s.*, sv.nom_ar AS service_nom
            FROM stagiaires s
            LEFT JOIN services sv ON s.service_id = sv.id
            WHERE s.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO stagiaires
                (nom, service_id, specialite, date_debut, date_fin, statut,
                 doc_demande, doc_assurance, doc_base, doc_rapport)
            VALUES (?,?,?,?,?,?,?,?,?,?)
        ");
        return $stmt->execute([
            trim($data['nom']),
            $data['service_id'] ?: null,
            trim($data['specialite'] ?? ''),
            $data['date_debut'] ?: null,
            $data['date_fin']   ?: null,
            $data['statut'] ?? 'actif',
            $data['doc_demande']   ?? null,
            $data['doc_assurance'] ?? null,
            $data['doc_base']      ?? null,
            $data['doc_rapport']   ?? null,
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare("
            UPDATE stagiaires
            SET nom=?, service_id=?, specialite=?, date_debut=?, date_fin=?, statut=?
            WHERE id=?
        ");
        return $stmt->execute([
            trim($data['nom']),
            $data['service_id'] ?: null,
            trim($data['specialite'] ?? ''),
            $data['date_debut'] ?: null,
            $data['date_fin']   ?: null,
            $data['statut'] ?? 'actif',
            $id,
        ]);
    }

    public function updateDoc(int $id, string $field, string $path): bool {
        $allowed = ['doc_demande','doc_assurance','doc_base','doc_rapport'];
        if (!in_array($field, $allowed, true)) return false;
        $stmt = $this->pdo->prepare("UPDATE stagiaires SET {$field}=? WHERE id=?");
        return $stmt->execute([$path, $id]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM stagiaires WHERE id=?")->execute([$id]);
    }
}
