<?php require __DIR__ . '/layout/header.php'; ?>

<div class="page-header">
    <div>
        <h2><i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم</h2>
        <p class="sub">نظام إدارة التداريب والتكوين – <?= date('d/m/Y') ?></p>
    </div>
</div>

<!-- Notifications -->
<?php if (!empty($notifications)): ?>
<div class="notif-bar">
    <i class="fas fa-bell text-warning me-2"></i>
    <strong>تنبيهات :</strong>
    <?php foreach ($notifications as $n): ?>
    <span class="badge bg-warning text-dark ms-1">
        <?= htmlspecialchars($n['nom']) ?> (<?= $n['type'] ?>) – ينتهي <?= date('d/m/Y', strtotime($n['date_fin'])) ?>
    </span>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Stats Row 1: التداريب -->
<p class="text-muted fw-bold mb-2" style="font-size:.8rem">▌ التداريب</p>
<div class="row g-3 mb-4">
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#1a3a6b,#2563eb)">
            <i class="fas fa-users stat-icon"></i>
            <div class="stat-label">إجمالي المتدربين</div>
            <div class="stat-value"><?= $stats['stagiaires'] ?></div>
            <a href="index.php?action=stagiaires" class="stat-link">عرض الكل ←</a>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#198754,#22c55e)">
            <i class="fas fa-spinner stat-icon"></i>
            <div class="stat-label">التداريب النشطة</div>
            <div class="stat-value"><?= $stats['stagiaires_actifs'] ?></div>
            <a href="index.php?action=stagiaires" class="stat-link">عرض ←</a>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#6c757d,#9ca3af)">
            <i class="fas fa-check-circle stat-icon"></i>
            <div class="stat-label">التداريب المنتهية</div>
            <div class="stat-value"><?= $stats['stagiaires_termines'] ?></div>
            <a href="index.php?action=stagiaires" class="stat-link">عرض ←</a>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#0d6efd,#38bdf8)">
            <i class="fas fa-user-tie stat-icon"></i>
            <div class="stat-label">الموظفون</div>
            <div class="stat-value"><?= $stats['employes'] ?></div>
            <a href="index.php?action=employes" class="stat-link">عرض ←</a>
        </div>
    </div>
</div>

<!-- Stats Row 2: التكوين -->
<p class="text-muted fw-bold mb-2" style="font-size:.8rem">▌ التكوين</p>
<div class="row g-3 mb-4">
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#6f42c1,#a855f7)">
            <i class="fas fa-chalkboard-teacher stat-icon"></i>
            <div class="stat-label">التكوينات الأساسية</div>
            <div class="stat-value"><?= $stats['formations_base'] ?></div>
            <a href="index.php?action=formations_base" class="stat-link">عرض ←</a>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#fd7e14,#f97316)">
            <i class="fas fa-book-open stat-icon"></i>
            <div class="stat-label">التكوينات المستمرة</div>
            <div class="stat-value"><?= $stats['formations_continues'] ?></div>
            <a href="index.php?action=formations_continues" class="stat-link">عرض ←</a>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#0dcaf0,#22d3ee)">
            <i class="fas fa-microphone-alt stat-icon"></i>
            <div class="stat-label">الندوات</div>
            <div class="stat-value"><?= $stats['nadwat'] ?></div>
            <a href="index.php?action=nadwat" class="stat-link">عرض ←</a>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#dc3545,#f43f5e)">
            <i class="fas fa-graduation-cap stat-icon"></i>
            <div class="stat-label">تكوينات الماستر</div>
            <div class="stat-value"><?= $stats['masters'] ?></div>
            <a href="index.php?action=masters" class="stat-link">عرض ←</a>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#20c997,#10b981)">
            <i class="fas fa-user-graduate stat-icon"></i>
            <div class="stat-label">طلبة الماستر</div>
            <div class="stat-value"><?= $stats['talib_muwazzaf'] ?></div>
            <a href="index.php?action=talib_muwazzaf" class="stat-link">عرض ←</a>
        </div>
    </div>
</div>

<!-- Recent stagiaires -->
<div class="card">
    <div class="card-header">
        <span><i class="fas fa-user-clock me-2"></i>آخر المتدربين المضافين</span>
        <a href="index.php?action=create_stagiaire" class="btn btn-sm btn-light py-1">
            <i class="fas fa-plus me-1"></i>إضافة
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($recent_stagiaires)): ?>
        <div class="empty-state py-4"><i class="fas fa-users"></i>لا يوجد متدربون بعد</div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>الاسم</th><th>المصلحة</th><th>التخصص</th><th>بداية</th><th>نهاية</th><th>الحالة</th><th></th></tr></thead>
                <tbody>
                <?php foreach ($recent_stagiaires as $s): ?>
                <tr>
                    <td class="fw-bold"><?= htmlspecialchars($s['nom']) ?></td>
                    <td><?= htmlspecialchars($s['service_nom'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($s['specialite'] ?? '—') ?></td>
                    <td><?= $s['date_debut'] ? date('d/m/Y',strtotime($s['date_debut'])) : '—' ?></td>
                    <td><?= $s['date_fin']   ? date('d/m/Y',strtotime($s['date_fin']))   : '—' ?></td>
                    <td><span class="badge bs-<?= $s['statut'] ?>"><?= $s['statut']==='actif'?'نشط':'منتهي' ?></span></td>
                    <td>
                        <a href="index.php?action=show_stagiaire&id=<?= $s['id'] ?>" class="btn btn-icon btn-outline-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>
