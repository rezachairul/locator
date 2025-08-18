export function initClock() {
    function updateClock() {
        const now = new Date();
        const timeZoneOffset = now.getTimezoneOffset() / -60;

        let timeZoneName;
        if (timeZoneOffset === 7) timeZoneName = "WIB";
        else if (timeZoneOffset === 8) timeZoneName = "WITA";
        else if (timeZoneOffset === 9) timeZoneName = "WIT";
        else timeZoneName = `GMT${timeZoneOffset >= 0 ? "+" : ""}${timeZoneOffset}`;

        const formattedDate = new Intl.DateTimeFormat('id-ID', {
            day: '2-digit', month: 'long', year: 'numeric',
        }).format(now);

        const formattedTime = new Intl.DateTimeFormat('id-ID', {
            hour: '2-digit', minute: '2-digit', second: '2-digit',
        }).format(now);

        const dateTimeString = `${formattedDate}, ${formattedTime} ${timeZoneName}`;
        const el = document.getElementById('local_time');
        if (el) el.textContent = dateTimeString;
    }

    updateClock();
    setInterval(updateClock, 1000);
}

// supaya bisa dipanggil inline
window.initClock = initClock;

// 🔥 auto-jalankan saat DOM siap
document.addEventListener("DOMContentLoaded", initClock);
