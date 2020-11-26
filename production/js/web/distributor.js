 
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = dd + '-' + mm + '-' + yyyy;
function format ( d ) {
    console.log(d);
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:100px;">'+
        
        '<tr>'+
            '<td>Email:</td>'+
            '<td>'+d[6]+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Instagram:</td>'+
            '<td>'+d[7]+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Facebook:</td>'+
            '<td>'+d[8]+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Website:</td>'+
            '<td>'+d[9]+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Alamat:</td>'+
            '<td>'+d[10].replace(/\r?\n/g, '<br />')+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Note:</td>'+
            '<td>'+d[11].replace(/\r?\n/g, '<br />')+'</td>'+
        '</tr>'+
      
    '</table>';
}


$(document).ready(function() {
     
    /*$('.js-example-basic-multiple').select2({

    	multiple: true,
    	placeholder: 'pilih barang / jasa',
    	minimumInputLength: 3,
    	allowClear: true,
      width: '100%',
    	ajax: {
    		url: site_url+'Master/sugestbarangjasa',
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
*/
var hash = window.location.hash.substring(1); //get the string after the hash
 console.log(hash);
if(hash =='view'){
 $('#panelone').remove();
 $("#headingTwo").removeClass( "collapsed" );
 $("#collapseTwo").attr('class', 'panel-collapse collapse in');
 $("#headingTwo,#collapseTwo").attr("aria-expanded", "true");
}
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/rundistributor",
            "type": "POST"
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
                "targets": [ 6 ],
                "visible": false
            },
            {
                "targets": [ 7 ],
                "visible": false
            },
            {
                "targets": [ 8 ],
                "visible": false
            },
            {
                "targets": [ 9 ],
                "visible": false
            },
            {
                "targets": [ 10 ],
                "visible": false
            },
             {
                "targets": [ 11 ],
                "visible": false
            },
        ],
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                autoFilter: true,
                title: 'Data Distributor Per tanggal '+ today,
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8,9,10,11],
                }
               
            },
            {
                extend: 'pdfHtml5',
                title: 'Data Distributor Per tanggal '+ today,
                exportOptions: {
                columns: [1,2,3,4,5,6,7,8,9,10,11],
                },
                customize: function(doc) {
                  doc.styles.title.fontSize = 16;
                  doc.styles.tableHeader.fontSize = 9;
                  doc.defaultStyle.fontSize = 9; //<-- set fontsize to 16 instead of 10 
                  doc.defaultStyle.alignment = 'center'
               },
                orientation: 'landscape',
                
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


$('#validate').click(function () {
    if ( $('#distributor').parsley().validate()){
        save();
    }
    else
    {
      gagal();
    }
});
$('#validate2').click(function () {
    if ( $('#formubahdistributor').parsley().validate()){
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
        url: site_url+"Master/adddistributor",
        type: "POST",
        data: $('#distributor').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#distributor')[0].reset();
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
    
 $.ajax({
        context: this,
        url: site_url+"Master/updistributor",
        type: "POST",
        data: $('#formubahdistributor').serialize(),
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
   var url = site_url+"Master/getdistributor/";
    $('#formubahdistributor')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

           console.log(data);
            $('#id').val(data.id);
            $('#namaup').val(data.nama);
            $('#barangjasaup').val(data.barangjasa);
            $('#telpup').val(data.telp);
            $('#instagramup').val(data.instagram);
            $('#emailup').val(data.email);
            $('#facebookup').val(data.facebook);
            $('#alamatup').val(data.alamat);
            $('#websiteup').val(data.website);
            $('#pemilikup').val(data.pemilik);
            $('#noteup').val(data.note);
            $('#modubah').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
    });
}
function hapus(id,ket){
      if(confirm('apakah ada yakin ingin menghapus data ini "'+ket+'"')){
    var url = site_url+"Master/hpsdistributor/";
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