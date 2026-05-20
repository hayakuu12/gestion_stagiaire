<?php
require_once __DIR__ . '/../models/Dars.php';

class DarsController {
    private Dars $model;
    public function __construct() { $this->model = new Dars(); }

    public function create(): void {
        $formationId = (int)($_POST['formation_id'] ?? 0);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nom_dars'])) {
            $this->model->create($_POST);
        }
        header('Location: index.php?action=show_formation_continue&id=' . $formationId);
        exit;
    }

    public function delete(?int $id): void {
        $this->model->delete($id ?? 0);
        $fid = $this->model->lastFormationId;
        header('Location: index.php?action=show_formation_continue&id=' . $fid);
        exit;
    }
}
