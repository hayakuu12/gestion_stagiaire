<?php
require_once __DIR__ . '/../config/database.php';

class Nadwa {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        return $this->pdo->query("
            SELECT n.*,
                   (SELECT COUNT(*) FROM nadwat_participants WHERE nadwa_id=n.id) AS nb_participants
            FROM nadwat n ORDER BY n.date_nadwa DESC
        ")->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM nadwat WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getParticipants(int $nadwaId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM nadwat_participants WHERE nadwa_id=? ORDER BY nom");
        $stmt->execute([$nadwaId]);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO nadwat (sujet, type_nadwa, date_nadwa, lieu) VALUES (?,?,?,?)"
        );
        return $stmt->execute([
            trim($data['sujet']),
            trim($data['type_nadwa'] ?? ''),
            $data['date_nadwa'] ?: null,
            trim($data['lieu']   ?? ''),
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE nadwat SET sujet=?, type_nadwa=?, date_nadwa=?, lieu=? WHERE id=?"
        );
        return $stmt->execute([
            trim($data['sujet']),
            trim($data['type_nadwa'] ?? ''),
            $data['date_nadwa'] ?: null,
            trim($data['lieu']   ?? ''),
            $id,
        ]);
    }

    public function addParticipant(int $nadwaId, string $nom): bool {
        $stmt = $this->pdo->prepare("INSERT INTO nadwat_participants (nadwa_id, nom) VALUES (?,?)");
        return $stmt->execute([$nadwaId, trim($nom)]);
    }

    public function deleteParticipant(int $id): bool {
        return $this->pdo->prepare("DELETE FROM nadwat_participants WHERE id=?")->execute([$id]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM nadwat WHERE id=?")->execute([$id]);
    }
}
