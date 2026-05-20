<?php
require_once __DIR__ . '/../models/Wahda.php';

class WahdaController {
    private Wahda $model;
    public function __construct() { $this->model = new Wahda(); }

    public function create(): void {
        $fId = $this->pdo_talibId();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nom_wahda'])) {
            $this->model->create($_POST);
        }
        $talibId = (int)($_POST['talib_id'] ?? 0);
        header('Location: index.php?action=show_talib&id=' . $talibId);
        exit;
    }

    public function edit(?int $id): void {
        if (!$id || !($wahda = $this->model->getById($id))) {
            header('Location: index.php?action=talib_muwazzaf'); exit;
        }
        $talibId = $wahda['talib_id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header('Location: index.php?action=show_talib&id=' . $talibId); exit;
        }
        require __DIR__ . '/../views/talib_muwazzaf/edit_wahda.php';
    }

    public function delete(?int $id): void {
        $talibId = $id ? $this->model->getTalibIdByWahda($id) : 0;
        if ($id) $this->model->delete($id);
        header('Location: index.php?action=show_talib&id=' . $talibId);
        exit;
    }

    private function pdo_talibId(): int { return 0; }
}
