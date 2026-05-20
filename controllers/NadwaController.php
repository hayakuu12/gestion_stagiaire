<?php
require_once __DIR__ . '/../models/Nadwa.php';

class NadwaController {
    private Nadwa $model;
    public function __construct() { $this->model = new Nadwa(); }

    public function index(): void {
        $nadwat = $this->model->getAll();
        require __DIR__ . '/../views/nadwat/index.php';
    }

    public function show(?int $id): void {
        if (!$id || !($nadwa = $this->model->getById($id))) { $this->r('nadwat'); }
        $participants = $this->model->getParticipants($id);
        require __DIR__ . '/../views/nadwat/show.php';
    }

    public function create(): void {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['sujet'])) $errors[] = 'الموضوع مطلوب.';
            if (empty($errors)) { $this->model->create($_POST); $this->r('nadwat&success=1'); }
        }
        require __DIR__ . '/../views/nadwat/create.php';
    }

    public function edit(?int $id): void {
        if (!$id || !($nadwa = $this->model->getById($id))) { $this->r('nadwat'); }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['sujet'])) $errors[] = 'الموضوع مطلوب.';
            if (empty($errors)) { $this->model->update($id, $_POST); $this->r('nadwat&success=1'); }
        }
        require __DIR__ . '/../views/nadwat/edit.php';
    }

    public function delete(?int $id): void {
        if ($id) $this->model->delete($id);
        $this->r('nadwat');
    }

    public function addParticipant(): void {
        $nadwaId = (int)($_POST['nadwa_id'] ?? 0);
        $nom     = trim($_POST['nom'] ?? '');
        if ($nadwaId && $nom) $this->model->addParticipant($nadwaId, $nom);
        $this->r('show_nadwa&id=' . $nadwaId);
    }

    public function deleteParticipant(?int $id): void {
        $nadwaId = (int)($_GET['nadwa_id'] ?? 0);
        if ($id) $this->model->deleteParticipant($id);
        $this->r('show_nadwa&id=' . $nadwaId);
    }

    private function r(string $a): never { header('Location: index.php?action='.$a); exit; }
}
