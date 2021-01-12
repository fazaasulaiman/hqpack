$( document ).ready(function() {
   $('#validate2').click(function () {
        if ( $('#password').parsley().validate()){
            save();
        }
        else
        {
          gagal();
        }
    });
   $('#validate1').click(function () {
        if ( $('#user').parsley().validate()){
            user();
        }
        else
        {
          gagal();
        }
    });
});

function save(){
    $('#validate2').text('Submit...'); //change button text
    $('#validate2').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/changePassword",
        type: "POST",
        data: $('#password').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#password')[0].reset();
                $('#validate2').text('Submit'); 
                $('#validate2').attr('disabled',false);
                
                
            }else{
                info('password lama yang dimasukan salah');
            }
            $('#validate2').text('Submit'); //change button text
            $('#validate2').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('error update data');
            $('#validate2').text('Submit'); //change button text
            $('#validate2').attr('disabled',false); //set button enable 

        }
    });
}
function user(){
    $('#validate1').text('Submit...'); //change button text
    $('#validate1').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/changeUser",
        type: "POST",
        data: $('#user').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#user')[0].reset();
                $('#validate1').text('Submit'); 
                $('#validate1').attr('disabled',false);
                location.reload();
                
            }else{
                info('password yang dimasukan salah');
            }
            $('#validate1').text('Submit'); //change button text
            $('#validate1').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('error update data');
            $('#validate1').text('Submit'); //change button text
            $('#validate1').attr('disabled',false); //set button enable 

        }
    });
}