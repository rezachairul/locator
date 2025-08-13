// ===============================
// Scroll halaman ke atas dengan animasi halus
// ===============================
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
}

// ===============================
// Terapkan tema (terang/gelap) dan invert ikon sesuai tema
// ===============================
function applyTheme() {
    const theme = document.body.classList.contains("dark") ? "dark" : "light";
    const icons = document.querySelectorAll(".invert-icon img");

    icons.forEach((icon) => {
        icon.style.filter = theme === "light" ? "invert(1)" : "invert(0)";
    });
}

// ===============================
// Setup fungsi modal (toggle & hide)
// ===============================
function setupModals() {
    const modalToggleBtns = document.querySelectorAll("[data-modal-toggle]");
    const modalHideBtns = document.querySelectorAll("[data-modal-hide]");

    // Tampilkan atau sembunyikan modal
    modalToggleBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            const modalId = btn.getAttribute("data-modal-toggle");
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.toggle("hidden");
        });
    });

    // Sembunyikan modal saat tombol close diklik
    modalHideBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            const modalId = btn.getAttribute("data-modal-hide");
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add("hidden");
                // Reset form dalam modal jika ada
                const form = modal.querySelector("form");
                if (form) form.reset();
            }
        });
    });
}

// ===============================
// Ubah favicon berdasarkan halaman saat ini
// ===============================
function updateFavicon() {
    const currentPage = window.location.pathname;
    const favicon = document.getElementById("favicon");
    const baseUrl = favicon.dataset.baseUrl || "{{ asset('assets/img') }}";

    const iconMap = {
        "/operator/user-report": "menu-icons/user-report.png",
        "/operator": "logo-locatorgis/locatorgis-logo.png",
    };

    for (const [key, value] of Object.entries(iconMap)) {
        if (currentPage.includes(key)) {
            favicon.href = `${baseUrl}/${value}?v=${new Date().getTime()}`;
            break;
        }
    }
}

// ===============================
// Eksekusi ketika DOM telah siap
// ===============================
document.addEventListener("DOMContentLoaded", function () {
    applyTheme(); // Terapkan tema awal
    setupModals(); // Inisialisasi modal
    updateFavicon(); // Ubah favicon sesuai halaman

    // Fungsi toggle tema saat tombol diklik
    const themeToggleButton = document.getElementById("theme-toggle");
    if (themeToggleButton) {
        themeToggleButton.addEventListener("click", function () {
            document.body.classList.toggle("dark");
            applyTheme();
        });
    }
});

// ===============================
// Fungsi Search AJAX Dinamis
// ===============================
$(document).ready(function () {
    $("#search-input").on("input", function () {
        let query = $(this).val();
        let url = $(this).data("url");
        let target = $(this).data("target");

        console.log("AJAX triggered:", query, url, target);

        $.ajax({
            url: url,
            type: "GET",
            data: { search: query },
            success: function (data) {
                console.log("AJAX success:", data);
                $("#" + target).html(data);
            },
            error: function (xhr) {
                console.log("AJAX error:", xhr.responseText);
            },
        });
    });
});
