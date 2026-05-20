<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li><li class="breadcrumb-item"><a href="index.php?action=stagiaires">المتدربون</a></li><li class="breadcrumb-item active">إضافة</li></ol></nav>
        <h2><i class="fas fa-user-plus me-2"></i>إضافة متدرب جديد</h2>
    </div>
    <a href="index.php?action=stagiaires" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>

<?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0 ps-3"><?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

<div class="card">
    <div class="card-header"><i class="fas fa-id-card me-2"></i>معلومات المتدرب</div>
    <div class="card-body">
        <form method="POST" action="index.php?action=create_stagiaire" enctype="multipart/form-data">

            <div class="form-section">
                <div class="form-section-title"><i class="fas fa-user"></i> البيانات الأساسية</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">الشعبة / التخصص</label>
                        <input type="text" name="specialite" class="form-control" value="<?= htmlspecialchars($_POST['specialite'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">المصلحة</label>
                        <select name="service_id" class="form-select">
                            <option value="">— اختر المصلحة —</option>
                            <?php foreach ($services as $sv): ?>
                            <option value="<?= $sv['id'] ?>" <?= (($_POST['service_id']??'')==$sv['id'])?'selected':'' ?>><?= htmlspecialchars($sv['nom_ar']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">تاريخ البداية</label>
                        <input type="date" name="date_debut" class="form-control" value="<?= htmlspecialchars($_POST['date_debut']??'') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">تاريخ النهاية</label>
                        <input type="date" name="date_fin" class="form-control" value="<?= htmlspecialchars($_POST['date_fin']??'') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">الحالة</label>
                        <select name="statut" class="form-select">
                            <option value="actif" <?= (($_POST['statut']??'actif')==='actif')?'selected':'' ?>>نشط</option>
                            <option value="termine" <?= (($_POST['statut']??'')==='termine')?'selected':'' ?>>منتهي</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title"><i class="fas fa-file-upload"></i> الوثائق</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">طلب التدريب</label>
                        <input type="file" name="doc_demande" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">التأمين</label>
                        <input type="file" name="doc_assurance" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">الوثائق الأساسية</label>
                        <input type="file" name="doc_base" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">التقرير النهائي</label>
                        <input type="file" name="doc_rapport" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                </div>
                <p class="text-muted small mt-2"><i class="fas fa-info-circle me-1"></i>الصيغ المقبولة: PDF, DOC, DOCX, JPG, PNG</p>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="index.php?action=stagiaires" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
