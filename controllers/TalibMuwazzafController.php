<?php
require_once __DIR__ . '/../models/TalibMuwazzaf.php';
require_once __DIR__ . '/../models/Master.php';

class TalibMuwazzafController {
    private TalibMuwazzaf $model;
    private Master        $masterModel;

    public function __construct() {
        $this->model       = new TalibMuwazzaf();
        $this->masterModel = new Master();
    }

    public function index(): void {
        $talib_list = $this->model->getAll();
        require __DIR__ . '/../views/talib_muwazzaf/index.php';
    }

    public function show(?int $id): void {
        if (!$id || !($talib = $this->model->getById($id))) { $this->r('talib_muwazzaf'); }
        $fusul = $this->model->getFusulWithWahedat($id);
        require __DIR__ . '/../views/talib_muwazzaf/show.php';
    }

    public function create(): void {
        $masters = $this->masterModel->getAll();
        $errors  = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom_complet'])) $errors[] = 'الاسم مطلوب.';
            if (empty($_POST['master_id']))   $errors[] = 'اختر برنامج الماستر.';
            if (empty($errors)) {
                $talibId = $this->model->create($_POST);
                $this->r('show_talib&id=' . $talibId);
            }
        }
        require __DIR__ . '/../views/talib_muwazzaf/create.php';
    }

    public function edit(?int $id): void {
        if (!$id || !($talib = $this->model->getById($id))) { $this->r('talib_muwazzaf'); }
        $masters = $this->masterModel->getAll();
        $errors  = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom_complet'])) $errors[] = 'الاسم مطلوب.';
            if (empty($errors)) { $this->model->update($id, $_POST); $this->r('show_talib&id='.$id); }
        }
        require __DIR__ . '/../views/talib_muwazzaf/edit.php';
    }

    public function delete(?int $id): void {
        if ($id) $this->model->delete($id);
        $this->r('talib_muwazzaf');
    }

    private function r(string $a): never { header('Location: index.php?action='.$a); exit; }
}
