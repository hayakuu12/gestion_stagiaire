<?php
require_once __DIR__ . '/../models/Service.php';

class ServiceController {
    private Service $model;
    public function __construct() { $this->model = new Service(); }

    public function index(): void {
        $services = $this->model->getAll();
        require __DIR__ . '/../views/services/index.php';
    }

    public function create(): void {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom_ar'])) $errors[] = 'اسم المصلحة مطلوب.';
            if (empty($errors)) { $this->model->create($_POST); $this->r('services&success=1'); }
        }
        require __DIR__ . '/../views/services/create.php';
    }

    public function edit(?int $id): void {
        if (!$id || !($service = $this->model->getById($id))) { $this->r('services'); }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom_ar'])) $errors[] = 'اسم المصلحة مطلوب.';
            if (empty($errors)) { $this->model->update($id, $_POST); $this->r('services&success=1'); }
        }
        require __DIR__ . '/../views/services/edit.php';
    }

    public function delete(?int $id): void {
        if ($id) $this->model->delete($id);
        $this->r('services');
    }

    private function r(string $a): never { header('Location: index.php?action='.$a); exit; }
}
