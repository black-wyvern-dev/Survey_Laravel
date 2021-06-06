function delete_user(user_id) {
    swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this imaginary file!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false 
    }).then(result => {
        if (result.value) {    
            $.ajax({
                type: 'POST',
                url: base_url + '/user/users/delete',
                data: {
                    _token: $("[name='_token']").val(),
                    user_id: user_id
                },
                success: function(response) {
                    if(response == 'success') {
                        location.reload();
                    }
                }
            })
        }
    });
}

$(document).ready(function() {
    
    if($("#user_list").length > 0) {
        $('#user_list').DataTable({
            // "scrollX": false,
            // "pageLength": 10,
            // "columnDefs": [
            //     // { "visible": false, "targets": 2 }
            // ],
            "order": [
                [4, 'asc']
            ],
            // "createdRow": function(row, data, index) {
            //     // if (data[5].replace(/[\$,]/g, '') * 1 > 150000) {
            //     //     $('td', row).eq(5).addClass('highlight');
            //     // }
            // }
        });
    }

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.user_avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $("#photo").on('change', function(){
        readURL(this);
    });
    
    $("#user_avatar").on('click', function() {
       $("#photo").click();
    });
});