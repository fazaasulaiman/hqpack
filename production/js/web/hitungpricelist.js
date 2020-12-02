var nota,table;
var checksum= 0
 $(document).ready(function() {
 	param = $(location).attr("href").split('/').pop(); 
    params= param.split('-');
    produk = params[0].split('_').join(' '); 
    nama = params[1].split('_').join(' '); 
    warna = params[2].split('_').join(' '); 
    id = params[3]; 
    $('.text').text(produk+' '+nama+' '+warna);
    $('#produk').val(produk);
    $('#nama').val(nama);
    $('#warna').val(warna);
    $('#id_pricelist').val(id);
 	
 setInterval(check, 5000);    
$('#margin').select2({

      placeholder: 'Ketikan disini',
     
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/margin',
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
      },
    });
 
 $.ajax({
        url : site_url+'Master/runpricelistorder/'+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            

          console.log(data);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
    });
   table = $('#table').DataTable( {
      // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runpricelistorder/"+id,
            "type": "POST"
        }
    } );
    
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

   $("#kredit").keyup(function(){
     
         var rp = formatRupiah($(this).val(), "Rp. ");
          $(this).val(rp)
    });

  $("#kreditup").keyup(function(){    

         var rp = formatRupiah($(this).val(), "Rp. ");
          $(this).val(rp)
    });

function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addpricelistorder",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#jumlah_order,#insheet').val('');
                $('#margin').val('').trigger('change');
                $('#nota').val(nota);
                $('.datepicker').val('');
                $('#margin').val('').trigger('change');
                
                $('#send').text('Submit'); 
                $('#send').attr('disabled',false);
                table.ajax.reload(null,false);
               /* window.location.href = site_url+"Master/detaillaporanx#fix";*/
                
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
function hapus(id,ket){
      if(confirm('apakah ada yakin ingin menghapus data ini')){
    var url = site_url+"Master/hpsplorder/";
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

function detail(id)
{
 
   var url = site_url+"Master/detailhitungpl/";
    
            $('#moddetail').modal('show');

    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
           
            header = data.header[0];
            body = data.body;
            footer = data.footer;
           $('#produkdetail').text(header.produk_konsumen);
           $('#namadetail').text(header.nama_produk);
           $('#warnadetail').text(header.warna);
           $('#sizedetail').text(header.size_kertas);
           $('#planodetail').text(header.plano);
           $('#insheetdetail').text(header.insheet);
            $('#jumlah_orderdetail').text(header.jumlah_order);
            var html ='';
            jQuery.each(body, function(i, val) {
              console.log(i);
              console.log(val);
                html += '<div class="panel panel-default detailed"><div class="panel-heading">'+i+'</div><table class="table">';
                html += '<thead><tr><th>Distributor</th><th>Barang</th><th>Size</th><th>Ketebalan</th><th>Harga</th><th>Jumlah</th><th>Total</th></tr></thead><tbody>';
                   jQuery.each(val, function(y, value) {
                    html += '<tr><td>'+value.distributor+'</td>';
                    html += '<td>'+value.barangjasa+'</td>';
                    html += '<td>'+value.size+'</td>';
                    html += '<td>'+value.ketebalan+'</td>';
                    html += '<td>'+value.harga+'</td>';
                    html += '<td>'+value.jumlah+'</td>';
                    html += '<td>'+value.total+'</td></tr>';
                   });
                html += '</tbody></table></div>';
            });
            $('.detailed').remove();
           $('#header').after(html);
              console.log(body);
           $('#subtotaldetail').text(footer.subtotal);
           $('#margindetail').text(footer.margin);
           $('#totalmargindetail').text(footer.totalmargin);
           $('#totaldetail').text(footer.total);
           $('#satuandetail').text(footer.satuan);
            
            $('#moddetail').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail hitung P/L'); // Set title to Bootstrap modal title
            //$('#')[0].reset();
            
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
    });
}
function edit(id)
{
       var s2  = $('#marginup').select2({

      placeholder: 'Ketikan disini',
     dropdownParent: $("#modubah"),
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/margin',
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
      },
    });
 
   var url = site_url+"Master/getplorder/";
    $('#formubah')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            

            $('#id').val(data.id);
            $('#size_kertasup').val(data.size_kertas);
            $('#jumlah_orderup').val(data.jumlah_order);
            $('#planoup').val(data.plano);
            $('#insheetup').val(data.insheet);
            $('#marginup').val(data.margin);
            s2.append($('<option>').text(data.margin));
            s2.val(data.margin).trigger("change");
           
            
            $('#modubah').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
            //$('#')[0].reset();
            
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },
    });
}
function distributor(no,id){
      if(confirm('tambahkan di pricelist order no "'+no+'" ?')){
    
        
        window.open(site_url+"Master/pricelistdistributor/"+id, '_blank');
  } 

  else {
    return false;
  }
    
}
function update(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
  

 $.ajax({
        context: this,
        url: site_url+"Master/upplorder",
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
function check() {
$.ajax({
url: site_url+"Master/checktable/pricelist_distributor",
 success: function(data)
        {
          
           json = JSON.parse(data);
            if(json.status) //if success close modal 
            {
              console.log('PLdistributor : '+json.checksum);
               if (checksum != json.checksum) {
                  //alert('ada perubahan data sistem akan segera memprosesnya');
                  checksum = json.checksum;
                  table.ajax.reload(null,false);
                }
                if(checksum == 0){
                  checksum = json.checksum;
                }

               

                
            }
          


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
           info('error dalam check table hpp');
           

        
        }
})
}