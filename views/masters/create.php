<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-plus-circle me-2"></i>إضافة برنامج ماستر</h2></div>
    <a href="index.php?action=masters" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>
<?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0 ps-3"><?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

<div class="card" style="max-width:700px">
    <div class="card-header"><i class="fas fa-graduation-cap me-2"></i>بيانات البرنامج</div>
    <div class="card-body">
        <form method="POST" action="index.php?action=create_master">
            <div class="row g-3">
                <div class="col-12"><label class="form-label">اسم البرنامج <span class="text-danger">*</span></label><input type="text" name="nom_master" class="form-control" value="<?= htmlspecialchars($_POST['nom_master']??'') ?>" required></div>
                <div class="col-md-6"><label class="form-label">الجامعة</label><input type="text" name="universite" class="form-control" value="<?= htmlspecialchars($_POST['universite']??'') ?>"></div>
                <div class="col-md-6"><label class="form-label">التخصص</label><input type="text" name="specialite" class="form-control" value="<?= htmlspecialchars($_POST['specialite']??'') ?>"></div>
                <div class="col-md-6"><label class="form-label">السنة</label><input type="text" name="annee" class="form-control" placeholder="مثال: 2024" value="<?= htmlspecialchars($_POST['annee']??'') ?>"></div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="index.php?action=masters" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
