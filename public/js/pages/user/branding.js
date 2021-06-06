
Dropzone.options.dpzRemoveAllThumb = {
    maxFilesize: 10,
    acceptedFiles: "image/png,image/jpeg",
    paramName: "file", // The name that will be used to transfer the file
    dataType: 'json',
    addRemoveLinks: true,
    dictRemoveFile: "delete",
    init: function () {
        for(var i=0; i<brands.length; i++) {
            var mockFile = {
            name: brands[i].url.split('/')[1],
            size: 200,
            type: 'image/*',
            serverID: i,
            accepted: true
            }; // use actual id server uses to identify the file (e.g. DB unique identifier)
    
            this.emit("addedfile", mockFile);
            
            this.emit("thumbnail", mockFile, base_url + '/storage/' + brands[i].url);
                this.emit("success", mockFile);
                this.emit("complete", mockFile);
                this.files.push(mockFile);
        }

        this.on('addedfile', function(file) {
            
        });
  
        this.on("removedfile", function(file) {
            var file_name = file.name
            $.ajax({
              url: base_url + '/user/brand/delete',
              type: 'POST',
              data: {
                _token: $("[name='_token']").val(),
                file_name: file_name
              },
              success: function(message){
                if(message == 'success') {
                  toastr.success('Delete Success', 'Success', { "closeButton": true });
                }
                else {
                  toastr.error('Delete Failure', 'Error', { "closeButton": true });
                }
              }
            });
        });
    }
}