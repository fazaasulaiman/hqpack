$(function() {
    var kpmcari=$("#kpmcari").val();
table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Suple/runspengiriman",
            "type": "POST",
            "data": function (data) {
                data.kpm = $('#id_kpmcari').val();
                data.barang = $('#barangcari').val();
                data.ket = $('#ketcari').val();
                data.tgl = $('#tgl').val();
                data.tgl2 = $('#tgl2').val();
            }
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
         dom: 'lBrtip', 
         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        buttons: [
        
        {
                extend: 'print',
                action: function(e, dt, button, config) {
                    config.title = 'Laporan Pengiriman Barang '+ $('#kpmcari').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
                
            },
             
          {
                extend: 'excel',
                action: function(e, dt, button, config) {
                    config.title = 'Laporan Pengiriman Barang '+ $('#kpmcari').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
               
            },
            {
                extend: 'pdf',
                action: function(e, dt, button, config) {
                    config.title = 'Laporan Pengiriman Barang '+ $('#kpmcari').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                orientation: 'landscape',
                exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10]
                },
                customize: function ( doc ) {
                   doc.defaultStyle.fontSize = 10;
                   doc.pageMargins = [ 10, 20, 10, 20 ];
                   doc.pageSize= 'A4';
                   doc.defaultStyle.alignment = 'center';
                   doc.content.forEach(function(item) {
                        if (item.table) {
                item.table.widths = ['auto','*','auto','*','*','*','*','auto','auto','auto','auto'] ;
                        } 
                    });

                }
            },
        ]
    });
$('#filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);  //just reload table
    });
  var input = $("#barang");
  $.get(site_url+'Stock/sugestbarang', function(data){
              input.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            input.change(function(){
                var current = input.typeahead("getActive");
                $('#id_barang').val(current.id);
                $('#produksi').val(current.produksi);
                $('#jual').val(current.jual);
            });
     var inputkpm = $("#kpm");
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpm.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            inputkpm.change(function(){
                var current = inputkpm.typeahead("getActive");
                $('#id_kpm').val(current.id);
            });
             var inputkpmcari = $("#kpmcari");
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpmcari.typeahead({
              source: data,
              minLength:1,
            });   
        },'json');
            inputkpmcari.change(function(){
                var current = inputkpmcari.typeahead("getActive");
                $('#id_kpmcari').val(current.id);
            });
$('#validate').click(function () {
    if ( $('#form').parsley().validate()){
        save();
    }
    else
    {
      gagal();
    }
});
$('#validate2').click(function () {
    if ( $('#formubah').parsley().validate()){
        upd();
    }
    else
    {
      gagal();
    }
});
});
function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Suple/kirimpkm",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#form')[0].reset();
                $('#send').text('Submit'); 
                $('#send').attr('disabled',false);
                table.ajax.reload(null,false);
                
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
function edit(id){
    $('#formubah')[0].reset();
    $.ajax({
        url:site_url+"Suple/get/"+id,
        type:"GET",
        dataType:"JSON",
        success:function(data){
            $('#idget').val(data.id);
            $('#nama').val(data.nama);
            $('#kode').val(data.kode);
            $('#tgledit').val(data.tgl);
            $('#kirimedit').val(data.jum_kirim);
            $('#modubah').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title

        }
    });
}

function ok(id,kirim,barang){
    if(confirm('apakah ada yakin ingin konfirmas '+barang)){
    var status="OK";
    $.ajax({
        url:site_url+"Suple/konfir",
        data:{id:id,kirim:kirim,status:status},
        type:"POST",
        dataType:"JSON",
        success:function(data){
            if(data.status){
                berhasil();
                table.ajax.reload(null,false);
            }

        }
    });
 }
}
function upd(){
     $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    $.ajax({
        url:site_url+"Suple/konfir",
        data:$("#formubah").serialize(),
        type:"POST",
        dataType: "JSON",
        success:function(data){
            if (data.status) {
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