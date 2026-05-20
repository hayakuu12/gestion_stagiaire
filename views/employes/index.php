<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="page-header">
    <div><h2><i class="fas fa-user-tie me-2"></i>الموظفون</h2><p class="sub"><?= count($employes) ?> موظف(ة)</p></div>
    <a href="index.php?action=create_employe" class="btn btn-primary"><i class="fas fa-plus me-2"></i>إضافة موظف</a>
</div>
<?php if (isset($_GET['success'])): ?><div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>تمت العملية بنجاح.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

<div class="card">
    <div class="card-header"><span><i class="fas fa-list me-2"></i>قائمة الموظفين</span><input type="text" id="searchInput" class="form-control form-control-sm" placeholder="بحث…" style="width:180px"></div>
    <div class="card-body p-0">
        <?php if (empty($employes)): ?>
        <div class="empty-state"><i class="fas fa-user-tie"></i><p>لا يوجد موظفون مسجلون</p></div>
        <?php else: ?>
        <table class="table table-hover mb-0" id="empTable">
            <thead><tr><th>الاسم الكامل</th><th>رقم البطاقة الوطنية</th><th>الهاتف</th><th>التخصص</th><th class="text-center">إجراءات</th></tr></thead>
            <tbody>
            <?php foreach ($employes as $e): ?>
            <tr>
                <td class="fw-bold"><?= htmlspecialchars($e['nom_complet']) ?></td>
                <td><code><?= htmlspecialchars($e['cin']??'—') ?></code></td>
                <td><?= htmlspecialchars($e['telephone']??'—') ?></td>
                <td><?= htmlspecialchars($e['specialite']??'—') ?></td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">
                        <a href="index.php?action=edit_employe&id=<?= $e['id'] ?>" class="btn btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
                        <button onclick="confirmDelete('index.php?action=delete_employe&id=<?= $e['id'] ?>','<?= htmlspecialchars(addslashes($e['nom_complet'])) ?>')" class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<script>document.getElementById('searchInput')?.addEventListener('input',function(){const q=this.value.toLowerCase();document.querySelectorAll('#empTable tbody tr').forEach(r=>r.style.display=r.textContent.toLowerCase().includes(q)?'':'none')});</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
