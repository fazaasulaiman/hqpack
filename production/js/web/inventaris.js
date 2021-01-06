

var tgl='';
$(document).ready(function() {
  var hash = window.location.hash.substring(1); //get the string after the hash
  console.log(hash);
  if(hash =='view'){
     $('#panelone').remove();
     $("#headingTwo").removeClass( "collapsed" );
     $("#collapseTwo").attr('class', 'panel-collapse collapse in');
     $("#headingTwo,#collapseTwo").attr("aria-expanded", "true");
  }
    s2();
$('#s2pengguna').select2({
        placeholder: 'ketik nama pengguna',
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
 $(".datepicker").datepicker({
    
        // The format you want
        todayHighlight: true,
        todayBtn: true,
        autoclose: true,
        // The format the user actually sees
        format: "dd M yyyy",
    });
 $("#filterdate").datepicker({
    
        // The format you want
        todayHighlight: true,
        todayBtn: true,
        autoclose: true,
    });
table = $('#table').DataTable({ 

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": site_url+"Master/runinventaris",
        "type": "POST",
        "data": function ( data ) {
                 data.kode = $('#carikode').val();
                data.barang = $('#caribarang').val();
                data.spefikasi = $('#carispefikasi').val();
                data.ukuran = $('#cariukuran').val();
                data.kondisi = $('#carikondisi').val();
                data.tanggal_pembelian = tgl;
                data.pengguna = $('#caripengguna').val();
            
            }
    },

    

});
 $('#filter').click(function(){ //button filter event click
 if(!$('#caritanggal').val().length === 0 ){
  console.log('asdsa');
   tgl = moment($('#caritanggal').val(), 'DD MMM YYYY').format('YYYY-MM-DD');
 }
   
    
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
});

function save(){
$('#validate').text('Submit...'); //change button text
$('#validate').attr('disabled'); //set button enable 
 var formData = new FormData($('#tambah').get(0));
$.ajax({
    context: this,
    url: site_url+"Master/addinventaris",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "JSON",
    success: function(data)
    {
        if(data.status) //if success close modal 
        {
            berhasil();

            $('#tambah')[0].reset();
            $('#s2ukuran,#s2pengguna').val('').trigger('change');
            $('#validate').text('Submit'); 
            $('#validate').attr('disabled',false);
            table.ajax.reload(null,false);
            
        }else{
            info(data.ket);
             $('#validate').text('Submit'); //change button text
        $('#validate').attr('disabled',false); //set button enable
        }
        
        $('#validate2').text('Submit'); //change button text
        $('#validate2').attr('disabled',false); //set button enable

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('data kode barang tidak boleh sama');
        $('#validate').text('Submit'); //change button text
        $('#validate').attr('disabled',false); //set button enable 

    }
});
}
function update(){
$('#validate2').text('Submit...'); //change button text
$('#validate2').attr('disabled'); //set button enable 
 var formData = new FormData($('#formubah').get(0));
$.ajax({
    context: this,
    url: site_url+"Master/upinventaris",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
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
            
        }else{
            info(data.ket);
            $('#validate2').text('Submit'); //change button text
            $('#validate2').attr('disabled',false); //set button enable
        }
       
            $('#validate2').text('Submit'); //change button text
            $('#validate2').attr('disabled',false); //set button enable

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('data nama konsumen tidak boleh sama');
        $('#validate2').text('Submit'); //change button text
        $('#validate2').attr('disabled',false); //set button enable 

    }
});
}
function edit(id)
{
    $('#s2penggunaup').html(""); 
    var s2 = $('#s2penggunaup').select2({
        placeholder: 'ketik nama pengguna',
        tags: true,
         dropdownParent: $("#modubah"),
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
var url = site_url+"Master/getinventaris/";
var cachekiller = Math.floor(Math.random()*1001);
$('#formubah')[0].reset(); // reset form on modals
//Ajax Load data from ajax
$.ajax({
    url : url+id,
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
        console.log(data);
          jQuery.each(data.pengguna, function(index,item) {
             s2.append($('<option>').text(item));
            });
           
            s2.val(data.pengguna).trigger("change");
        $('#fotoup').attr("src", site_url+'production/upload/inventaris/'+data.foto+'?'+cachekiller);
        $('#id').val(data.id);
        $('#kodeup').val(data.kode);
        $('#barangup').val(data.barang);
        $('#kondisiup').val(data.kondisi);
      s2update(data.ukuran);
        $('#jumlahup').val(data.jumlah);
        $('#keteranganup').val(data.keterangan);
        $('#spefikasiup').val(data.spefikasi);
        $('#tanggal_pembelianup').val(data.tanggal_pembelian);
        $('#penggunaup').val(data.pengguna);
        $('#modubah').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
        table.ajax.reload(null,false);
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    },
});
}

function hapus(id,ket){
  if(confirm('apakah ada yakin ingin menghapus data ini "'+ket+'"')){
var url = site_url+"Master/hpsinventaris/";
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
function s2() {
  
   
    $('#s2ukuran').select2({

      placeholder: 'Ketikan disini',
     
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/size',
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
function s2update(val) {
  
 
  s2 =  $('#s2ukuranup').select2({

      placeholder: 'Ketikan disini',
    dropdownParent: $("#modubah"),
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/size',
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
    s2.append($('<option>').text(val));
    s2.val(val).trigger("change");
 
}