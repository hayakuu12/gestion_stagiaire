// Sidebar toggle
const toggleBtn = document.getElementById('sidebarToggle');
const sidebar   = document.getElementById('sidebar');
const content   = document.getElementById('content');

if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('mobile-show');
        } else {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('expanded');
        }
    });
}

// Delete confirmation
function confirmDelete(url, name) {
    const msg = name
        ? `Supprimer "${name}" ? Cette action est irréversible.`
        : 'Êtes-vous sûr de vouloir supprimer cet enregistrement ?';
    if (confirm(msg)) window.location.href = url;
}

// Auto-dismiss alerts
document.querySelectorAll('.alert-auto').forEach(el => {
    setTimeout(() => el.remove(), 4000);
});
