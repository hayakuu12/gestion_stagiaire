<?php
require_once __DIR__ . '/../config/database.php';

class TalibMuwazzaf {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        return $this->pdo->query("
            SELECT t.*, m.nom_master, m.annee
            FROM talib_muwazzaf t
            JOIN masters m ON t.master_id = m.id
            ORDER BY t.nom_complet
        ")->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("
            SELECT t.*, m.nom_master, m.annee, m.universite
            FROM talib_muwazzaf t
            JOIN masters m ON t.master_id = m.id
            WHERE t.id=?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getFusulWithWahedat(int $talibId): array {
        $stmtF = $this->pdo->prepare("SELECT * FROM fusul WHERE talib_id=? ORDER BY numero_fasl");
        $stmtF->execute([$talibId]);
        $fusul = $stmtF->fetchAll();

        foreach ($fusul as &$f) {
            $stmtW = $this->pdo->prepare("SELECT * FROM wahedat WHERE fasl_id=? ORDER BY id");
            $stmtW->execute([$f['id']]);
            $f['wahedat'] = $stmtW->fetchAll();
        }
        return $fusul;
    }

    public function create(array $data): int {
        $stmt = $this->pdo->prepare(
            "INSERT INTO talib_muwazzaf (master_id, nom_complet, num_matricule, telephone) VALUES (?,?,?,?)"
        );
        $stmt->execute([
            (int)$data['master_id'],
            trim($data['nom_complet']),
            trim($data['num_matricule'] ?? ''),
            trim($data['telephone']     ?? ''),
        ]);
        $talibId = (int)$this->pdo->lastInsertId();

        // Auto-create 4 semesters
        $stmtF = $this->pdo->prepare("INSERT INTO fusul (talib_id, numero_fasl) VALUES (?,?)");
        for ($i = 1; $i <= 4; $i++) {
            $stmtF->execute([$talibId, $i]);
        }
        return $talibId;
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE talib_muwazzaf SET master_id=?, nom_complet=?, num_matricule=?, telephone=? WHERE id=?"
        );
        return $stmt->execute([
            (int)$data['master_id'],
            trim($data['nom_complet']),
            trim($data['num_matricule'] ?? ''),
            trim($data['telephone']     ?? ''),
            $id,
        ]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM talib_muwazzaf WHERE id=?")->execute([$id]);
    }
}
