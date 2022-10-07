import './bootstrap';

$(document).ready(function () {
    let API_ENDPOINT = 'api/'

    $('body').on('click', '.short-link', function () {
        let id = $(this).attr('data-id');
        let self = $(this);
        $.ajax({
            url: API_ENDPOINT + "tracking/" + id,
            method: "post",
            data: {'link_id': id},
            success: function (response) {
                self.parent('td').siblings('.tracking').text(response)
            },
            error: function (error) {

            }
        });
    })
})
