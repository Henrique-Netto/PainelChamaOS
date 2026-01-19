document.addEventListener('DOMContentLoaded', function () {
    const btnToggle = document.getElementById('btnToggleSidebar');
    const sidebar = document.getElementById('sidebar');

    if (btnToggle) {
        btnToggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
    }
});
