<?php
require_once __DIR__ . '/../models/FormationBase.php';
require_once __DIR__ . '/../models/Employe.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../config/helpers.php';

class FormationBaseController {
    private FormationBase $model;
    private Employe $empModel;
    private Service $svcModel;

    public function __construct() {
        $this->model    = new FormationBase();
        $this->empModel = new Employe();
        $this->svcModel = new Service();
    }

    public function index(): void {
        $formations = $this->model->getAll();
        require __DIR__ . '/../views/formations_base/index.php';
    }

    public function create(): void {
        $employes = $this->empModel->getAll();
        $services = $this->svcModel->getAll();
        $errors   = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['employe_id'])) $errors[] = 'اختر موظفاً.';
            if (empty($errors)) {
                $data = $_POST;
                $data['rapport'] = uploadFile('rapport', 'formations_base');
                $this->model->create($data);
                $this->r('formations_base&success=1');
            }
        }
        require __DIR__ . '/../views/formations_base/create.php';
    }

    public function edit(?int $id): void {
        if (!$id || !($formation = $this->model->getById($id))) { $this->r('formations_base'); }
        $employes = $this->empModel->getAll();
        $services = $this->svcModel->getAll();
        $errors   = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['employe_id'])) $errors[] = 'اختر موظفاً.';
            if (empty($errors)) {
                $this->model->update($id, $_POST);
                $path = uploadFile('rapport', 'formations_base');
                if ($path) $this->model->updateRapport($id, $path);
                $this->r('formations_base&success=1');
            }
        }
        require __DIR__ . '/../views/formations_base/edit.php';
    }

    public function delete(?int $id): void {
        if ($id) $this->model->delete($id);
        $this->r('formations_base');
    }

    private function r(string $a): never { header('Location: index.php?action='.$a); exit; }
}
