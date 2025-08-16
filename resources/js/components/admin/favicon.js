export function initFavicon() {
    const currentPage = window.location.pathname;
    const favicon = document.getElementById("favicon");
    if (!favicon) return;

    const baseUrl = favicon.dataset.baseUrl;

    const iconMap = {
        "/admin/maps": 'menu-icons/maps.png',
        "/admin/operator": 'menu-icons/operator.png',
        "/admin/operasional/operasional": 'menu-icons/op_mining-2.png',
        "/admin/operasional/exca": 'menu-icons/excavator.png',
        "/admin/operasional/dump": 'menu-icons/dump-truck.png',
        "/admin/operasional/weather": 'menu-icons/cloud.png',
        "/admin/operasional/waterdepth": 'menu-icons/water-waves.png',
        "/admin/operasional/material": 'menu-icons/mineral.png',
        "/admin/laporan-user/incident-user": 'menu-icons/incident-user.png',
        "/admin/informasi/tentang-sistem": 'menu-icons/about-system.png',
        "/admin/informasi/bantuan": 'menu-icons/panduan.png',
        "/admin/informasi/kontak": 'menu-icons/contact.png',
        "/admin": 'dashboard.png',
    };

    for (const [key, value] of Object.entries(iconMap)) {
        if (currentPage.includes(key)) {
            favicon.href = `${baseUrl}/${value}?v=${new Date().getTime()}`;
            break;
        }
    }
}

// supaya bisa dipanggil inline
window.initFavicon = initFavicon;