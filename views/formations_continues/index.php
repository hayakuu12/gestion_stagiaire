<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-chalkboard-teacher me-2"></i>التكوين المستمر</h2><p class="sub"><?= count($formations) ?> دورة تكوينية</p></div>
    <a href="index.php?action=create_formation_continue" class="btn btn-primary"><i class="fas fa-plus me-2"></i>إضافة دورة</a>
</div>
<?php if (isset($_GET['success'])): ?><div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>تمت العملية بنجاح.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

<div class="card">
    <div class="card-header"><span><i class="fas fa-list me-2"></i>قائمة الدورات التكوينية</span></div>
    <div class="card-body p-0">
        <?php if (empty($formations)): ?>
        <div class="empty-state"><i class="fas fa-chalkboard-teacher"></i><p>لا توجد دورات تكوينية</p></div>
        <?php else: ?>
        <table class="table table-hover mb-0">
            <thead><tr><th>الموضوع</th><th>المكان</th><th>تاريخ البداية</th><th class="text-center">أيام الدروس</th><th class="text-center">إجراءات</th></tr></thead>
            <tbody>
            <?php foreach ($formations as $f): ?>
            <tr>
                <td class="fw-bold"><?= htmlspecialchars($f['sujet']) ?></td>
                <td><?= htmlspecialchars($f['lieu']??'—') ?></td>
                <td><?= $f['date_debut'] ? date('d/m/Y',strtotime($f['date_debut'])) : '—' ?></td>
                <td class="text-center"><span class="badge bg-info text-dark"><?= $f['nb_jours'] ?></span></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="index.php?action=show_formation_continue&id=<?= $f['id'] ?>" class="btn btn-icon btn-outline-primary"><i class="fas fa-eye"></i></a>
                        <a href="index.php?action=edit_formation_continue&id=<?= $f['id'] ?>" class="btn btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('index.php?action=delete_formation_continue&id=<?= $f['id'] ?>','<?= htmlspecialchars(addslashes($f['sujet'])) ?>')" class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i></button>
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
