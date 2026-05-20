<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-graduation-cap me-2"></i>تكوين الماستر</h2><p class="sub"><?= count($masters) ?> برنامج</p></div>
    <a href="index.php?action=create_master" class="btn btn-primary"><i class="fas fa-plus me-2"></i>إضافة برنامج</a>
</div>
<?php if (isset($_GET['success'])): ?><div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>تمت العملية بنجاح.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

<div class="card">
    <div class="card-header"><span><i class="fas fa-list me-2"></i>قائمة برامج الماستر</span></div>
    <div class="card-body p-0">
        <?php if (empty($masters)): ?>
        <div class="empty-state"><i class="fas fa-graduation-cap"></i><p>لا توجد برامج ماستر</p></div>
        <?php else: ?>
        <table class="table table-hover mb-0">
            <thead><tr><th>اسم البرنامج</th><th>الجامعة</th><th>التخصص</th><th>السنة</th><th class="text-center">الطلاب</th><th class="text-center">إجراءات</th></tr></thead>
            <tbody>
            <?php foreach ($masters as $m): ?>
            <tr>
                <td class="fw-bold"><?= htmlspecialchars($m['nom_master']) ?></td>
                <td><?= htmlspecialchars($m['universite']??'—') ?></td>
                <td><?= htmlspecialchars($m['specialite']??'—') ?></td>
                <td><?= htmlspecialchars($m['annee']??'—') ?></td>
                <td class="text-center"><span class="badge bg-info text-dark"><?= $m['nb_talib'] ?></span></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="index.php?action=show_master&id=<?= $m['id'] ?>" class="btn btn-icon btn-outline-primary"><i class="fas fa-eye"></i></a>
                        <a href="index.php?action=edit_master&id=<?= $m['id'] ?>" class="btn btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('index.php?action=delete_master&id=<?= $m['id'] ?>','<?= htmlspecialchars(addslashes($m['nom_master'])) ?>')" class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i></button>
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
