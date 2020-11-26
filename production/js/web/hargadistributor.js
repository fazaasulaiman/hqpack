 
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var param1= '',param2='';
today = dd + '-' + mm + '-' + yyyy;

function format ( d ) {
    console.log(d);
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:100px;">'+
        
        '<tr>'+
            '<td>Keterangan:</td>'+
            '<td>'+d[13]+'</td>'+
        '</tr>'+
    '</table>';
}

$(document).ready(function() {
var hash = window.location.hash.substring(1); //get the string after the hash
 console.log(hash);
if(hash =='view'){
 $('#panelone').remove();
 $("#headingTwo").removeClass( "collapsed" );
 $("#collapseTwo").attr('class', 'panel-collapse collapse in');
 $("#headingTwo,#collapseTwo").attr("aria-expanded", "true");
}
   
    $(".datepicker").datepicker({
    
        // The format you want
        todayHighlight: true,
        todayBtn: true,
        altFormat: "yy-mm-dd",
        autoclose: true,
        // The format the user actually sees
        format: "dd M yy",
    });
     $(".datepicker").on("change",function(){
        /*var selected = $(this).val();*/
         var str ='_'+$(this).val();
         generateproduct(str.replace(/\s/g, ''),'tgl');
        
    });
    $(".harga").keyup(function(){

        // Getting the current value of textarea


        var currentText = $(this).val();
        console.log($(this).val())
        generateproduct(currentText,'harga')
        $(this).val(formatRupiah($(this).val(), "Rp. "))

    });
     var s2 = ["distributor", "barangjasa", "warna","size","ketebalan","satuan",'merk'];
     s2.forEach(myFunction);

    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runhargadistributor",
            "type": "POST",
             "data": function ( data ) {
                data.id = $('#cariid').val();
                data.distributor = $('#caridistributor').val();
                data.barangjasa = $('#caribarangjasa').val();
                data.merk = $('#carimerk').val();
                data.warna = $('#cariwarna').val();
                data.size = $('#carisize').val();
                data.ketebalan = $('#cariketebalan').val();
                data.satuan = $('#carisatuan').val();
                data.harga = $('#cariharga').val();
                data.id_produk = $('#cariid_produk').val();
                data.updated_on = $('#cariupdated_on').val();
                data.created_on = $('#caricreated_on').val();
                data.keterangan = $('#cariketerangan').val();
            }
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
            "class":          "details-control",
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
            'defaultContent': ''
            },
            {
                "targets": [ 10 ],
                "visible": false
            },
            {
                "targets": [ 13 ],
                "visible": false
            },
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data Harga Distributor Per tanggal '+ today,
                autoFilter: true,
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13],
                }
               
            },
            {
                extend: 'pdfHtml5',
                title: 'Data Harga Distributor Per tanggal '+ today,
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8,9,10,11,12.13],
                },
                customize: function(doc) {
                  doc.styles.title.fontSize = 16;
                  doc.styles.tableHeader.fontSize = 12;
                  doc.defaultStyle.fontSize = 12; //<-- set fontsize to 16 instead of 10 
                  doc.defaultStyle.alignment = 'center'
               } 
                
            }, 
        ]
        

    });
});
$('#table tbody').on('click', 'td.details-control', function(){
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if(row.child.isShown()){
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
  $('#btn-show-all-children').on('click', function(){
        // Enumerate all rows
        table.rows().every(function(){
            // If row has details collapsed
            if(!this.child.isShown()){
                // Open this row
                this.child(format(this.data())).show();
                $(this.node()).addClass('shown');
            }
        });
    });

    // Handle click on "Collapse All" button
    $('#btn-hide-all-children').on('click', function(){
        // Enumerate all rows
        table.rows().every(function(){
            // If row has details expanded
            if(this.child.isShown()){
                // Collapse row details
                this.child.hide();
                $(this.node()).removeClass('shown');
            }
        });
    });
$('#filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);
       
     
    });
function myFunction(value) {
  $('#s2'+value).select2({

      placeholder: 'Ketikan disini',
     
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/'+value,
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
} 
function select2update(tabel,val) {
  

   
  var s2 = [];
  s2[tabel] =  $('#s2'+tabel+'up').select2({

      placeholder: 'Ketikan disini',
    dropdownParent: $("#modubah"),
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/'+tabel,
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
    s2[tabel].append($('<option>').text(val));
    s2[tabel].val(val).trigger("change");
    console.log(s2[tabel]);
    console.log(tabel+'|'+val)
 
} 

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
function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addhargadistributor",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#tambah')[0].reset();
                $('#s2distributor').val('').trigger('change');
                $('#s2barangjasa').val('').trigger('change');
                $('#s2merk').val('').trigger('change');
                $('#s2warna').val('').trigger('change');
                $('#s2ketebalan').val('').trigger('change');
                $('#s2size').val('').trigger('change');
                $('#s2satuan').val('').trigger('change');
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
function edit(id)
{
   var url = site_url+"Master/gethargadistributor/";
    $('#formubah')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        { 

            var val = {distributor:data.distributor, barangjasa:data.barangjasa, warna:data.warna,size:data.size, ketebalan:data.ketebalan, merk:data.merk, satuan:data.satuan};
            /*var tabel = ["distributor", "barang", "warna","size","ketebalan","satuan",'merk'];*/
            Object.keys(val).forEach(function(key) {

            select2update(key, val[key]);

          });
            generateproduct(data.harga,'harga');
            generateproduct('_'+data.updated_on,'tgl');
            /*console.log(tabel.map(select2update));*/
            $('#id').val(data.id);
            $('#s2hargaup').val(formatRupiah(data.harga.replace('.',','), "Rp. "));
            $('#s2keteranganup').val(data.keterangan);
            $('#s2updateup').val(data.updated_on);
            $('#s2idprodukup').val(data.id_produk);
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
        url: site_url+"Master/uphargadistributor",
        type: "POST",
        data: $('#formubah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#tambah')[0].reset();
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
function hapus(id,ket){
      if(confirm('apakah ada yakin ingin menghapus data ini "'+ket+'"')){
    var url = site_url+"Master/hpshargadistributor/";
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
function generateproduct(text,param){

    param=='harga' ? param1 = text : param2 = text;
    $('.generateval').prop('readonly',false);
    $('.generateval').val('-'+param1+param2);
    $('.generateval').prop('readonly',true);

}