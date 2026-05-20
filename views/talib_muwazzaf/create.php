<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-user-plus me-2"></i>إضافة طالب موظف</h2></div>
    <a href="index.php?action=masters" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>
<?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0 ps-3"><?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

<?php $preselect = (int)($_GET['master_id'] ?? $_POST['master_id'] ?? 0); ?>

<div class="card" style="max-width:700px">
    <div class="card-header"><i class="fas fa-user-graduate me-2"></i>بيانات الطالب</div>
    <div class="card-body">
        <form method="POST" action="index.php?action=create_talib">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">برنامج الماستر <span class="text-danger">*</span></label>
                    <select name="master_id" class="form-select" required>
                        <option value="">— اختر البرنامج —</option>
                        <?php foreach ($masters as $m): ?>
                        <option value="<?= $m['id'] ?>" <?= ($preselect==$m['id'])?'selected':'' ?>><?= htmlspecialchars($m['nom_master']) ?> <?= $m['annee']?'('.$m['annee'].')':'' ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6"><label class="form-label">رقم الهاتف</label><input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($_POST['telephone']??'') ?>"></div>
                <div class="col-12"><label class="form-label">الاسم الكامل <span class="text-danger">*</span></label><input type="text" name="nom_complet" class="form-control" value="<?= htmlspecialchars($_POST['nom_complet']??'') ?>" required></div>
                <div class="col-md-6"><label class="form-label">رقم التسجيل</label><input type="text" name="num_matricule" class="form-control" value="<?= htmlspecialchars($_POST['num_matricule']??'') ?>"></div>
            </div>
            <div class="alert alert-info mt-3 mb-0 py-2 px-3 small"><i class="fas fa-info-circle me-1"></i>سيتم إنشاء 4 فصول دراسية تلقائياً عند إضافة الطالب.</div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="index.php?action=masters" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
