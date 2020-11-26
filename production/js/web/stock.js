$(function() {
table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Stock/runstock",
            "type": "POST",
            "data": function ( data ) {
                data.barang = $('#barangcari').val();
                data.tgl = $('#tgl').val();
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
                title: 'Jumlah Stock Gudang '+d,
                
            },
             
          {
                extend: 'excel',
                title: 'Jumlah Stock Gudang '+d,
               
            },
            {
                extend: 'pdf',
                title: 'Jumlah Stock Gudang '+d,
                customize: function ( doc ) {
                   doc.defaultStyle.fontSize = 10;
                   doc.pageMargins = [ 10, 20, 10, 20 ];
                   doc.pageSize= 'A4';
                   doc.defaultStyle.alignment = 'center';
                   doc.content.forEach(function(item) {
                        if (item.table) {
                item.table.widths = ['auto','auto','auto','auto','*','*','*'] ;
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
  $.get(site_url+'master/sugestbarang', function(data){
              input.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            input.change(function(){
                var current = input.typeahead("getActive");
                $('#id').val(current.id);
            });
$('#validate').click(function () {
    if ($('#anggota').parsley().validate()){
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
        url: site_url+"Stock/addgudang",
        type: "POST",
        data: $('#anggota').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#anggota')[0].reset();
                $('#send').text('Submit'); 
                $('#send').attr('disabled',false);
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
