<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php?action=masters">تكوين الماستر</a></li><li class="breadcrumb-item"><a href="index.php?action=show_talib&id=<?= $talibId ?>">الطالب</a></li><li class="breadcrumb-item active">تعديل وحدة</li></ol></nav>
        <h2><i class="fas fa-edit me-2"></i>تعديل الوحدة الدراسية</h2>
    </div>
    <a href="index.php?action=show_talib&id=<?= $talibId ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>

<?php $v = array_merge($wahda, $_SERVER['REQUEST_METHOD']==='POST' ? $_POST : []); ?>

<div class="card" style="max-width:500px">
    <div class="card-header"><i class="fas fa-book me-2"></i><?= htmlspecialchars($wahda['nom_wahda']) ?></div>
    <div class="card-body">
        <form method="POST" action="index.php?action=edit_wahda&id=<?= $wahda['id'] ?>">
            <div class="row g-3">
                <div class="col-12"><label class="form-label">اسم الوحدة <span class="text-danger">*</span></label><input type="text" name="nom_wahda" class="form-control" value="<?= htmlspecialchars($v['nom_wahda']) ?>" required></div>
                <div class="col-12">
                    <label class="form-label">النقطة <small class="text-muted">(0 — 20)</small></label>
                    <input type="number" name="nuqta" class="form-control" min="0" max="20" step="0.25" value="<?= htmlspecialchars($v['nuqta']??'') ?>" placeholder="اتركه فارغاً إذا لم تُحدَّد">
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="index.php?action=show_talib&id=<?= $talibId ?>" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
