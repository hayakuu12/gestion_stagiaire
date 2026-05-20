<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-edit me-2"></i>تعديل الندوة</h2></div>
    <a href="index.php?action=nadwat" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>
<?php $v = array_merge($nadwa, $_SERVER['REQUEST_METHOD']==='POST'?$_POST:[]); ?>

<div class="card" style="max-width:700px">
    <div class="card-header"><i class="fas fa-microphone-alt me-2"></i><?= htmlspecialchars($nadwa['sujet']) ?></div>
    <div class="card-body">
        <form method="POST" action="index.php?action=edit_nadwa&id=<?= $nadwa['id'] ?>">
            <div class="row g-3">
                <div class="col-12"><label class="form-label">الموضوع <span class="text-danger">*</span></label><input type="text" name="sujet" class="form-control" value="<?= htmlspecialchars($v['sujet']) ?>" required></div>
                <div class="col-md-6"><label class="form-label">النوع</label><input type="text" name="type_nadwa" class="form-control" value="<?= htmlspecialchars($v['type_nadwa']??'') ?>"></div>
                <div class="col-md-3"><label class="form-label">التاريخ</label><input type="date" name="date_nadwa" class="form-control" value="<?= htmlspecialchars($v['date_nadwa']??'') ?>"></div>
                <div class="col-md-3"><label class="form-label">المكان</label><input type="text" name="lieu" class="form-control" value="<?= htmlspecialchars($v['lieu']??'') ?>"></div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="index.php?action=nadwat" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
