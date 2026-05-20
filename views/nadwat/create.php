<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-plus-circle me-2"></i>إضافة ندوة</h2></div>
    <a href="index.php?action=nadwat" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>
<?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0 ps-3"><?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

<div class="card" style="max-width:700px">
    <div class="card-header"><i class="fas fa-microphone-alt me-2"></i>بيانات الندوة</div>
    <div class="card-body">
        <form method="POST" action="index.php?action=create_nadwa">
            <div class="row g-3">
                <div class="col-12"><label class="form-label">موضوع الندوة <span class="text-danger">*</span></label><input type="text" name="sujet" class="form-control" value="<?= htmlspecialchars($_POST['sujet']??'') ?>" required></div>
                <div class="col-md-6"><label class="form-label">نوع الندوة</label><input type="text" name="type_nadwa" class="form-control" value="<?= htmlspecialchars($_POST['type_nadwa']??'') ?>"></div>
                <div class="col-md-3"><label class="form-label">تاريخ الندوة</label><input type="date" name="date_nadwa" class="form-control" value="<?= htmlspecialchars($_POST['date_nadwa']??'') ?>"></div>
                <div class="col-md-3"><label class="form-label">مكان الندوة</label><input type="text" name="lieu" class="form-control" value="<?= htmlspecialchars($_POST['lieu']??'') ?>"></div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="index.php?action=nadwat" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
