function delete_rating(rating_id) {
    swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this Rating!",   
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
                url: base_url + '/user/rating/delete',
                data: {
                    _token: $("[name='_token']").val(),
                    rating_id: rating_id
                },
                success: function(response) {
                    if(response == 'success') {
                        location.reload();
                    }
                    else if(response == 'running') {
                        toastr.error("This template is running. you could not delete this template.", 'Error', { "closeButton": true });
                    }
                }
            }) 
        }
    });
}

$(document).ready(function() {
    if($("#rating_list").length > 0) {
        $('#rating_list').DataTable({
            "order": [
                [3, 'desc']
            ]
        });
    }

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.smile_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $("#url").on('change', function(){
        readURL(this);
    });
    
    $("#smile_photo").on('click', function() {
       $("#url").click();
    });
});