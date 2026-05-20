<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php?action=masters">تكوين الماستر</a></li><li class="breadcrumb-item active"><?= htmlspecialchars($master['nom_master']) ?></li></ol></nav>
        <h2><i class="fas fa-graduation-cap me-2"></i><?= htmlspecialchars($master['nom_master']) ?></h2>
    </div>
    <div class="d-flex gap-2">
        <a href="index.php?action=create_talib&master_id=<?= $master['id'] ?>" class="btn btn-success"><i class="fas fa-user-plus me-1"></i>إضافة طالب</a>
        <a href="index.php?action=edit_master&id=<?= $master['id'] ?>" class="btn btn-warning"><i class="fas fa-edit me-1"></i>تعديل</a>
        <a href="index.php?action=masters" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><i class="fas fa-info-circle me-2"></i>تفاصيل البرنامج</div>
            <div class="card-body">
                <div class="detail-row"><span class="detail-label">اسم البرنامج</span><span class="detail-value fw-bold"><?= htmlspecialchars($master['nom_master']) ?></span></div>
                <div class="detail-row"><span class="detail-label">الجامعة</span><span class="detail-value"><?= htmlspecialchars($master['universite']??'—') ?></span></div>
                <div class="detail-row"><span class="detail-label">التخصص</span><span class="detail-value"><?= htmlspecialchars($master['specialite']??'—') ?></span></div>
                <div class="detail-row"><span class="detail-label">السنة</span><span class="detail-value"><?= htmlspecialchars($master['annee']??'—') ?></span></div>
                <div class="detail-row"><span class="detail-label">عدد الطلاب</span><span class="detail-value"><span class="badge bg-info text-dark fs-6"><?= count($talib_list) ?></span></span></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><span><i class="fas fa-users me-2"></i>الطلاب الموظفون (<?= count($talib_list) ?>)</span></div>
            <div class="card-body p-0">
                <?php if (empty($talib_list)): ?>
                <div class="empty-state py-3"><i class="fas fa-user-graduate"></i><p>لا يوجد طلاب مسجلون</p></div>
                <?php else: ?>
                <table class="table table-hover mb-0">
                    <thead><tr><th>الاسم الكامل</th><th>رقم التسجيل</th><th>الهاتف</th><th class="text-center">إجراءات</th></tr></thead>
                    <tbody>
                    <?php foreach ($talib_list as $t): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($t['nom_complet']) ?></td>
                        <td><?= htmlspecialchars($t['num_matricule']??'—') ?></td>
                        <td><?= htmlspecialchars($t['telephone']??'—') ?></td>
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
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
