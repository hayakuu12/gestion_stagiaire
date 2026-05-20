<?php
require_once __DIR__ . '/../models/Stagiaire.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../config/helpers.php';

class StagiaireController {
    private Stagiaire $model;
    private Service   $svcModel;

    public function __construct() {
        $this->model    = new Stagiaire();
        $this->svcModel = new Service();
    }

    public function index(): void {
        $stagiaires = $this->model->getAll();
        require __DIR__ . '/../views/stagiaires/index.php';
    }

    public function show(?int $id): void {
        if (!$id || !($stagiaire = $this->model->getById($id))) { $this->redirect('stagiaires'); }
        require __DIR__ . '/../views/stagiaires/show.php';
    }

    public function create(): void {
        $services = $this->svcModel->getAll();
        $errors   = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom'])) $errors[] = 'الاسم مطلوب.';
            if (empty($errors)) {
                $data = $_POST;
                foreach (['doc_demande','doc_assurance','doc_base','doc_rapport'] as $f) {
                    $data[$f] = uploadFile($f, 'stagiaires') ?? null;
                }
                $this->model->create($data);
                $this->redirect('stagiaires&success=1');
            }
        }
        require __DIR__ . '/../views/stagiaires/create.php';
    }

    public function edit(?int $id): void {
        if (!$id || !($stagiaire = $this->model->getById($id))) { $this->redirect('stagiaires'); }
        $services = $this->svcModel->getAll();
        $errors   = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom'])) $errors[] = 'الاسم مطلوب.';
            if (empty($errors)) {
                $this->model->update($id, $_POST);
                foreach (['doc_demande','doc_assurance','doc_base','doc_rapport'] as $f) {
                    $path = uploadFile($f, 'stagiaires');
                    if ($path) $this->model->updateDoc($id, $f, $path);
                }
                $this->redirect('show_stagiaire&id=' . $id . '&success=1');
            }
        }
        require __DIR__ . '/../views/stagiaires/edit.php';
    }

    public function delete(?int $id): void {
        if ($id) $this->model->delete($id);
        $this->redirect('stagiaires');
    }

    private function redirect(string $action): never {
        header('Location: index.php?action=' . $action);
        exit;
    }
}
