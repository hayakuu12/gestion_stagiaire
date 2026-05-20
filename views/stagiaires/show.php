<?php require __DIR__ . '/../layout/header.php'; require_once __DIR__ . '/../../config/helpers.php'; ?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li><li class="breadcrumb-item"><a href="index.php?action=stagiaires">المتدربون</a></li><li class="breadcrumb-item active"><?= htmlspecialchars($stagiaire['nom']) ?></li></ol></nav>
        <h2><i class="fas fa-user-clock me-2"></i><?= htmlspecialchars($stagiaire['nom']) ?></h2>
    </div>
    <div class="d-flex gap-2">
        <a href="index.php?action=edit_stagiaire&id=<?= $stagiaire['id'] ?>" class="btn btn-warning"><i class="fas fa-edit me-1"></i>تعديل</a>
        <button onclick="confirmDelete('index.php?action=delete_stagiaire&id=<?= $stagiaire['id'] ?>','<?= htmlspecialchars(addslashes($stagiaire['nom'])) ?>')" class="btn btn-outline-danger"><i class="fas fa-trash me-1"></i>حذف</button>
        <a href="index.php?action=stagiaires" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header"><i class="fas fa-id-card me-2"></i>المعلومات الأساسية</div>
            <div class="card-body">
                <div class="detail-row"><span class="detail-label">الاسم الكامل</span><span class="detail-value fw-bold"><?= htmlspecialchars($stagiaire['nom']) ?></span></div>
                <div class="detail-row"><span class="detail-label">المصلحة</span><span class="detail-value"><?= htmlspecialchars($stagiaire['service_nom'] ?? '—') ?></span></div>
                <div class="detail-row"><span class="detail-label">التخصص</span><span class="detail-value"><?= htmlspecialchars($stagiaire['specialite'] ?? '—') ?></span></div>
                <div class="detail-row"><span class="detail-label">تاريخ البداية</span><span class="detail-value"><?= formatDate($stagiaire['date_debut']) ?></span></div>
                <div class="detail-row"><span class="detail-label">تاريخ النهاية</span><span class="detail-value"><?= formatDate($stagiaire['date_fin']) ?> <?= expiresLabel($stagiaire['date_fin']) ?></span></div>
                <div class="detail-row"><span class="detail-label">الحالة</span><span class="detail-value"><span class="badge bs-<?= $stagiaire['statut'] ?>"><?= $stagiaire['statut']==='actif'?'نشط':'منتهي' ?></span></span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header"><i class="fas fa-folder-open me-2"></i>الوثائق والملفات</div>
            <div class="card-body">
                <div class="row g-3">
                    <?php foreach (['doc_demande'=>'طلب التدريب','doc_assurance'=>'التأمين','doc_base'=>'الوثائق الأساسية','doc_rapport'=>'التقرير النهائي'] as $field=>$label): ?>
                    <div class="col-md-6">
                        <p class="form-label mb-1"><?= $label ?></p>
                        <?php if ($stagiaire[$field]): ?>
                        <a href="<?= htmlspecialchars($stagiaire[$field]) ?>" target="_blank" class="file-link">
                            <i class="fas fa-file-alt"></i> عرض الملف
                        </a>
                        <?php else: ?>
                        <span class="text-muted small">لم يُرفع بعد</span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
