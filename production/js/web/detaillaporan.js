var param1,param2 = 1;
var checksum1,checksum2= 0
$(document).ready(function() {
//nota();
/*var url = window.location.href.replace(/\/$/, '');  
var lastSeg = url.substr(url.lastIndexOf('/') + 1);*/

$("#resetfilter").closest('form').on('reset', function(event) {
  $("#cariprogress").val('').trigger('change');
});
  
    $("#harga,#qty").keyup(function(){

        // Getting the current value of textarea


        var value = $(this).attr("name");
        
        var hasil = perkalian($(this).val(),$(this).attr("name"));
        if ($(this).attr("id") == 'harga') {
          //$(this).val($(this).val().toLocaleString('id'));
          var rp = formatRupiah($(this).val(), "Rp. ");
          $(this).val(rp)
        }
        $('#penjualan').val(hasil)

    });
    $("#hargaup,#qtyup").keyup(function(){

        // Getting the current value of textarea


        var value = $(this).attr("name");
        console.log($(this).val());
        console.log($(this).attr("name"));
        var hasil = perkalian($(this).val(),$(this).attr("name"));
         if ($(this).attr("id") == 'hargaup') {
          //$(this).val($(this).val().toLocaleString('id'));
          var rp = formatRupiah($(this).val(), "Rp. ");
          $(this).val(rp)
        }
        $('#penjualanup').val(hasil)

    });


 $('#cariprogress').select2({

      placeholder: 'Ketikan disini',
      
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/status_invoice',
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
 /* nota = $('#carinota').val();
  if (lastSeg && typeof lastSeg == 'number') {
    nota = lastSeg;  
  }*/
    
  
  console.log(nota);
  table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runlabarugi",
            "type": "POST",
             "data": function ( data ) {
                data.tanggal = $('#caritgl1').val()+'|'+$('#caritgl2').val();
                data.nota = $('#carinota').val();
                data.konsumen = $('#carikonsumen').val();
                data.barang = '';
                data.hpp = '';
                data.qty = '';
                data.harga = '';
                data.penjualan = '';
                data.laba_kotor = '';
                data.status = $('#caristatus').val();
                data.progress = $('#cariprogress').val();
            }
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
           
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
           
            },
        ],
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
 setInterval(check, 5000);

  var hash = window.location.hash.substring(1); //get the string after the hash
  });
 $('#filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);
       
     
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
function perkalian(val,param){

  param=='qty' ? param1 = val : param2 = val.split(".").join("");
  var jumlah = param1*param2;
  return jumlah.toLocaleString('id');
  
}
function nota(){

 today = Math.round((new Date()).getTime()/1000);
 $("#nota").val(today);
}
function format (d) {
 
     var rowId = d[3];
    // `d` is the original data object for the row
    //row.child('<table id="#'+rowId+'" class="table table-striped child_table dt-responsive"><thead><tr><th>No</th><th>Nota</th><th>Tanggal</th><th>Distributor</th><th>Barang</th><th>Qty</th><th>Harga</th><th>Jumlah</th><th>Aksi</th></tr></thead><tbody></tbody></table>').show();

    return '<table id="#'+rowId+'" class="table table-striped dt-responsive nowrap" style="width:100%">'+
        '<thead><tr><th>No</th><th>Nota</th><th>Tanggal</th><th>Distributor</th><th>Barang</th><th>Qty</th><th>Harga</th><th>Jumlah</th><th>Aksi</th></tr></thead><tbody></tbody></table>';
        
      
          
}
function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addlabarugi",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#tambah')[0].reset();
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
            info('data tidak boleh sama');
            $('#send').text('Submit'); //change button text
            $('#send').attr('disabled',false); //set button enable 

        }
    });
}
function hpp(id_labarugi,nota){
      if(confirm('ingi menambahkan hpp di nota ini "'+nota+'"')){
    
        
        window.open(site_url+"Master/hpp/"+nota+'_'+id_labarugi, '_blank');
  } 

  else {
    return false;
  }
    
}
function history(id_labarugi,nota){
      if(confirm('ingi melihat history hpp di nota ini "'+nota+'"')){
    
        
        window.open(site_url+"Master/historyhpp/"+nota+'_'+id_labarugi, '_blank');
  } 

  else {
    return false;
  }
    
}
function hapus(id,ket){
      if(confirm('apakah ada yakin ingin menghapus data ini "'+ket+'"')){
    var url = site_url+"Master/hpslabarugi/";
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
function fix(id,ket){
      if(confirm('apakah ada yakin ingin fix hpp nota "'+ket+'"')){
    var url = site_url+"Master/fixlabarugi/";
    var laba_kotor = penjualan-hpp;
  $.ajax({
        url : url+id,
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
function copy(id,nota){
      if(confirm('ingi menyalin data nota ini "'+nota+'" ke follow up')){
    
        
        window.open(site_url+"Master/followup/"+id, '_blank');
  } 

  else {
    return false;
  }
    
}
function edit(id)
{
   var url = site_url+"Master/getlabarugi/";
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
            $('#notaup').val(data.nota);
            ;
            $('#konsumenup').val(data.id_konsumen);
            /*s2.append($('<option>').val(data.id_konsumen).text(data.konsumen));*/
            //s2.val(data.konsumen).trigger("change");
            param1 = (+data.qty);
            param2 = (+data.harga);
            $('#barangup').val(data.barang);
            $('#hargaup').val(data.harga);
            $('#qtyup').val(data.qty);
            $('#penjualanup').val(data.penjualan);
            $('#modubah').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
       
            
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
        url: site_url+"Master/uplabarugi",
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
           info('data tidak boleh sama');
            $('#send').text('Submit'); //change button text
            $('#send').attr('disabled',false); //set button enable 

        }
    });
}


function check() {
$.ajax({
url: site_url+"Master/checktable/hpp",
 success: function(data)
        {
          
           json = JSON.parse(data);
            if(json.status) //if success close modal 
            {
              console.log('hpp: '+json.checksum);
                if(checksum1 == 0){
                  checksum1 = json.checksum;
                }

                if (checksum1 != json.checksum) {
                  //alert('ada perubahan data sistem akan segera memprosesnya');
                  checksum1 = json.checksum;
                  table.ajax.reload(null,false);
                }

                
            }
          


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
           info('error dalam check table hpp');
           

        
        }
})
$.ajax({
url: site_url+"Master/checktable/laba_rugi",
 success: function(data)
        {
          
           json = JSON.parse(data);
            if(json.status) //if success close modal 
            {
              console.log('labarugi: '+json.checksum);
                if(checksum2 == 0){
                  checksum2 = json.checksum;
                }

                if (checksum2 != json.checksum) {
                  //alert('ada perubahan data sistem akan segera memprosesnya');
                  checksum2 = json.checksum;
                  table.ajax.reload(null,false);
                }

                
            }
          


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
           info('error dalam check table detail laba rugi');
           

        
        }
})
}