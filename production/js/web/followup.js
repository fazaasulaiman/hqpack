$(document).ready(function() {
    var hash = window.location.hash.substring(1); //get the string after the hash
 console.log(hash);
if(hash =='view'){
 $('#panelone').remove();
 $("#headingTwo").removeClass( "collapsed" );
 $("#collapseTwo").attr('class', 'panel-collapse collapse in');
 $("#headingTwo,#collapseTwo").attr("aria-expanded", "true");
}
     table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runfollowup",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
            
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
           
            },
        ],
        rowCallback: function(row, data, index){
                var d = new Date(data[4]);
                if(Date.now() >= d){
                /*$('td', row).css('background-color', '#fc0349');*/
                 $(row).addClass('red');
              }
            
        }
        /*dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data Konsumen Per tanggal '+ today,
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8],
                }
               
            },
            {
                extend: 'pdfHtml5',
                title: 'Data Konsumen Per tanggal '+ today,
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8],
                },
                orientation: 'landscape',
                
            }, 
        ]
*/        

    });
    $('#s2konsumen').select2({
    	placeholder: 'ketik nama konsumen',
    	allowClear: true,
      width: '100%',
    	ajax: {
    		url: site_url+'Master/sugestkonsumen',
    		dataType: 'json',
    		type: "GET",
            delay: 250,
            data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data, page) {
              return {
                results: data
              };
            },
  		},
    });
  });

$('#validate').click(function () {
    if ( $('#followup').parsley().validate()){
        save();
    }
    else
    {
      gagal();
    }
});
$('#validate2').click(function () {
    if ( $('#formubah').parsley().validate()){
        update();
    }
    else
    {
      gagal();
    }
});
function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addfollowup",
        type: "POST",
        data: $('#followup').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#followup')[0].reset();
                $('#s2konsumen').val('').trigger('change');
                $('#send').text('Submit'); 
                $('#send').attr('disabled',false);
                table.ajax.reload(null,false);
                
            }else{
                info(data.ket);
            }
            $('#send').text('Submit'); //change button text
            $('#send').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('error update data');
            $('#send').text('Submit'); //change button text
            $('#send').attr('disabled',false); //set button enable 

        }
    });
}
function update(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/upfollowup",
        type: "POST",
        data: $('#formubah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#modubah').modal('hide');
                $('#update').text('Submit'); 
                $('#update').attr('disabled',false);
                table.ajax.reload(null,false);
                
            }
            $('#update').text('Submit'); //change button text
            $('#update').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('error update data');
            $('#send').text('Submit'); //change button text
            $('#send').attr('disabled',false); //set button enable 

        }
    });
}
function edit(id)
{
   var url = site_url+"Master/getfollowup/";
    $('#formubah')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

           $('#id').val(data.id);
            $('#konsumenup').val(data.konsumen);
            $('#barangup').val(data.barang);
            $('#tgl_orderup').val(data.tgl_order);
            $('#next_orderup').val(data.next_order);
            $('#modubah').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
    });
}
function hapus(id,ket){
      if(confirm('apakah ada yakin ingin menghapus data ini "'+ket+'"')){
    var url = site_url+"Master/hpsfollowup/";
  $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            
             if(data.status){
                berhasil();
               table.ajax.reload(null,false);
            } 
        }
     });
  } 
  else {
    return false;
  }
    
}