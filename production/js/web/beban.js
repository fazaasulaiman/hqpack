var param1= 1,param2=1;
$(document).ready(function() {
    $(".datepicker").datepicker({
    
        // The format you want
        todayHighlight: true,
        todayBtn: true,
        altFormat: "yy-mm-dd",
        autoclose: true,
        // The format the user actually sees
        format: "dd M yy",
    });
    $(".datepickermonth").datepicker({
    
        // The format you want
    format: "yyyy-mm",
    
    viewMode: "months", 
    minViewMode: "months",
    autoclose: true,
    });
    $('.s2').select2({
        placeholder: 'ketik kategori',
        allowClear: true,
        ajax: {
            url: site_url+'Master/sugest/kategori',
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

    $(".harga").keyup(function(){

        // Getting the current value of textarea


        var value = $(this).val();
        
        perkalian(value,'harga')
        var rp = formatRupiah($(this).val(), "Rp. ");
        $(this).val(rp)

    });

    $(".qty").keyup(function(){

        // Getting the current value of textarea


        var value = $(this).val();
        
        perkalian(value,'qty')

    });
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runbeban",
            "type": "POST",
            "data": function ( data ) {
                data.id = '';
                data.tanggal = $('#caritgl').val();
                data.keterangan = '';
                data.qty = '';
                data.harga = '';
                data.jumlah = '';
                data.created_on = '';
                data.updated_on = '';
               
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
      $('#filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);
       
     
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

function perkalian(val,param){

    param=='harga' ? param1 = val.split(".").join("") : param2 = val;
    var jumlah = param1*param2;
    $('.jumlah').val(jumlah.toLocaleString('id'));
    
}
function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addbeban",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#tambah')[0].reset();
                $('.s2').val('').trigger('change');
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
    $('#tambah')[0].reset();

 $.ajax({
        context: this,
        url: site_url+"Master/upbeban",
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
   var url = site_url+"Master/getbeban/";
    $('#formubah')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    var s2 = $('#kategoriup').select2({
        placeholder: 'ketik kategori',
        allowClear: true,
        dropdownParent: $("#modubah"),
        width: '100%',
        ajax: {
            url: site_url+'Master/sugest/kategori',
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
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            s2.append($('<option>').text(data.kategori));
            s2.val(data.kategori).trigger("change");
            perkalian(data.harga,'harga');
            perkalian(data.qty,'qty');
            $('#id').val(data.id);
            $('#tanggalup').val(data.tanggal);
            $('#ketup').val(data.keterangan);
            $('#qtyup').val(data.qty);
            $('#hargaup').val(data.harga);
            $('#modubah').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
            $('#tambah')[0].reset();
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
    });
}
function hapus(id,ket){
      if(confirm('apakah ada yakin ingin menghapus data ini "'+ket+'"')){
    var url = site_url+"Master/hpsbeban/";
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