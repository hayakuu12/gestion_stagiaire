<?php
require_once __DIR__ . '/../models/Master.php';

class MasterController {
    private Master $model;
    public function __construct() { $this->model = new Master(); }

    public function index(): void {
        $masters = $this->model->getAll();
        require __DIR__ . '/../views/masters/index.php';
    }

    public function show(?int $id): void {
        if (!$id || !($master = $this->model->getById($id))) { $this->r('masters'); }
        $talib_list = $this->model->getTalib($id);
        require __DIR__ . '/../views/masters/show.php';
    }

    public function create(): void {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom_master'])) $errors[] = 'اسم الماستر مطلوب.';
            if (empty($errors)) { $this->model->create($_POST); $this->r('masters&success=1'); }
        }
        require __DIR__ . '/../views/masters/create.php';
    }

    public function edit(?int $id): void {
        if (!$id || !($master = $this->model->getById($id))) { $this->r('masters'); }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom_master'])) $errors[] = 'اسم الماستر مطلوب.';
            if (empty($errors)) { $this->model->update($id, $_POST); $this->r('masters&success=1'); }
        }
        require __DIR__ . '/../views/masters/edit.php';
    }

    public function delete(?int $id): void {
        if ($id) $this->model->delete($id);
        $this->r('masters');
    }

    private function r(string $a): never { header('Location: index.php?action='.$a); exit; }
}
