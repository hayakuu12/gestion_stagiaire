<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php?action=nadwat">الندوات</a></li><li class="breadcrumb-item active"><?= htmlspecialchars($nadwa['sujet']) ?></li></ol></nav>
        <h2><i class="fas fa-microphone-alt me-2"></i><?= htmlspecialchars($nadwa['sujet']) ?></h2>
    </div>
    <div class="d-flex gap-2">
        <a href="index.php?action=edit_nadwa&id=<?= $nadwa['id'] ?>" class="btn btn-warning"><i class="fas fa-edit me-1"></i>تعديل</a>
        <a href="index.php?action=nadwat" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><i class="fas fa-info-circle me-2"></i>تفاصيل الندوة</div>
            <div class="card-body">
                <div class="detail-row"><span class="detail-label">الموضوع</span><span class="detail-value fw-bold"><?= htmlspecialchars($nadwa['sujet']) ?></span></div>
                <div class="detail-row"><span class="detail-label">النوع</span><span class="detail-value"><?= htmlspecialchars($nadwa['type_nadwa']??'—') ?></span></div>
                <div class="detail-row"><span class="detail-label">التاريخ</span><span class="detail-value"><?= $nadwa['date_nadwa'] ? date('d/m/Y',strtotime($nadwa['date_nadwa'])) : '—' ?></span></div>
                <div class="detail-row"><span class="detail-label">المكان</span><span class="detail-value"><?= htmlspecialchars($nadwa['lieu']??'—') ?></span></div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><span><i class="fas fa-users me-2"></i>المشاركون (<?= count($participants) ?>)</span></div>
            <div class="card-body p-0">
                <?php if (empty($participants)): ?>
                <div class="empty-state py-3"><i class="fas fa-users"></i><p>لا يوجد مشاركون</p></div>
                <?php else: ?>
                <table class="table table-hover mb-0">
                    <thead><tr><th>الاسم</th><th class="text-center">حذف</th></tr></thead>
                    <tbody>
                    <?php foreach ($participants as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nom']) ?></td>
                        <td class="text-center"><a href="index.php?action=delete_participant&id=<?= $p['id'] ?>&nadwa_id=<?= $nadwa['id'] ?>" class="btn btn-icon btn-outline-danger" onclick="return confirm('حذف المشارك؟')"><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
                <!-- Add participant -->
                <div class="p-3 border-top">
                    <form method="POST" action="index.php?action=add_participant" class="d-flex gap-2">
                        <input type="hidden" name="nadwa_id" value="<?= $nadwa['id'] ?>">
                        <input type="text" name="nom" class="form-control form-control-sm" placeholder="اسم المشارك" required>
                        <button type="submit" class="btn btn-primary btn-sm text-nowrap"><i class="fas fa-plus me-1"></i>إضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
