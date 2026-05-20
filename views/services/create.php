<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-plus-circle me-2"></i>إضافة مصلحة</h2></div>
    <a href="index.php?action=services" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>

<?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0 ps-3"><?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

<div class="card" style="max-width:600px">
    <div class="card-header"><i class="fas fa-sitemap me-2"></i>بيانات المصلحة</div>
    <div class="card-body">
        <form method="POST" action="index.php?action=create_service">
            <div class="mb-3">
                <label class="form-label">الاسم بالعربية <span class="text-danger">*</span></label>
                <input type="text" name="nom_ar" class="form-control" value="<?= htmlspecialchars($_POST['nom_ar']??'') ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Nom en Français</label>
                <input type="text" name="nom_fr" class="form-control" value="<?= htmlspecialchars($_POST['nom_fr']??'') ?>">
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="index.php?action=services" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
