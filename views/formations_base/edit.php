<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-edit me-2"></i>تعديل فترة التكوين</h2></div>
    <a href="index.php?action=formations_base" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>
<?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0 ps-3"><?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

<?php $v = array_merge($formation, $_SERVER['REQUEST_METHOD']==='POST' ? $_POST : []); ?>

<div class="card">
    <div class="card-header"><i class="fas fa-chalkboard-teacher me-2"></i><?= htmlspecialchars($formation['nom_complet']) ?></div>
    <div class="card-body">
        <form method="POST" action="index.php?action=edit_formation_base&id=<?= $formation['id'] ?>" enctype="multipart/form-data">
            <div class="form-section">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">الموظف <span class="text-danger">*</span></label>
                        <select name="employe_id" class="form-select" required>
                            <?php foreach ($employes as $e): ?>
                            <option value="<?= $e['id'] ?>" <?= ($v['employe_id']==$e['id'])?'selected':'' ?>><?= htmlspecialchars($e['nom_complet']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">المصلحة</label>
                        <select name="service_id" class="form-select">
                            <option value="">—</option>
                            <?php foreach ($services as $s): ?>
                            <option value="<?= $s['id'] ?>" <?= ($v['service_id']==$s['id'])?'selected':'' ?>><?= htmlspecialchars($s['nom_ar']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3"><label class="form-label">تاريخ البداية</label><input type="date" name="date_debut" class="form-control" value="<?= htmlspecialchars($v['date_debut']??'') ?>"></div>
                    <div class="col-md-3"><label class="form-label">تاريخ النهاية</label><input type="date" name="date_fin" class="form-control" value="<?= htmlspecialchars($v['date_fin']??'') ?>"></div>
                    <div class="col-md-6">
                        <label class="form-label">التقرير</label>
                        <?php if ($formation['rapport']): ?><div class="mb-1"><a href="<?= htmlspecialchars($formation['rapport']) ?>" target="_blank" class="file-link"><i class="fas fa-file-alt"></i> الملف الحالي</a></div><?php endif; ?>
                        <input type="file" name="rapport" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="index.php?action=formations_base" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
