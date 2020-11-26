var nota 
 $(document).ready(function() {
 	param = $(location).attr("href").split('/').pop(); 
       id = param;
    
 	
 var s2 =$('#distributor').select2({

      placeholder: 'Ketikan disini',
     
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/distributor',
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
 $('#jenis').select2({

      placeholder: 'Ketikan disini',
     
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/jenisdistributor',
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
  $('#distributor').on('change', function() {

    var data = $("#distributor option:selected").text();
    
    $('#barang').val('').trigger('change');
      sugestbarang(data,'add');
    $('#barang').prop('disabled',false);
    $('#jumlah').prop('disabled',true);
    $('#harga').val('');
    $(".select2-selection").on("focus", function () {
        $(this).parent().parent().prev().select2("open");
    });
  })
   $('#distributorup').on('change', function() {

    var data = $("#distributorup option:selected").text();
    
    $('#barangup').val('').trigger('change');
      sugestbarang(data,'up');
    $('#barangup').prop('disabled',false);
    $('#hargaup').val('');
    $(".select2-selection").on("focus", function () {
        $(this).parent().parent().prev().select2("open");
    });
  })
  $('#barang').on('change', function() {
      var data = $("#barang option:selected").text();
      var rp = data.split('.').join("").split('Rp')[1];
      
      $('#harga').val(rp);
      $('#total').val('');
      

      if ($('#jumlah').val() != '') {
       
       // $('#qty').prop('disabled',true);
       var jumlah = $('#jumlah').val()*$('#harga').val().split(".").join("").replace(',','.');
        $('#total').val(total.toLocaleString('id'));
       
         
      }else{
        $('#jumlah').prop('disabled',false);
      }
      $('#harga').val(data.split('Rp')[1]);
  })
  $('#barangup').on('change', function() {
      var data = $("#barangup option:selected").text();
      var rp = data.split('.').join("").split('Rp')[1];
      
      $('#hargaup').val(rp);
      $('#totalup').val('');
      

      if ($('#jumlahup').val() != '') {
       
       // $('#qty').prop('disabled',true);
       var total = $('#jumlahup').val()*$('#hargaup').val().split(".").join("").replace(',','.');
        $('#totalup').val(total.toLocaleString('id'));
       
         
      }else{
        $('#jumlahup').prop('disabled',false);
      }
      $('#hargaup').val(data.split('Rp')[1]);
  })
    $("#jumlah").keyup(function(){
        var total = $(this).val()*$('#harga').val().split('.').join('').replace(',','.');
       
         $('#total').val(total.toLocaleString('id'));
    });
    $("#jumlahup").keyup(function(){
        var total = $(this).val()*$('#hargaup').val().split('.').join('').replace(',','.');
       
         $('#totalup').val(total.toLocaleString('id'));
    });
 	
 
    table = $('#table').DataTable({ 
 		
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        "order": [], //Initial no order.
        //"paging":false, no paging
        "paging":   false,
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runpricelistdistributor/"+id,
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
           
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
           
            },
        ],
        
         

    });
    
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
function sugestbarang(distributor,type){
  if (type == 'add') {
    ele = '#barang';
     var result = distributor.replace(/ /g, "-");
 
    //$('.barang').val('').trigger('change');
    var barang= $(ele).select2({

      placeholder: 'Ketikan disini',
      tags: true,
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugesthargadistributor2/'+result,
        dataType: 'json',
        type: "get",
       
            delay: 250,
            data: function(params) {

                return {
                  search: params.term,
                }
              },
              processResults: function (data, page) {
              return {
                results: data

              };
            },
      }
 }).on('select2:select', function (evt) {
   
     $('#harga').prop('readonly',true);
     $("#barang").attr('name', 'id_hargadistributor');
 });
  }else{
    ele = '#barangup'
     var result = distributor.replace(/ /g, "-");
 
    //$('.barang').val('').trigger('change');
    var barang= $(ele).select2({
       dropdownParent: $("#modubah"),
      placeholder: 'Ketikan disini',
      tags: true,
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugesthargadistributor2/'+result,
        dataType: 'json',
        type: "get",
       
            delay: 250,
            data: function(params) {

                return {
                  search: params.term,
                }
              },
              processResults: function (data, page) {
              return {
                results: data

              };
            },
      }
 }).on('select2:select', function (evt) {
   
     $('#harga').prop('readonly',true);
     $("#barang").attr('name', 'id_hargadistributor');
 });
  }
   
return barang;

}
function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addpricelistdistributor",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#jumlah,#harga,#total').val('');
                $('#id_hargadistributor,#distributor,#jenis').val('').trigger('change');
                
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
      if(confirm('apakah ada yakin ingin menghapus data no "'+ket+'"')){
    var url = site_url+"Master/hpspricelist_distributor/";
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
    
}function edit(id)
{
   var s2 =$('#distributorup').select2({

      placeholder: 'Ketikan disini',
      dropdownParent: $("#modubah"),
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/distributor',
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
  jenis = $('#jenisup').select2({

      placeholder: 'Ketikan disini',
      dropdownParent: $("#modubah"),
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugest/jenisdistributor',
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
   var url = site_url+"Master/getpricelistdistributor/";
    $('#formubah')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            console.log(data);

            $('#id').val(data.id);
            $('#jumlahup').val(data.jumlah);
            $('#jenisup').val(data.jenis);
            jenis.append($('<option>').text(data.jenis));
            jenis.val(data.jenis).trigger("change");
            s2.append($('<option>').text(data.distributor));
            s2.val(data.distributor).trigger("change");
            var barang = sugestbarang(data.distributor,'up');
            var $newOption = $("<option selected='selected'></option>").val(data.id_hargadistributor).text(data.barang)
            
            $("#barangup").append($newOption).trigger('change');
            $('#hargaup').val(formatRupiah(data.harga.replace('.',','), "Rp. "));

            $('#jumlahup').val(formatRupiah(data.jumlah.replace('.',','), "Rp. "));
            
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
function update(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
  

 $.ajax({
        context: this,
        url: site_url+"Master/uppricelist_distributor",
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