<?php
require_once __DIR__ . '/../models/FormationContinue.php';

class FormationContinueController {
    private FormationContinue $model;
    public function __construct() { $this->model = new FormationContinue(); }

    public function index(): void {
        $formations = $this->model->getAll();
        require __DIR__ . '/../views/formations_continues/index.php';
    }

    public function show(?int $id): void {
        if (!$id || !($formation = $this->model->getById($id))) { $this->r('formations_continues'); }
        $durus = $this->model->getDurus($id);
        require __DIR__ . '/../views/formations_continues/show.php';
    }

    public function create(): void {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['sujet'])) $errors[] = 'الموضوع مطلوب.';
            if (empty($errors)) { $this->model->create($_POST); $this->r('formations_continues&success=1'); }
        }
        require __DIR__ . '/../views/formations_continues/create.php';
    }

    public function edit(?int $id): void {
        if (!$id || !($formation = $this->model->getById($id))) { $this->r('formations_continues'); }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['sujet'])) $errors[] = 'الموضوع مطلوب.';
            if (empty($errors)) { $this->model->update($id, $_POST); $this->r('formations_continues&success=1'); }
        }
        require __DIR__ . '/../views/formations_continues/edit.php';
    }

    public function delete(?int $id): void {
        if ($id) $this->model->delete($id);
        $this->r('formations_continues');
    }

    private function r(string $a): never { header('Location: index.php?action='.$a); exit; }
}
