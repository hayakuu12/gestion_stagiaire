<?php
$currentAction = $_GET['action'] ?? 'dashboard';

function isActive(string|array $actions, string $current): string {
    $list = is_array($actions) ? $actions : [$actions];
    return in_array($current, $list, true) ? ' active' : '';
}

function subExpanded(array $actions, string $current): string {
    return in_array($current, $actions, true) ? 'show' : '';
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>نظام إدارة التداريب والتكوين</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Top navbar -->
<header class="top-navbar">
    <button id="sidebarToggle" class="btn p-0 me-3 text-white border-0" style="background:none">
        <i class="fas fa-bars fa-lg"></i>
    </button>
    <a href="index.php" class="brand">
        <img src="assets/images/logo_wazara.svg" alt="وزارة العدل" class="navbar-logo">
        <span>نظام إدارة التداريب والتكوين</span>
    </a>
</header>

<div class="d-flex">
<!-- Sidebar -->
<nav id="sidebar">
  <div class="sidebar-inner">
    <ul class="sidebar-nav list-unstyled mb-0">

        <!-- Dashboard -->
        <li>
            <a href="index.php" class="<?= isActive('dashboard', $currentAction) ?>">
                <i class="fas fa-tachometer-alt"></i><span>لوحة التحكم</span>
            </a>
        </li>

        <!-- التداريب -->
        <li class="nav-section">التداريب</li>
        <?php
        $tadaribActions = ['stagiaires','create_stagiaire','edit_stagiaire','show_stagiaire'];
        ?>
        <li>
            <a href="#menuTadarib" data-bs-toggle="collapse"
               aria-expanded="<?= in_array($currentAction,$tadaribActions)?'true':'false' ?>"
               class="<?= in_array($currentAction,$tadaribActions)?'active':'' ?>">
                <i class="fas fa-user-clock"></i>
                <span>التداريب</span>
                <i class="fas fa-chevron-left chevron"></i>
            </a>
            <div class="collapse <?= subExpanded($tadaribActions,$currentAction) ?>" id="menuTadarib">
                <ul class="sub-nav">
                    <li><a href="index.php?action=create_stagiaire" class="<?= isActive('create_stagiaire',$currentAction) ?>">
                        <i class="fas fa-plus-circle"></i><span>إضافة متدرب</span></a></li>
                    <li><a href="index.php?action=stagiaires" class="<?= isActive('stagiaires',$currentAction) ?>">
                        <i class="fas fa-list"></i><span>قائمة المتدربين</span></a></li>
                </ul>
            </div>
        </li>

        <!-- التكوين الأساسي -->
        <li class="nav-section">التكوين الأساسي</li>
        <?php
        $tcoBaseActions = ['employes','create_employe','edit_employe','formations_base','create_formation_base','edit_formation_base'];
        ?>
        <li>
            <a href="#menuTcoBase" data-bs-toggle="collapse"
               aria-expanded="<?= in_array($currentAction,$tcoBaseActions)?'true':'false' ?>">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>التكوين الأساسي</span>
                <i class="fas fa-chevron-left chevron"></i>
            </a>
            <div class="collapse <?= subExpanded($tcoBaseActions,$currentAction) ?>" id="menuTcoBase">
                <ul class="sub-nav">
                    <li><a href="index.php?action=employes" class="<?= isActive(['employes','create_employe','edit_employe'],$currentAction) ?>">
                        <i class="fas fa-users"></i><span>الموظفون</span></a></li>
                    <li><a href="index.php?action=formations_base" class="<?= isActive(['formations_base','create_formation_base','edit_formation_base'],$currentAction) ?>">
                        <i class="fas fa-calendar-alt"></i><span>فترات التكوين</span></a></li>
                </ul>
            </div>
        </li>

        <!-- التكوين المستمر -->
        <li class="nav-section">التكوين المستمر</li>
        <?php
        $tcoContActions = ['nadwat','create_nadwa','edit_nadwa','show_nadwa','formations_continues','create_formation_continue','edit_formation_continue','show_formation_continue'];
        ?>
        <li>
            <a href="#menuTcoCont" data-bs-toggle="collapse"
               aria-expanded="<?= in_array($currentAction,$tcoContActions)?'true':'false' ?>">
                <i class="fas fa-sync-alt"></i>
                <span>التكوين المستمر</span>
                <i class="fas fa-chevron-left chevron"></i>
            </a>
            <div class="collapse <?= subExpanded($tcoContActions,$currentAction) ?>" id="menuTcoCont">
                <ul class="sub-nav">
                    <li><a href="index.php?action=nadwat" class="<?= isActive(['nadwat','create_nadwa','edit_nadwa','show_nadwa'],$currentAction) ?>">
                        <i class="fas fa-microphone-alt"></i><span>الندوات</span></a></li>
                    <li><a href="index.php?action=formations_continues" class="<?= isActive(['formations_continues','create_formation_continue','edit_formation_continue','show_formation_continue'],$currentAction) ?>">
                        <i class="fas fa-book-open"></i><span>التكوينات والدروس</span></a></li>
                </ul>
            </div>
        </li>

        <!-- تكوين الماستر -->
        <li class="nav-section">تكوين الماستر</li>
        <?php
        $masterActions = ['masters','create_master','edit_master','show_master','talib_muwazzaf','create_talib','edit_talib','show_talib'];
        ?>
        <li>
            <a href="#menuMaster" data-bs-toggle="collapse"
               aria-expanded="<?= in_array($currentAction,$masterActions)?'true':'false' ?>">
                <i class="fas fa-graduation-cap"></i>
                <span>تكوين الماستر</span>
                <i class="fas fa-chevron-left chevron"></i>
            </a>
            <div class="collapse <?= subExpanded($masterActions,$currentAction) ?>" id="menuMaster">
                <ul class="sub-nav">
                    <li><a href="index.php?action=masters" class="<?= isActive(['masters','create_master','edit_master','show_master'],$currentAction) ?>">
                        <i class="fas fa-university"></i><span>برامج الماستر</span></a></li>
                    <li><a href="index.php?action=talib_muwazzaf" class="<?= isActive(['talib_muwazzaf','create_talib','edit_talib','show_talib'],$currentAction) ?>">
                        <i class="fas fa-user-tie"></i><span>الطلبة الموظفون</span></a></li>
                </ul>
            </div>
        </li>

        <!-- الإعدادات -->
        <li class="nav-section">الإعدادات</li>
        <li>
            <a href="index.php?action=services" class="<?= isActive(['services','create_service','edit_service'],$currentAction) ?>">
                <i class="fas fa-sitemap"></i><span>المصالح</span>
            </a>
        </li>

    </ul>
  </div>
</nav>

<!-- Main content -->
<main id="content">
