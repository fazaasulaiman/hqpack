$(document).ready(function() {
	$('#validate').click(function () {
        window.Parsley.addValidator('maxFileSize', {
            validateString: function(_value, maxSize, parsleyInstance) {
            if (!window.FormData) {
              alert('anda membuat semua programmer takut :( . Update dong Browsernya :) ya');
              return true;
            }
            var files = parsleyInstance.$element[0].files;
            return files.length != 1  || files[0].size <= maxSize * 1024;
          },
          requirementType: 'integer',
          messages: {
            en: 'This file should not be larger than %s Kb',
            id: "File harus kurang dari %s Kb."
          }
    });
    if ( $('#form').parsley().validate()){
    		save();
        }else{
      gagal();
    	}
	});

});
function save(){
	var formData = new FormData($('#form')[0]);
 $.ajax({
        url : site_url+"Upload/upload",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        beforeSend: function() {
            $('body').loading();
        },
        success: function(data)
        {
            if(data.status){
              $('body').loading('stop');
              berhasil();
              $(".fileinput").fileinput("clear");
              $('#form').get(0).reset();

            }else{
             info(data.ket);
            }


        }
    });
}