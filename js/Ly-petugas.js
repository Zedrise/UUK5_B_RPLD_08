function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.remove('show');
    overlay.classList.remove('show');
}


document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        closeSidebar();
    }
});
