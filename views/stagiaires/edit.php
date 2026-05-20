<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li><li class="breadcrumb-item"><a href="index.php?action=stagiaires">المتدربون</a></li><li class="breadcrumb-item active">تعديل</li></ol></nav>
        <h2><i class="fas fa-user-edit me-2"></i>تعديل بيانات المتدرب</h2>
    </div>
    <a href="index.php?action=show_stagiaire&id=<?= $stagiaire['id'] ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>

<?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0 ps-3"><?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

<?php $v = array_merge($stagiaire, $_SERVER['REQUEST_METHOD']==='POST' ? $_POST : []); ?>

<div class="card">
    <div class="card-header"><i class="fas fa-id-card me-2"></i><?= htmlspecialchars($stagiaire['nom']) ?></div>
    <div class="card-body">
        <form method="POST" action="index.php?action=edit_stagiaire&id=<?= $stagiaire['id'] ?>" enctype="multipart/form-data">

            <div class="form-section">
                <div class="form-section-title"><i class="fas fa-user"></i> البيانات الأساسية</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($v['nom']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">الشعبة / التخصص</label>
                        <input type="text" name="specialite" class="form-control" value="<?= htmlspecialchars($v['specialite'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">المصلحة</label>
                        <select name="service_id" class="form-select">
                            <option value="">— اختر —</option>
                            <?php foreach ($services as $sv): ?>
                            <option value="<?= $sv['id'] ?>" <?= ($v['service_id']==$sv['id'])?'selected':'' ?>><?= htmlspecialchars($sv['nom_ar']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">تاريخ البداية</label>
                        <input type="date" name="date_debut" class="form-control" value="<?= htmlspecialchars($v['date_debut']??'') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">تاريخ النهاية</label>
                        <input type="date" name="date_fin" class="form-control" value="<?= htmlspecialchars($v['date_fin']??'') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">الحالة</label>
                        <select name="statut" class="form-select">
                            <option value="actif" <?= ($v['statut']==='actif')?'selected':'' ?>>نشط</option>
                            <option value="termine" <?= ($v['statut']==='termine')?'selected':'' ?>>منتهي</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title"><i class="fas fa-file-upload"></i> تحديث الوثائق <small class="text-muted">(اترك فارغاً للإبقاء على الملف الحالي)</small></div>
                <div class="row g-3">
                    <?php foreach (['doc_demande'=>'طلب التدريب','doc_assurance'=>'التأمين','doc_base'=>'الوثائق الأساسية','doc_rapport'=>'التقرير النهائي'] as $field=>$label): ?>
                    <div class="col-md-6">
                        <label class="form-label"><?= $label ?></label>
                        <?php if ($stagiaire[$field]): ?>
                        <div class="mb-1"><a href="<?= htmlspecialchars($stagiaire[$field]) ?>" target="_blank" class="file-link"><i class="fas fa-file-alt me-1"></i>الملف الحالي</a></div>
                        <?php endif; ?>
                        <input type="file" name="<?= $field ?>" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="index.php?action=show_stagiaire&id=<?= $stagiaire['id'] ?>" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
