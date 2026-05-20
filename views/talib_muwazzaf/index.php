<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-user-graduate me-2"></i>الطلاب الموظفون</h2><p class="sub"><?= count($talib_list) ?> طالب</p></div>
    <a href="index.php?action=create_talib" class="btn btn-primary"><i class="fas fa-plus me-2"></i>إضافة طالب</a>
</div>
<?php if (isset($_GET['success'])): ?><div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>تمت العملية بنجاح.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

<div class="card">
    <div class="card-header"><span><i class="fas fa-list me-2"></i>قائمة الطلاب</span></div>
    <div class="card-body p-0">
        <?php if (empty($talib_list)): ?>
        <div class="empty-state"><i class="fas fa-user-graduate"></i><p>لا يوجد طلاب مسجلون</p></div>
        <?php else: ?>
        <table class="table table-hover mb-0">
            <thead><tr><th>الاسم الكامل</th><th>رقم التسجيل</th><th>البرنامج</th><th>السنة</th><th class="text-center">إجراءات</th></tr></thead>
            <tbody>
            <?php foreach ($talib_list as $t): ?>
            <tr>
                <td class="fw-bold"><?= htmlspecialchars($t['nom_complet']) ?></td>
                <td><?= htmlspecialchars($t['num_matricule']??'—') ?></td>
                <td><?= htmlspecialchars($t['nom_master']??'—') ?></td>
                <td><?= htmlspecialchars($t['annee']??'—') ?></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="index.php?action=show_talib&id=<?= $t['id'] ?>" class="btn btn-icon btn-outline-primary"><i class="fas fa-eye"></i></a>
                        <a href="index.php?action=edit_talib&id=<?= $t['id'] ?>" class="btn btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('index.php?action=delete_talib&id=<?= $t['id'] ?>','<?= htmlspecialchars(addslashes($t['nom_complet'])) ?>')" class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i></button>
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
