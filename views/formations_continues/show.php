<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php?action=formations_continues">التكوين المستمر</a></li><li class="breadcrumb-item active"><?= htmlspecialchars($formation['sujet']) ?></li></ol></nav>
        <h2><i class="fas fa-chalkboard-teacher me-2"></i><?= htmlspecialchars($formation['sujet']) ?></h2>
    </div>
    <div class="d-flex gap-2">
        <a href="index.php?action=edit_formation_continue&id=<?= $formation['id'] ?>" class="btn btn-warning"><i class="fas fa-edit me-1"></i>تعديل</a>
        <a href="index.php?action=formations_continues" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><i class="fas fa-info-circle me-2"></i>تفاصيل الدورة</div>
            <div class="card-body">
                <div class="detail-row"><span class="detail-label">الموضوع</span><span class="detail-value fw-bold"><?= htmlspecialchars($formation['sujet']) ?></span></div>
                <div class="detail-row"><span class="detail-label">المكان</span><span class="detail-value"><?= htmlspecialchars($formation['lieu']??'—') ?></span></div>
                <div class="detail-row"><span class="detail-label">تاريخ البداية</span><span class="detail-value"><?= $formation['date_debut'] ? date('d/m/Y',strtotime($formation['date_debut'])) : '—' ?></span></div>
                <div class="detail-row"><span class="detail-label">عدد الدروس</span><span class="detail-value"><span class="badge bg-info text-dark fs-6"><?= count($durus) ?></span></span></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><span><i class="fas fa-book-open me-2"></i>الدروس (<?= count($durus) ?>)</span></div>
            <div class="card-body p-0">
                <?php if (empty($durus)): ?>
                <div class="empty-state py-3"><i class="fas fa-book-open"></i><p>لا توجد دروس مضافة</p></div>
                <?php else: ?>
                <table class="table table-hover mb-0">
                    <thead><tr><th>عنوان الدرس</th><th>التاريخ</th><th>الساعة</th><th class="text-center">حذف</th></tr></thead>
                    <tbody>
                    <?php foreach ($durus as $d): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($d['nom_dars']) ?></td>
                        <td><?= $d['date_dars'] ? date('d/m/Y',strtotime($d['date_dars'])) : '—' ?></td>
                        <td><?= $d['heure'] ? htmlspecialchars($d['heure']) : '—' ?></td>
                        <td class="text-center"><a href="index.php?action=delete_dars&id=<?= $d['id'] ?>" class="btn btn-icon btn-outline-danger" onclick="return confirm('حذف الدرس؟')"><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
                <!-- Add dars -->
                <div class="p-3 border-top">
                    <form method="POST" action="index.php?action=create_dars" class="row g-2">
                        <input type="hidden" name="formation_id" value="<?= $formation['id'] ?>">
                        <div class="col-12 col-md-5"><input type="text" name="nom_dars" class="form-control form-control-sm" placeholder="عنوان الدرس" required></div>
                        <div class="col-6 col-md-3"><input type="date" name="date_dars" class="form-control form-control-sm"></div>
                        <div class="col-6 col-md-2"><input type="time" name="heure" class="form-control form-control-sm"></div>
                        <div class="col-12 col-md-2"><button type="submit" class="btn btn-primary btn-sm w-100 text-nowrap"><i class="fas fa-plus me-1"></i>إضافة</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
