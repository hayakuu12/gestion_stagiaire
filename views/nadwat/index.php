<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-microphone-alt me-2"></i>الندوات</h2><p class="sub"><?= count($nadwat) ?> ندوة</p></div>
    <a href="index.php?action=create_nadwa" class="btn btn-primary"><i class="fas fa-plus me-2"></i>إضافة ندوة</a>
</div>
<?php if (isset($_GET['success'])): ?><div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>تمت العملية بنجاح.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

<div class="card">
    <div class="card-header"><span><i class="fas fa-list me-2"></i>قائمة الندوات</span></div>
    <div class="card-body p-0">
        <?php if (empty($nadwat)): ?>
        <div class="empty-state"><i class="fas fa-microphone-alt"></i><p>لا توجد ندوات</p></div>
        <?php else: ?>
        <table class="table table-hover mb-0">
            <thead><tr><th>الموضوع</th><th>النوع</th><th>التاريخ</th><th>المكان</th><th class="text-center">المشاركون</th><th class="text-center">إجراءات</th></tr></thead>
            <tbody>
            <?php foreach ($nadwat as $n): ?>
            <tr>
                <td class="fw-bold"><?= htmlspecialchars($n['sujet']) ?></td>
                <td><?= htmlspecialchars($n['type_nadwa']??'—') ?></td>
                <td><?= $n['date_nadwa'] ? date('d/m/Y',strtotime($n['date_nadwa'])) : '—' ?></td>
                <td><?= htmlspecialchars($n['lieu']??'—') ?></td>
                <td class="text-center"><span class="badge bg-info text-dark"><?= $n['nb_participants'] ?></span></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="index.php?action=show_nadwa&id=<?= $n['id'] ?>" class="btn btn-icon btn-outline-primary"><i class="fas fa-eye"></i></a>
                        <a href="index.php?action=edit_nadwa&id=<?= $n['id'] ?>" class="btn btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('index.php?action=delete_nadwa&id=<?= $n['id'] ?>','<?= htmlspecialchars(addslashes($n['sujet'])) ?>')" class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i></button>
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
