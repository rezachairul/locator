document.addEventListener("DOMContentLoaded", function () {
    function getBadgeColor(category) {
        switch (category) {
            case "Ringan": return "bg-green-500";
            case "Sedang": return "bg-yellow-400";
            case "Berat": return "bg-orange-500";
            case "Fatal": return "bg-red-600";
            default: return "bg-gray-400";
        }
    }

    function loadNotifications() {
        fetch("/notifications")
            .then(res => res.json())
            .then(data => {
                // Update badge
                let badge = document.querySelector("#notif-badge");
                if (badge) badge.remove(); // hapus badge lama

                if (data.count > 0) {
                    let notifButton = document.querySelector("[aria-label='Notifications']");
                    let span = document.createElement("span");
                    span.id = "notif-badge";

                    // ambil kategori dari notifikasi terbaru
                    let latestCategory = data.data[0]?.injury_category || null;
                    let badgeColor = getBadgeColor(latestCategory);

                    span.className = `absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-2 -translate-y-2 ${badgeColor} border-2 border-white rounded-full`;
                    notifButton.appendChild(span);
                }

                // Update dropdown
                let notifList = document.querySelector("#notif-list");
                if (notifList) {
                    notifList.innerHTML = "";
                    if (data.data.length > 0) {
                        data.data.forEach(n => {
                            notifList.innerHTML += `
                                <li class="flex">
                                    <a href="${n.url}" class="inline-flex items-start w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                        <div class="flex flex-col">
                                            <span class="font-bold">${n.title}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">${n.body}</span>
                                        </div>
                                    </a>
                                </li>
                            `;
                        });
                    } else {
                        notifList.innerHTML = `
                            <li class="px-2 py-1 text-sm text-yellow-800 dark:text-yellow-200 flex items-center space-x-2">
                                <span>⛏️</span>
                                <span>Belum ada notifikasi insiden di area kerja tambang.</span>
                            </li>
                        `;
                    }
                }
            })
            .catch(err => console.error("Error load notif:", err));
    }

    // Load pertama kali
    loadNotifications();

    // Polling tiap 5 detik
    setInterval(loadNotifications, 5000);
});
