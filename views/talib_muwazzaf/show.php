<?php
require __DIR__ . '/../layout/header.php';

$faslNames = ['1'=>'الفصل الأول','2'=>'الفصل الثاني','3'=>'الفصل الثالث','4'=>'الفصل الرابع'];
?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php?action=masters">تكوين الماستر</a></li><?php if ($talib['master_id']): ?><li class="breadcrumb-item"><a href="index.php?action=show_master&id=<?= $talib['master_id'] ?>"><?= htmlspecialchars($talib['nom_master']??'البرنامج') ?></a></li><?php endif; ?><li class="breadcrumb-item active"><?= htmlspecialchars($talib['nom_complet']) ?></li></ol></nav>
        <h2><i class="fas fa-user-graduate me-2"></i><?= htmlspecialchars($talib['nom_complet']) ?></h2>
    </div>
    <div class="d-flex gap-2">
        <a href="index.php?action=edit_talib&id=<?= $talib['id'] ?>" class="btn btn-warning"><i class="fas fa-edit me-1"></i>تعديل</a>
        <?php if ($talib['master_id']): ?>
        <a href="index.php?action=show_master&id=<?= $talib['master_id'] ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
        <?php else: ?>
        <a href="index.php?action=masters" class="btn btn-outline-secondary"><i class="fas fa-arrow-right me-1"></i>رجوع</a>
        <?php endif; ?>
    </div>
</div>

<!-- Student info -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4"><div class="detail-row"><span class="detail-label">رقم التسجيل</span><span class="detail-value"><?= htmlspecialchars($talib['num_matricule']??'—') ?></span></div></div>
            <div class="col-md-4"><div class="detail-row"><span class="detail-label">البرنامج</span><span class="detail-value"><?= htmlspecialchars($talib['nom_master']??'—') ?></span></div></div>
            <div class="col-md-4"><div class="detail-row"><span class="detail-label">الجامعة</span><span class="detail-value"><?= htmlspecialchars($talib['universite']??'—') ?></span></div></div>
        </div>
    </div>
</div>

<!-- Grade sheet: 4 semester tabs -->
<div class="card">
    <div class="card-header"><i class="fas fa-table me-2"></i>كشف النقاط — الفصول الدراسية</div>
    <div class="card-body p-0">
        <?php if (empty($fusul)): ?>
        <div class="empty-state py-3"><i class="fas fa-book"></i><p>لا توجد فصول دراسية</p></div>
        <?php else: ?>
        <ul class="nav nav-tabs px-3 pt-2" role="tablist">
            <?php foreach ($fusul as $i => $fasl): ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $i===0?'active':'' ?>" data-bs-toggle="tab" data-bs-target="#fasl-<?= $fasl['id'] ?>" type="button" role="tab">
                    <?= $faslNames[$fasl['numero_fasl']] ?? ('الفصل '.$fasl['numero_fasl']) ?>
                </button>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content">
            <?php foreach ($fusul as $i => $fasl): ?>
            <div class="tab-pane fade <?= $i===0?'show active':'' ?>" id="fasl-<?= $fasl['id'] ?>" role="tabpanel">
                <div class="p-3">
                    <?php $wahedat = $fasl['wahedat'] ?? []; ?>
                    <?php if (empty($wahedat)): ?>
                    <div class="empty-state py-3"><i class="fas fa-book"></i><p>لا توجد وحدات في هذا الفصل</p></div>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-3">
                            <thead class="table-light">
                                <tr><th>#</th><th>اسم الوحدة</th><th class="text-center" style="width:140px">النقطة (/20)</th><th class="text-center" style="width:80px">حذف</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($wahedat as $j => $w): ?>
                            <tr>
                                <td><?= $j+1 ?></td>
                                <td><?= htmlspecialchars($w['nom_wahda']) ?></td>
                                <td class="text-center">
                                    <?php if ($w['nuqta'] !== null): ?>
                                    <span class="badge <?= $w['nuqta']>=10?'bg-success':'bg-danger' ?> fs-6"><?= number_format((float)$w['nuqta'],2) ?></span>
                                    <?php else: ?>
                                    <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="index.php?action=edit_wahda&id=<?= $w['id'] ?>" class="btn btn-icon btn-outline-warning" title="تعديل"><i class="fas fa-edit"></i></a>
                                        <a href="index.php?action=delete_wahda&id=<?= $w['id'] ?>" class="btn btn-icon btn-outline-danger" onclick="return confirm('حذف الوحدة؟')" title="حذف"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <?php
                            $with_notes = array_filter($wahedat, fn($w) => $w['nuqta'] !== null);
                            if (!empty($with_notes)):
                                $moyenne = array_sum(array_column($with_notes,'nuqta')) / count($with_notes);
                            ?>
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <td colspan="2" class="text-end">المعدل:</td>
                                    <td class="text-center"><span class="badge <?= $moyenne>=10?'bg-success':'bg-danger' ?> fs-6"><?= number_format($moyenne,2) ?></span></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <?php endif; ?>
                        </table>
                    </div>
                    <?php endif; ?>

                    <!-- Add wahda form -->
                    <div class="border rounded p-3 bg-light">
                        <h6 class="mb-3"><i class="fas fa-plus-circle me-1 text-primary"></i>إضافة وحدة جديدة</h6>
                        <form method="POST" action="index.php?action=create_wahda" class="row g-2 align-items-end">
                            <input type="hidden" name="fasl_id" value="<?= $fasl['id'] ?>">
                            <input type="hidden" name="talib_id" value="<?= $talib['id'] ?>">
                            <div class="col-12 col-md-6"><label class="form-label small mb-1">اسم الوحدة <span class="text-danger">*</span></label><input type="text" name="nom_wahda" class="form-control form-control-sm" placeholder="مثال: القانون الدستوري" required></div>
                            <div class="col-6 col-md-3"><label class="form-label small mb-1">النقطة (0—20)</label><input type="number" name="nuqta" class="form-control form-control-sm" min="0" max="20" step="0.25" placeholder="—"></div>
                            <div class="col-6 col-md-3"><button type="submit" class="btn btn-primary btn-sm w-100 mt-3"><i class="fas fa-plus me-1"></i>إضافة</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
