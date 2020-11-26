$(function() {
table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Laporan/runlaporan/transaksi_retur",
            "type": "POST",
            "data": function ( data ) {
                data.tgl = $('#tgl').val();
                data.tgl2 = $('#tgl2').val();
                data.barang = $('#barang').val();
                data.kpm = $('#id').val();
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
                     var a ;
                    if ($('#kpmcari').val()==='') {
                        a ='Laporan Retur Barang Stock di Setiap KPM';
                    }else{
                         a='Laporan Retur Barang Stock di '+ $('#kpmcari').val();
                    }
                    config.title = a;
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                
            },
             
          {
                extend: 'excel',
                
                action: function(e, dt, button, config) {
                     var a ;
                    if ($('#kpmcari').val()==='') {
                        a ='Laporan Retur Barang Stock di Setiap KPM';
                    }else{
                         a='Laporan Retur Barang Stock di '+ $('#kpmcari').val();
                    }
                    config.title = a;
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
               
            },
            {
                extend: 'pdf',
                action: function(e, dt, button, config) {
                     var a ;
                    if ($('#kpmcari').val()==='') {
                        a ='Laporan Retur Barang Stock di Setiap KPM';
                    }else{
                         a='Laporan Retur Barang Stock di '+ $('#kpmcari').val();
                    }
                    config.title = a;
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                orientation: 'potrait',
                 customize: function ( doc ) {
                   doc.defaultStyle.fontSize = 12;
                   doc.pageMargins = [ 10, 20, 10, 20 ];
                   doc.pageSize= 'A4';
                   doc.defaultStyle.alignment = 'center';
                   doc.content.forEach(function(item) {
                        if (item.table) {
                item.table.widths = ['auto','auto','auto','auto','auto','auto','auto'] ;
                        } 
                    });

                }
                
            },
        ]
    });
var inputkpm = $("#kpmcari");
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpm.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            inputkpm.change(function(){
                var current = inputkpm.typeahead("getActive");
                $('#id').val(current.id);
            });
$('#filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);  //just reload table
    });
});