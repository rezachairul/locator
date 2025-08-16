export function initSearch() {
    $('#search-input').on('input', function () {
        let query = $(this).val();
        let url = $(this).data('url');
        let target = $(this).data('target');

        $.ajax({
            url: url,
            type: "GET",
            data: { search: query },
            success: function (data) {
                $('#' + target).html(data);
            },
            error: function (xhr) {
                console.log('AJAX error:', xhr.responseText);
            }
        });
    });
}

// supaya bisa dipanggil inline
window.initSearch = initSearch;