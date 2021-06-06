function delete_survey(survey_id) {
    swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this Survey Data!",   
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
                url: base_url + '/user/survey/delete',
                data: {
                    _token: $("[name='_token']").val(),
                    survey_id: survey_id
                },
                success: function(response) {
                    if(response == 'success') {
                        location.reload();
                    }
                    else if(response == 'running') {
                        toastr.error("This survey is running. you could not delete this survey.", 'Error', { "closeButton": true });
                    }
                }
            }) 
        }
    });
}

function delete_question(index) {
    swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this Question Data!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false 
    }).then(result => {
        if (result.value) {    
            $("#questiondiv_" + index).remove();
        }
    });
}

function create_new_answer(index) {
    var category = $("#question_cat_" + index).val();
    var html = '';
    $("#answer_wrapper_" + index).empty();
    if(category == '1') {
        var smiles_html = '';
        for(var i=0; i<smiles.length; i++) {
            smiles_html += `<option value="${smiles[i].id}" style="background-image:url(${base_url}/storage/${smiles[i].content}); background-repeat: no-repeat; background-size: contain; padding-left: 40px; margin-left: 5px; height: 30px; display: flex; align-items: center;">`+
                smiles[i].name+
            `</option>`;
        }
        
        html = `<div class="form-group">`+
                `<label for="answer_content_${index}" class="control-label col-form-label">Answer</label>`+
                `<select multiple="multiple" size="10" class="duallistbox" id="answer_content_${index}" name="answer_content[${index}][]" required>`+
                    smiles_html+
                `</select>`+
                `<sm>Please select answer smiles</sm>`+
            `</div>`;
    }
    else if(category == '2'){
        html = `<div class="form-group">`+
                `<label for="answer_content_${index}" class="control-label col-form-label">Answer</label>`+
                `<textarea class="form-control" id="answer_content_${index}" name="answer_content[${index}][]" required></textarea>`+
                `<sm>Please enter answer</sm>`+
            `</div>`;
    }
    else {
        html = `<div class="form-group">`+
                `<label for="answer_content_${index}" class="control-label col-form-label">Answer</label>`+
                `<input type="number" class="form-control" id="answer_content_${index}" name="answer_content[${index}][]" require min="0">`+
                `<sm>Please enter count of ladder</sm>`+
            `</div>`;
    }

    $("#answer_wrapper_" + index).html(html);
    $('.duallistbox').bootstrapDualListbox();
    $("#create_new_answer_" + index).attr('key', 1);
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

function change_status(obj, survey_id) {
    if($(obj).prop('checked') == true) {
        $.ajax({
            type: 'POST',
            url: base_url + '/user/survey/status',
            data: {
                _token: $("[name='_token']").val(),
                survey_id: survey_id
            },
            success: function(response) {
                if(response == 'success') {
                    location.reload();
                }
            }
        }) 
    }
}
$("#branch").on('change', function() {
    var branch = $(this).val();
    let getForm = $('#branchForm')
    $('#branchId').val(branch)
    $('#branchForm').submit()
    
    // $.ajax({
    //     type: 'GET',
    //     url: base_url + `/user/survey/list/${branch}`,
    //     data: {
    //         _token: $("[name='_token']").val(),
    //         branch: branch
    //     },
    //     sucess: function(response) {
    //         console.log(response)
    //         // if(response == 'sucess') {
    //         //     document.location.reload();
    //         // }
    //     } 
    // })
});
$(document).ready(function() {
    if($("#survey_list").length > 0) {
        $('#survey_list').DataTable({
            "order": [
                [5, 'desc']
            ],
        });
    }

    if($('.duallistbox').length > 0) {
        $('.duallistbox').bootstrapDualListbox();
    }

    var variation = "",
        textVariation = "",
        textColor = "";
    var color = $("#languages").data('bgcolor');
    variation = $("#languages").data('bgcolor-variation');
    textVariation = $("#languages").data('text-variation');
    textColor = $("#languages").data('text-color');
    if (variation !== "") {
        variation = " bg-" + variation;
    }
    if (textVariation !== "") {
        textVariation = " " + textVariation;
    }
    var className = "bg-" + color + variation + " " + textColor + textVariation + " border-" + color;

    if($("#languages").length > 0) {
        $("#languages").select2({
            dropdownCssClass: className,
            minimumResultsForSearch: Infinity,
            templateResult: iconFormat,
            templateSelection: iconFormat,
            escapeMarkup: function(es) { return es; }
        });
    }

    show_error();
    show_success();

    function iconFormat(ficon) {
        var originalOption = ficon.element;
        if (!ficon.id) { return ficon.text; }
        var $ficon = "<i class='flag-icon flag-icon-" + $(ficon.element).data('flag') + "'></i>" + ficon.text;
        return $ficon;
    }

    $("#create_new_question").on('click', function() {
        var obj = $("[id ^= 'questiondiv_']");
        var length_index = obj.length;
        var last_obj = obj[length_index-1];
        var last_id = $(last_obj).attr('id');

        var index = last_id.split('_')[1];

        index ++;
        length_index ++;
        var html = `<div id="questiondiv_${index}" class="row">`+
            `<input type="hidden" id="question_id_${index}" name="question_id[]">`+
            `<div class="col-md-7">`+
                `<div class="form-group">`+
                    `<label for="question_description_${index}" class="control-label col-form-label">Question</label>`+
                    `<div class="input-group">`+
                        `<input type="text" class="form-control" id="question_description_${index}" name="question_description[]" required/>`+
                    `</div>`+
                `</div>`+
            `</div>`+
            `<div class="col-md-2">`+
                `<div class="form-group">`+
                    `<label for="question_class_0" class="control-label col-form-label">Class</label>`+
                    `<select class="form-control" id="question_class_${index}" name="question_class[]" required>`+
                        `<option value="1">About our employee</option>`+
                        `<option value="2">About our service</option>`+
                        `<option value="3">About our environment</option>`+
                        `<option value="4">None of the above</option>`+
                    `</select>`+
                `</div>`+
            `</div>`+
            `<div class="col-md-2">`+
                `<div class="form-group">`+
                    `<label for="question_cat_0" class="control-label col-form-label">Answer Kind</label>`+
                    `<select class="form-control" id="question_cat_${index}" name="question_cat[]" required>`+
                        `<option value="1">smiley</option>`+
                        `<option value="2">text Field</option>`+
                        `<option value="3">ladder</option>`+
                    `</select>`+
                `</div>`+
            `</div>`+
            `<div class="col-md-1">`+
                `<div class="form-group">`+
                    `<div class="action-form m-b-0 text-left" style="margin-top: 35px;">`+
                        `<button type="button" key="0" id="create_new_answer_${index}" class="btn btn-success" style="margin-right:20px;" onclick="create_new_answer(${index})">`+
                            `<i class="fa fa-plus"></i>`+
                        `</button>`+
                        `<button type="button" id="delete_question_${index}" class="btn btn-danger" onclick="delete_question(${index})">`+
                            `<i class="fa fa-trash"></i>`+
                        `</button>`+
                    `</div>`+
                `</div>`+
            `</div>`+
            `<div class="col-md-12" id="answer_wrapper_${index}"></div>`+
        `</div>`+
        `<hr />`;

        $("#questions_wrapper").append(html);
    })

    $("#save_btn").on('click', function() {
        
        var obj = $("[id ^= 'create_new_answer_']");
        var flag = 0;
        for(var i=0; i<obj.length; i++) {
            var key = $(obj[i]).attr('key');
            if(key == 0) {
                flag = 1;
                break;
            }
        }

        if(flag == 1) {
            toastr.error('You did not fill all answer. Please check it again', 'Error', { "closeButton": true });
            return;
        }
        else {
            $("#survey_form").submit();
        }
    });
});