<?php
require_once __DIR__ . '/controllers/StagiaireController.php';
require_once __DIR__ . '/controllers/ServiceController.php';
require_once __DIR__ . '/controllers/EmployeController.php';
require_once __DIR__ . '/controllers/FormationBaseController.php';
require_once __DIR__ . '/controllers/NadwaController.php';
require_once __DIR__ . '/controllers/FormationContinueController.php';
require_once __DIR__ . '/controllers/DarsController.php';
require_once __DIR__ . '/controllers/MasterController.php';
require_once __DIR__ . '/controllers/TalibMuwazzafController.php';
require_once __DIR__ . '/controllers/WahdaController.php';

$action = $_GET['action'] ?? 'dashboard';
$id     = isset($_GET['id']) ? (int)$_GET['id'] : null;

match ($action) {
    // Dashboard
    'dashboard'               => dashboard(),

    // Stagiaires
    'stagiaires'              => (new StagiaireController())->index(),
    'create_stagiaire'        => (new StagiaireController())->create(),
    'edit_stagiaire'          => (new StagiaireController())->edit($id),
    'delete_stagiaire'        => (new StagiaireController())->delete($id),
    'show_stagiaire'          => (new StagiaireController())->show($id),

    // Services
    'services'                => (new ServiceController())->index(),
    'create_service'          => (new ServiceController())->create(),
    'edit_service'            => (new ServiceController())->edit($id),
    'delete_service'          => (new ServiceController())->delete($id),

    // Employes
    'employes'                => (new EmployeController())->index(),
    'create_employe'          => (new EmployeController())->create(),
    'edit_employe'            => (new EmployeController())->edit($id),
    'delete_employe'          => (new EmployeController())->delete($id),

    // Formation de base
    'formations_base'         => (new FormationBaseController())->index(),
    'create_formation_base'   => (new FormationBaseController())->create(),
    'edit_formation_base'     => (new FormationBaseController())->edit($id),
    'delete_formation_base'   => (new FormationBaseController())->delete($id),

    // Nadwat
    'nadwat'                  => (new NadwaController())->index(),
    'create_nadwa'            => (new NadwaController())->create(),
    'edit_nadwa'              => (new NadwaController())->edit($id),
    'delete_nadwa'            => (new NadwaController())->delete($id),
    'show_nadwa'              => (new NadwaController())->show($id),
    'add_participant'         => (new NadwaController())->addParticipant(),
    'delete_participant'      => (new NadwaController())->deleteParticipant($id),

    // Formation continue
    'formations_continues'    => (new FormationContinueController())->index(),
    'create_formation_continue' => (new FormationContinueController())->create(),
    'edit_formation_continue' => (new FormationContinueController())->edit($id),
    'delete_formation_continue' => (new FormationContinueController())->delete($id),
    'show_formation_continue' => (new FormationContinueController())->show($id),

    // Durus
    'create_dars'             => (new DarsController())->create(),
    'delete_dars'             => (new DarsController())->delete($id),

    // Masters
    'masters'                 => (new MasterController())->index(),
    'create_master'           => (new MasterController())->create(),
    'edit_master'             => (new MasterController())->edit($id),
    'delete_master'           => (new MasterController())->delete($id),
    'show_master'             => (new MasterController())->show($id),

    // Talib Muwazzaf
    'talib_muwazzaf'          => (new TalibMuwazzafController())->index(),
    'create_talib'            => (new TalibMuwazzafController())->create(),
    'edit_talib'              => (new TalibMuwazzafController())->edit($id),
    'delete_talib'            => (new TalibMuwazzafController())->delete($id),
    'show_talib'              => (new TalibMuwazzafController())->show($id),

    // Wahedat
    'create_wahda'            => (new WahdaController())->create(),
    'edit_wahda'              => (new WahdaController())->edit($id),
    'delete_wahda'            => (new WahdaController())->delete($id),

    default                   => dashboard(),
};

function dashboard(): void {
    require_once __DIR__ . '/config/database.php';
    require_once __DIR__ . '/config/helpers.php';
    $pdo = (new Database())->getConnection();

    $stats = [
        'stagiaires'            => (int)$pdo->query("SELECT COUNT(*) FROM stagiaires")->fetchColumn(),
        'stagiaires_actifs'     => (int)$pdo->query("SELECT COUNT(*) FROM stagiaires WHERE statut='actif'")->fetchColumn(),
        'stagiaires_termines'   => (int)$pdo->query("SELECT COUNT(*) FROM stagiaires WHERE statut='termine'")->fetchColumn(),
        'employes'              => (int)$pdo->query("SELECT COUNT(*) FROM employes")->fetchColumn(),
        'formations_base'       => (int)$pdo->query("SELECT COUNT(*) FROM formations_base")->fetchColumn(),
        'formations_continues'  => (int)$pdo->query("SELECT COUNT(*) FROM formations_continues")->fetchColumn(),
        'nadwat'                => (int)$pdo->query("SELECT COUNT(*) FROM nadwat")->fetchColumn(),
        'masters'               => (int)$pdo->query("SELECT COUNT(*) FROM masters")->fetchColumn(),
        'talib_muwazzaf'        => (int)$pdo->query("SELECT COUNT(*) FROM talib_muwazzaf")->fetchColumn(),
    ];

    $recent_stagiaires = $pdo->query("
        SELECT s.*, sv.nom_ar AS service_nom
        FROM stagiaires s
        LEFT JOIN services sv ON s.service_id = sv.id
        ORDER BY s.created_at DESC LIMIT 6
    ")->fetchAll();

    // Notifications: ending within 7 days
    $notifications = $pdo->query("
        SELECT nom, date_fin, 'متدرب' AS type FROM stagiaires
        WHERE statut='actif' AND date_fin BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
        UNION
        SELECT e.nom_complet AS nom, fb.date_fin, 'تكوين أساسي' AS type
        FROM formations_base fb JOIN employes e ON fb.employe_id = e.id
        WHERE fb.date_fin BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    ")->fetchAll();

    require __DIR__ . '/views/dashboard.php';
}
