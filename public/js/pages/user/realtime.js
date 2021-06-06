$(document).ready(function() {

    var alive = setInterval(IamAlive, 30000);

    function IamAlive() {
        $.ajax({
            type: 'POST',
            url : base_url_s + '/user/iamAlive',
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
            },
            success: function(response) {
            }
        })
    };

    var fresh = setInterval(refresh, 60050);

    function refresh() {
        $.ajax({
            type: 'POST',
            url : base_url_s + '/user/refresh_data',
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
            },
            success: function(response) {
            }
        })
    }
});