$(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $("#url").on('change', function(){
        readURL(this);
    });
    
    $("#logo").on('click', function() {
       $("#url").click();
    });
});