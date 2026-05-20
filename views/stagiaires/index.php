<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div>
        <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li><li class="breadcrumb-item active">المتدربون</li></ol></nav>
        <h2><i class="fas fa-user-clock me-2"></i>المتدربون</h2>
        <p class="sub"><?= count($stagiaires) ?> متدرب(ة) مسجل(ة)</p>
    </div>
    <a href="index.php?action=create_stagiaire" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>إضافة متدرب
    </a>
</div>

<?php if (isset($_GET['success'])): ?>
<div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>تمت العملية بنجاح.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <span><i class="fas fa-list me-2"></i>قائمة المتدربين</span>
        <div class="d-flex gap-2">
            <select id="filterStatut" class="form-select form-select-sm" style="width:130px">
                <option value="">الكل</option>
                <option value="actif">نشط</option>
                <option value="termine">منتهي</option>
            </select>
            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="بحث…" style="width:180px">
        </div>
    </div>
    <div class="card-body p-0">
        <?php if (empty($stagiaires)): ?>
        <div class="empty-state"><i class="fas fa-user-clock"></i><p>لا يوجد متدربون بعد</p><a href="index.php?action=create_stagiaire" class="btn btn-primary btn-sm">إضافة أول متدرب</a></div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="stagTable">
                <thead><tr><th>الاسم</th><th>المصلحة</th><th>التخصص</th><th>البداية</th><th>النهاية</th><th>الحالة</th><th class="text-center">إجراءات</th></tr></thead>
                <tbody>
                <?php foreach ($stagiaires as $s): ?>
                <tr data-statut="<?= $s['statut'] ?>">
                    <td class="fw-bold"><?= htmlspecialchars($s['nom']) ?></td>
                    <td><?= htmlspecialchars($s['service_nom'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($s['specialite'] ?? '—') ?></td>
                    <td><?= $s['date_debut'] ? date('d/m/Y',strtotime($s['date_debut'])) : '—' ?></td>
                    <td>
                        <?= $s['date_fin'] ? date('d/m/Y',strtotime($s['date_fin'])) : '—' ?>
                        <?php require_once __DIR__ . '/../../config/helpers.php'; echo expiresLabel($s['date_fin'] ?? null); ?>
                    </td>
                    <td><span class="badge bs-<?= $s['statut'] ?>"><?= $s['statut']==='actif'?'نشط':'منتهي' ?></span></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="index.php?action=show_stagiaire&id=<?= $s['id'] ?>" class="btn btn-icon btn-outline-primary" title="عرض"><i class="fas fa-eye"></i></a>
                            <a href="index.php?action=edit_stagiaire&id=<?= $s['id'] ?>" class="btn btn-icon btn-outline-warning" title="تعديل"><i class="fas fa-edit"></i></a>
                            <button onclick="confirmDelete('index.php?action=delete_stagiaire&id=<?= $s['id'] ?>','<?= htmlspecialchars(addslashes($s['nom'])) ?>')" class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
const si=document.getElementById('searchInput'), sf=document.getElementById('filterStatut');
function applyFilters(){const q=si?.value.toLowerCase()||'',s=sf?.value||'';document.querySelectorAll('#stagTable tbody tr').forEach(r=>{r.style.display=((!q||r.textContent.toLowerCase().includes(q))&&(!s||r.dataset.statut===s))?'':'none'});}
si?.addEventListener('input',applyFilters);sf?.addEventListener('change',applyFilters);
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
