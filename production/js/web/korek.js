$(function() {
table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Stock/runkorekg",
            "type": "POST",
            "data": function ( data ) {
                data.barang = $('#barangcari').val();
                data.alasan = $('#alasancari').val();
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
                title: 'Laporan Koreksi Stok Gudang '+d,
                
            },
             
          {
                extend: 'excel',
                title: 'Laporan Koreksi Stok Gudang '+d,
               
            },
            {
                extend: 'pdf',
                title: 'Laporan Koreksi Stok Gudang '+d,
                orientation: 'landscape',
                 customize: function ( doc ) {
                   doc.defaultStyle.fontSize = 10;
                   doc.pageMargins = [ 10, 20, 10, 20 ];
                   doc.pageSize= 'A4';
                   doc.defaultStyle.alignment = 'center';
                   doc.content.forEach(function(item) {
                        if (item.table) {
                item.table.widths = ['auto','*','auto','*','*','auto','auto','auto','*','auto','auto'] ;
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
                $('#id').val(current.id);
                $('#produksi').val(current.produksi);
                $('#stokkompi').val(current.stok);
                $('#selisih').val('');
                $('#hargaselisih').val('');
                $('#stoknyata').val('');
            });
    $('#stoknyata').change(function(){
         var x =$('#stokkompi').val();
          var y =$('#produksi').val();
          var z = $('#stoknyata').val();
        $('#selisih').val(x-z);
        $('#hargaselisih').val((x-z)*y);

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
});
function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Stock/korekgudang",
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
                $("#barang").typeahead('destroy');
                $.get(site_url+'Stock/sugestbarang', function(data){
                      $("#barang").typeahead({
                      source: data,
                      minLength:1,
                            });
                },'json');
                table.ajax.reload(null,false);
                
            }
            else{
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
