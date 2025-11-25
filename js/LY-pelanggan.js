function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const content = document.querySelector('.content');

    if (window.innerWidth <= 768) {
        // MOBILE MODE → slide in/out
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    } else {
        // DESKTOP MODE → collapse
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('collapsed');
    }
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
}
