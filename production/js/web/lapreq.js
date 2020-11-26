$(function() {
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
table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Request/runreq",
            "type": "POST",
            "data": function (data) {
                data.kpm = $('#kpm').val();
                data.barang = $('#barang').val();
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
                    config.title = 'Laporan Pengiriman Barang '+ $('#kpm').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
                }
                
            },
             
          {
                extend: 'excel',
                action: function(e, dt, button, config) {
                    config.title = 'Laporan Pengiriman Barang '+ $('#kpm').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
                }
               
            },
            {
                extend: 'pdf',
                action: function(e, dt, button, config) {
                    config.title = 'Laporan Pengiriman Barang '+ $('#kpm').val();
                    $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                  },
                orientation: 'landscape',
                exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
                },
                customize: function ( doc ) {
                   doc.defaultStyle.fontSize = 10;
                   doc.pageMargins = [ 10, 20, 10, 20 ];
                   doc.pageSize= 'A4';
                   doc.defaultStyle.alignment = 'center';
                   doc.content.forEach(function(item) {
                        if (item.table) {
                item.table.widths = ['auto','*','auto','auto','*','*','*','*',] ;
                        } 
                    });

                }
            },
        ]
    });
$('#filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);  //just reload table
    });
});
function ok(id,barang){
    if(confirm('apakah ada yakin ingin menerima permintaan '+barang)){
    $.ajax({
        url:site_url+"Request/ok",
        data:{id:id},
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