var nota 
 $(document).ready(function() {
 	nota = $(location).attr("href").split('/').pop();  
 	$("#nota").val(nota);
    $(".text-nota").text(nota);
 	$('#kredit,.datepicker').val('');
 	
 
 	$(".datepicker").datepicker({
    
        // The format you want
        todayHighlight: true,
        todayBtn: true,
        altFormat: "yy-mm-dd",
        autoclose: true,
        // The format the user actually sees
        format: "dd M yy",
    });
 
    table = $('#table').DataTable({ 
 		
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        "order": [], //Initial no order.
        //"paging":false, no paging
        "paging":   false,
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runtransaksiinvoice/"+nota,
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
           
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
           
            },
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.split('.').join("").replace(',', '.')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
              console.log(total+'|'+pageTotal);
            // Update footer
            $( api.column( 3 ).footer() ).html(
                'Rp'+(pageTotal).toLocaleString('id')  +' ( Rp'+ (total).toLocaleString('id') +' total)'
            );
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
    
 });
 $('#validate').click(function () {
	    if ( $('#tambah').parsley().validate()){
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

   $("#kredit").keyup(function(){
     
         var rp = formatRupiah($(this).val(), "Rp. ");
          $(this).val(rp)
    });

  $("#kreditup").keyup(function(){    

         var rp = formatRupiah($(this).val(), "Rp. ");
          $(this).val(rp)
    });

function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addtransaksiinvoice",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                 $('#tambah')[0].reset();
                 $('#nota').val(nota);
                $('.datepicker').val('');
                $('#distributor').val('').trigger('change');
                
                $('#send').text('Submit'); 
                $('#send').attr('disabled',false);
                table.ajax.reload(null,false);
               /* window.location.href = site_url+"Master/detaillaporanx#fix";*/
                
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
function hapus(id,ket){
      if(confirm('apakah ada yakin ingin menghapus data no "'+ket+'"')){
    var url = site_url+"Master/hpstransaksiinvoice/";
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
    
}function edit(id)
{
 
   var url = site_url+"Master/gettransaksiinvoice/";
    $('#formubah')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            

            $('#id').val(data.id);
            $('#tanggalup').val(data.tanggal);
            $('#keteranganup').val(data.keterangan);
            $('#kreditup').val(formatRupiah(data.kredit.replace('.',','), "Rp. "));
            $('#kredit').val(data.kredit);
            $('#catatanup').val(data.catatan);
           
           
            
            $('#modubah').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
            //$('#')[0].reset();
            
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
    });
}
function update(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
  

 $.ajax({
        context: this,
        url: site_url+"Master/uptransaksiinvoice",
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