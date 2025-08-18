document.addEventListener('DOMContentLoaded', function () {
    const notifToggle = document.getElementById('notif-toggle');
    const notifDropdown = document.getElementById('notif-dropdown');
    const notifList = document.getElementById('notif-list');
    const notifBadge = document.getElementById('notif-badge');

    notifToggle.addEventListener('click', () => {
        notifDropdown.classList.toggle('hidden');
    });

    function getIconAndColor(status) {
        switch (status) {
            case 'pending':
                return {
                    colorClass: 'text-yellow-500',
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-yellow-500 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                           </svg>`
                };
            case 'in_progress':
                return {
                    colorClass: 'text-blue-500',
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500 animate-spin inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                           </svg>`
                };
            case 'closed':
                return {
                    colorClass: 'text-green-500',
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                           </svg>`
                };
            default:
                return {
                    colorClass: 'text-gray-500',
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                           </svg>`
                };
        }
    }

    function loadNotifications() {
        fetch(window.NOTIF_API_URL)
            .then(res => res.json())
            .then(data => {
                notifList.innerHTML = '';
                if (data.length === 0) {
                    notifList.innerHTML = `<li class="p-3 text-gray-500 dark:text-gray-400 text-sm">Belum ada notifikasi</li>`;
                    notifBadge.classList.add('hidden');
                    return;
                }

                notifBadge.textContent = data.length;
                notifBadge.classList.remove('hidden');

                data.forEach(notif => {
                    const { colorClass, icon } = getIconAndColor(notif.data.status);

                    const li = document.createElement('li');
                    li.className = `flex items-start p-3 gap-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer`;

                    li.innerHTML = `
                        <div>${icon}</div>
                        <div class="flex-1 text-sm text-gray-700 dark:text-gray-300">${notif.data.message}</div>
                        <button class="ml-2 text-gray-400 hover:text-red-500 delete-notif" data-id="${notif.id}">&times;</button>
                    `;

                    // Klik notif = hapus & redirect
                    li.addEventListener('click', (e) => {
                        if (!e.target.classList.contains('delete-notif')) {
                            deleteNotification(notif.id, () => {
                                window.location.href = notif.data.url;
                            });
                        }
                    });

                    // Klik tombol X
                    li.querySelector('.delete-notif').addEventListener('click', (e) => {
                        e.stopPropagation();
                        deleteNotification(notif.id);
                    });

                    notifList.appendChild(li);
                });
            });
    }

    function deleteNotification(id, callback) {
        fetch(window.NOTIF_DELETE_URL.replace(':id', id), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        }).then(() => {
            loadNotifications();
            if (callback) callback();
        });
    }

    loadNotifications();
    setInterval(loadNotifications, 5000);
});
