<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-sitemap me-2"></i>المصالح</h2></div>
    <a href="index.php?action=create_service" class="btn btn-primary"><i class="fas fa-plus me-2"></i>إضافة مصلحة</a>
</div>

<?php if (isset($_GET['success'])): ?><div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>تمت العملية بنجاح.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

<div class="card">
    <div class="card-header"><span><i class="fas fa-list me-2"></i>قائمة المصالح</span></div>
    <div class="card-body p-0">
        <?php if (empty($services)): ?>
        <div class="empty-state"><i class="fas fa-sitemap"></i><p>لا توجد مصالح</p></div>
        <?php else: ?>
        <table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>الاسم بالعربية</th><th>Nom en Français</th><th class="text-center">إجراءات</th></tr></thead>
            <tbody>
            <?php foreach ($services as $s): ?>
            <tr>
                <td class="text-muted"><?= $s['id'] ?></td>
                <td class="fw-bold"><?= htmlspecialchars($s['nom_ar']) ?></td>
                <td class="text-muted"><?= htmlspecialchars($s['nom_fr'] ?? '') ?></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="index.php?action=edit_service&id=<?= $s['id'] ?>" class="btn btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('index.php?action=delete_service&id=<?= $s['id'] ?>','<?= htmlspecialchars(addslashes($s['nom_ar'])) ?>')" class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i></button>
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
