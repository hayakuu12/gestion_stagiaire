<?php
require_once __DIR__ . '/../models/Employe.php';

class EmployeController {
    private Employe $model;
    public function __construct() { $this->model = new Employe(); }

    public function index(): void {
        $employes = $this->model->getAll();
        require __DIR__ . '/../views/employes/index.php';
    }

    public function create(): void {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom_complet'])) $errors[] = 'الاسم مطلوب.';
            if (empty($errors)) { $this->model->create($_POST); $this->r('employes&success=1'); }
        }
        require __DIR__ . '/../views/employes/create.php';
    }

    public function edit(?int $id): void {
        if (!$id || !($employe = $this->model->getById($id))) { $this->r('employes'); }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom_complet'])) $errors[] = 'الاسم مطلوب.';
            if (empty($errors)) { $this->model->update($id, $_POST); $this->r('employes&success=1'); }
        }
        require __DIR__ . '/../views/employes/edit.php';
    }

    public function delete(?int $id): void {
        if ($id) $this->model->delete($id);
        $this->r('employes');
    }

    private function r(string $a): never { header('Location: index.php?action='.$a); exit; }
}
