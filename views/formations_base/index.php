<?php require __DIR__ . '/../layout/header.php'; require_once __DIR__ . '/../../config/helpers.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-chalkboard-teacher me-2"></i>التكوين الأساسي</h2><p class="sub"><?= count($formations) ?> فترة تكوين</p></div>
    <a href="index.php?action=create_formation_base" class="btn btn-primary"><i class="fas fa-plus me-2"></i>إضافة فترة</a>
</div>
<?php if (isset($_GET['success'])): ?><div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>تمت العملية بنجاح.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

<div class="card">
    <div class="card-header"><span><i class="fas fa-list me-2"></i>فترات التكوين</span></div>
    <div class="card-body p-0">
        <?php if (empty($formations)): ?>
        <div class="empty-state"><i class="fas fa-chalkboard-teacher"></i><p>لا توجد فترات تكوين</p></div>
        <?php else: ?>
        <table class="table table-hover mb-0">
            <thead><tr><th>الموظف</th><th>المصلحة</th><th>البداية</th><th>النهاية</th><th>التقرير</th><th class="text-center">إجراءات</th></tr></thead>
            <tbody>
            <?php foreach ($formations as $f): ?>
            <tr>
                <td class="fw-bold"><?= htmlspecialchars($f['nom_complet']) ?></td>
                <td><?= htmlspecialchars($f['service_nom']??'—') ?></td>
                <td><?= formatDate($f['date_debut']) ?></td>
                <td><?= formatDate($f['date_fin']) ?> <?= expiresLabel($f['date_fin']) ?></td>
                <td>
                    <?php if ($f['rapport']): ?>
                    <a href="<?= htmlspecialchars($f['rapport']) ?>" target="_blank" class="file-link"><i class="fas fa-file-alt"></i> عرض</a>
                    <?php else: ?><span class="text-muted small">—</span><?php endif; ?>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="index.php?action=edit_formation_base&id=<?= $f['id'] ?>" class="btn btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('index.php?action=delete_formation_base&id=<?= $f['id'] ?>','هذه الفترة')" class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
