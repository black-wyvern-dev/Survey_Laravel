function delete_device(device_id) {
    swal({   
        title: "Are you sure?",   
        text: "You will not be able to recover this Device Data!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        // closeOnConfirm: true,   
        // closeOnCancel: false 
    }).then(result => {
        if (result.value) {    
            $.ajax({
                type: 'POST',
                url: base_url + '/user/device/delete',
                data: {
                    _token: $("[name='_token']").val(),
                    device_id: device_id
                },
                success: function(response) {
                    console.log(response);
                    if(response == 'success') {
                        location.reload();
                    }
                }
            }) 
        }
    });
}

$(document).ready(function() {
    $('#device_list').DataTable({
        // "scrollX": false,
        // "pageLength": 10,
        // "columnDefs": [
        //     // { "visible": false, "targets": 2 }
        // ],
        "order": [
            [3, 'asc']
        ],
        // "createdRow": function(row, data, index) {
        //     // if (data[5].replace(/[\$,]/g, '') * 1 > 150000) {
        //     //     $('td', row).eq(5).addClass('highlight');
        //     // }
        // }
    });
});