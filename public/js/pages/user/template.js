function delete_template(template_id) {
    swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this Template Data!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",  
    }).then(result => {
        if (result.value) {    
            $.ajax({
                type: 'POST',
                url: base_url + '/user/template/delete',
                data: {
                    _token: $("[name='_token']").val(),
                    template_id: template_id
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

function show_error() {
	var error_obj = $(".error-message");
	for(var i=0; i<error_obj.length; i++) {
		var error = $(error_obj).val();
        toastr.error(error, 'Error', { "closeButton": true });
        $(error_obj).remove();
	}
}

function show_success() {
	var success_obj = $(".success-message");
	for(var i=0; i<success_obj.length; i++) {
		var success = $(success_obj).val();
        toastr.success(success, 'Success', { "closeButton": true });
        $(success_obj).remove();
	}
}

function change_status(obj, template_id) {
    if($(obj).prop('checked') == true) {
        $.ajax({
            type: 'POST',
            url: base_url + '/user/template/status',
            data: {
                _token: $("[name='_token']").val(),
                template_id: template_id
            },
            success: function(response) {
                if(response == 'success') {
                    location.reload();
                }
            }
        }) 
    }
}


$(document).ready(function() {
    if($("#template_list").length > 0) {
        $('#template_list').DataTable({
            "order": [
                [8, 'asc']
            ]
        });
    }

    if($('.custom-select').length > 0) {
        $(".custom-select").select2({
            placeholder: "Select a Template",
            allowClear: true
        });
    }
});
