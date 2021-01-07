var param1,param2 = 1;
var checksum, total = 0


$(document).ready(function() {
 
 var hash = window.location.hash.substring(1); //get the string after the hash
 console.log(hash);
if(hash =='view'){
   $('#panelone').remove();
   $("#headingTwo").removeClass( "collapsed" );
   $("#collapseTwo").attr('class', 'panel-collapse collapse in');
   $("#headingTwo,#collapseTwo").attr("aria-expanded", "true");
}
$("button[type='reset']").closest('form').on('reset', function(event) {
console.log('masuk')
$('#statusfilter').val('').trigger('change')
});
new ClipboardJS('#buttoncopy');
  var s2 = ["produk_konsumen", "barangjasa", "size","warna","bahan","ketebalan"];
     s2.forEach(myFunction);
  


  $('#s2konsumen').select2({
      	placeholder: 'ketik nama konsumen',
        tags: true,
      tokenSeparators: [','],
       multiple: true,
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
                var results = [];

                $.each(data, function(index, item) {
                    results.push({
                        id: item.text,
                        text: item.text
                    });
                });

                return {
                    results: results
                };
              }, 
              createTag: function (tag) {
                 return {
                     id: tag.term,
                     text: tag.term,
                     tag: true
                 };
             }
    		},
      });

 
  table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runpricelist",
            "type": "POST",
             "data": function ( data ) {
                 data.produk_konsumen = $('#cariproduk').val();
                data.nama_produk = $('#carinama_produk').val();
                data.size = $('#carisize').val();
                data.warna = $('#cariwarna').val();
                data.bahan = $('#caribahan').val();
                data.ketebalan = $('#cariketebalan').val();
                data.prioritas = $('#cariprioritas').val();
                data.konsumen = $('#carikonsumen').val();
                data.note = $('#carinote').val();
            
            }
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
           
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
           
            },
        ],
         rowCallback: function(row, data, index){
          if (data[6] != null) {
             var d = new Date(data[6]);
                if(Date.now() >= d){
                /*$('td', row).css('background-color', '#fc0349');*/
                 $(row).addClass('red');
              }else{
                $(row);
              }
          }
           if (data[7] != null) {
             var d = new Date(data[7]);
                if(Date.now() >= d){
                /*$('td', row).css('background-color', '#fc0349');*/
                 $(row).addClass('red');
              }else{
                $(row);
              }
          }
               
            
        }
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
 //setInterval(check, 5000);

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
function hapus(id,ket){
      if(confirm('apakah ada yakin ingin menghapus data ini')){
    var url = site_url+"Master/hpspricelist/";
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
function duplikat(id,ket){
      if(confirm('apakah anda ingin menduplikat data no '+ket)){
    var url = site_url+"Master/duplikatpricelist/";
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
function myFunction(value) {
  if (value == 'bahan') {
      value = 'barangjasa';
      id = '#s2bahan';
  }else{
      id= '#s2'+value;
  }
  $(id).select2({

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

function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addpricelist",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#tambah')[0].reset();
                
                $('#s2produk_konsumen,#s2barangjasa,#s2size,#s2warna,#s2bahan,#s2ketebalan,#s2konsumen').val('').trigger('change');
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
function perhitungan(produk,nama,warna,id){
      if(confirm('tambahkan perhitungan pricelist di "'+produk+' '+nama+' '+warna+'" ?')){
    
        
        window.open(site_url+"Master/pricelistorder/"+produk.split(' ').join('_')+'-'+nama.split(' ').join('_')+'-'+warna.split(' ').join('_')+'-'+id, '_blank');
  } 

  else {
    return false;
  }
    
}
function distributor(produk,nama,warna,id){
      if(confirm('tambahkan distributor di "'+produk+' '+nama+' '+warna+'" ?')){
    
        
        window.open(site_url+"Master/pricelistdistributor/"+produk.split(' ').join('_')+'-'+nama.split(' ').join('_')+'-'+warna.split(' ').join('_')+'-'+id, '_blank');
  } 

  else {
    return false;
  }
    
}
function copyboard(id){
  
  var url = site_url+"Master/getplcopyboard/";
   $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            console.log(data);
            $('#board').val(data)
            $('#copyboard').modal('show'); // show bootstrap modal when complete loaded
            
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
    });
}
function select2update(tabel,val) {
  
 if (tabel == 'bahan') {
      tabel = 'barangjasa';
      id = '#s2bahanup';
  }else{
      id= '#s2'+tabel+'up';
  }
   
  var s2 = [];
  s2[tabel] =  $(id).select2({

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
 
}
function edit(id)
{
 $("#s2konsumenup").html(""); 
  var s2 = $('#s2konsumenup').select2({
        placeholder: 'ketik nama konsumen',
         dropdownParent: $("#modubah"),
        tags: true,
      tokenSeparators: [';',','],
       multiple: true,
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
                var results = [];

                $.each(data, function(index, item) {
                    results.push({
                        id: item.text,
                        text: item.text
                    });
                });

                return {
                    results: results
                };
              }, 
              createTag: function (tag) {
                 return {
                     id: tag.term,
                     text: tag.term,
                     tag: true
                 };
             }
        },
      });
   var url = site_url+"Master/getpricelist/";
   
    $('#formubah')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          
           console.log(data.konsumen);
               
            $('#id').val(data.id);
            $('#noteup').val(data.note);
            $('#notekonsumenup').val(data.note_konsumen);
            $('#prioritasup').val(data.prioritas);
            $('#' + data.tutup_pisah).prop('checked',true);
            $('#finishingup').val(data.finishing);
           
            
            jQuery.each(data.konsumen, function(index,item) {
             s2.append($('<option>').text(item));
            });
           
            s2.val(data.konsumen).trigger("change");
            var val = {produk_konsumen:data.produk_konsumen, barangjasa:data.nama_produk, warna:data.warna,size:data.size, ketebalan:data.ketebalan, bahan:data.bahan};
            /*var tabel = ["distributor", "barang", "warna","size","ketebalan","satuan",'merk'];*/
            Object.keys(val).forEach(function(key) {

                select2update(key, val[key]);

            });

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
        url: site_url+"Master/upricelist",
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