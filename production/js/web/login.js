$(function() { 
   
$('#masuk').click(function () {
    if ( $('#formlogin').parsley().validate()){
    	masuk();
    }
    else
    {
      gagal();
    }
	});
});
function masuk(){
	$.ajax({
				context: this,
       			url: site_url+"Master/masuk",
        		type: "POST",
        		data: $('#formlogin').serialize(),
        		dataType: "JSON",
                success: function(data)
                {
                		 if(data.status)
            			{
               			$('#formlogin')[0].reset();
                         location.href = site_url+"Beranda";
            			}
            			else{
            			$('#formlogin')[0].reset();
            			new PNotify({
					    title: 'Kesalahan',
					    text: 'Kode PKM atau password anda salah',
					    type: 'error',
					    styling: 'bootstrap3',
					    delay:3000
					});
            			}
                      
               
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    
                }
            });
}