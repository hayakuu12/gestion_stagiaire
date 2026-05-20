<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-user-edit me-2"></i>تعديل بيانات الموظف</h2></div>
    <a href="index.php?action=employes" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
</div>
<?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0 ps-3"><?php foreach($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

<?php $v = array_merge($employe, $_SERVER['REQUEST_METHOD']==='POST' ? $_POST : []); ?>

<div class="card" style="max-width:700px">
    <div class="card-header"><i class="fas fa-id-badge me-2"></i><?= htmlspecialchars($employe['nom_complet']) ?></div>
    <div class="card-body">
        <form method="POST" action="index.php?action=edit_employe&id=<?= $employe['id'] ?>">
            <div class="row g-3">
                <div class="col-md-12"><label class="form-label">الاسم الكامل <span class="text-danger">*</span></label><input type="text" name="nom_complet" class="form-control" value="<?= htmlspecialchars($v['nom_complet']) ?>" required></div>
                <div class="col-md-4"><label class="form-label">رقم البطاقة الوطنية</label><input type="text" name="cin" class="form-control" value="<?= htmlspecialchars($v['cin']??'') ?>"></div>
                <div class="col-md-4"><label class="form-label">رقم الهاتف</label><input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($v['telephone']??'') ?>"></div>
                <div class="col-md-4"><label class="form-label">التخصص</label><input type="text" name="specialite" class="form-control" value="<?= htmlspecialchars($v['specialite']??'') ?>"></div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="index.php?action=employes" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
