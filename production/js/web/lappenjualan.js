
$(function() {
    var kpm1='halo';
    var inputkpm = $("#kpm");
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpm.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            inputkpm.change(function(){
                var current = inputkpm.typeahead("getActive");
                $('#id').val(current.id);
                $('#kodekpm').val(current.name);
            });
             var inputkpmdata = $("#kpmdata");
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpmdata.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            inputkpmdata.change(function(){
                var current = inputkpmdata.typeahead("getActive");

                $('#iddata').val(current.id);
            });
table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Laporan/runlaporan/transaksi_data",
            "type": "POST",
            "data": function ( data ) {
                data.tgl = $('#tgldata').val();
                data.tgl2 = $('#tgl2data').val();
                data.barang = $('#barangdata').val();
                data.kpm = $('#iddata').val();
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
                    config.title = 'Laporan Transaksi Per item '+ $('#kpmdata').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                
            },
             
          {
                extend: 'excel',
                action: function(e, dt, button, config) {
                    config.title = 'Laporan Transaksi Per item '+ $('#kpmdata').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
               
            },
            {
                extend: 'pdf',
                 action: function(e, dt, button, config) {
                    config.title = 'Laporan Transaksi Per item '+ $('#kpmdata').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                  orientation: 'landscape',
                 customize: function ( doc ) {
                   doc.defaultStyle.fontSize = 10;
                   doc.pageMargins = [ 10, 20, 10, 20 ];
                   doc.pageSize= 'A4';
                   doc.defaultStyle.alignment = 'center';
                   doc.content.forEach(function(item) {
                        if (item.table) {
                item.table.widths = ['auto','auto','auto','auto','auto','auto','*','*'] ;
                        } 
                    });

                }
            },
        ]
    });

table2 = $('#table2').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Laporan/runlaporan/transaksi_penjualan",
            "type": "POST",
            "data": function ( data ) {
                data.tgl = $('#tgl').val();
                data.tgl2 = $('#tgl2').val();
                data.nota = $('#nota').val();
                data.kpm = $('#id').val();
            }
        },
        "fnDrawCallback": function() {
        var api = this.api();

        // Total over all pages
        for(i=4;i<=10;i++){

        
        var total = api.column(i).data().sum();

        // Total over this page
        var pageTotal = api.column(i, {page:'current'}).data().sum();
        $(api.column(i).footer()).html('Rp'+price(pageTotal));
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
                    config.title = 'Laporan Transaksi Penjualan '+ $('#kpm').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                footer:true,
                
            },
             
          {
                extend: 'excel',
                action: function(e, dt, button, config) {
                    config.title = 'Laporan Transaksi Penjualan '+ $('#kpm').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                footer:true,

               
            },
            {
                extend: 'pdf',
                action: function(e, dt, button, config) {
                    config.title = 'Laporan Transaksi Penjualan '+ $('#kpm').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                orientation: 'landscape',
                footer:true,
                customize: function ( doc ) {
                   doc.defaultStyle.fontSize = 10;
                   doc.pageMargins = [ 10, 20, 10, 20 ];
                   doc.pageSize= 'A4';
                   doc.defaultStyle.alignment = 'center';
                   doc.content.forEach(function(item) {
                        if (item.table) {
                item.table.widths = ['auto','auto','auto','auto','*','*','*','*','*','*','*'];
                        } 
                    });

                }
                
            },
        ],


    });
$('#filter').click(function(){ //button filter event click
        table2.ajax.reload(null,false);
       
     
    });

$('#filterdata').click(function(){ //button filter event click
        table.ajax.reload(null,false); 
    });
});
function valkpm(kpm){
    kpm1=kpm;
}