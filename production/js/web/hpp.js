
    var nota, id_labarugi;
 $(document).ready(function() {
 	var nota = $(location).attr("href").split('/').pop(); 
   id_labarugi = nota.split('_')[1]; 
   nota = nota.split('_')[0];
 	$("#nota").val(nota);
  $("#id_labarugi").val(id_labarugi);
   
 	$('#harga,#qty,#jumlah,.datepicker').val('');
 	
 	 $('#qty,#barang').prop('disabled',true);
 	$(".datepicker").datepicker({
    
        // The format you want
        todayHighlight: true,
        todayBtn: true,
        altFormat: "yy-mm-dd",
        autoclose: true,
        // The format the user actually sees
        format: "dd M yy",
    });
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
    table = $('#table').DataTable({ 
 		
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        "order": [], //Initial no order.
        //"paging":false, no paging
        "paging":   false,
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runhpp/"+id_labarugi,
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
           
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
           
            },
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.split('.').join("").replace(',', '.')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
              console.log(total+'|'+pageTotal);
            // Update footer
            $( api.column( 6 ).footer() ).html(
                'Rp'+(pageTotal).toLocaleString('id')  +' ( Rp'+ (total).toLocaleString('id') +' total)'
            );
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

  $('#distributor').on('change', function() {

    var data = $("#distributor option:selected").text();
    
    $('#barang').val('').trigger('change');
      sugestbarang(data);
    $('#barang').prop('disabled',false);
    $('#qty').prop('disabled',true);
    $('#harga').val('');
    $(".select2-selection").on("focus", function () {
        $(this).parent().parent().prev().select2("open");
    });
  })
  
 $('#barang').on('change', function() {
      var data = $("#barang option:selected").text();
      var rp = data.split('.').join("").split('Rp')[1];
      
      $('#harga').val(rp);
      $('#jumlah').val('');
      

      if ($('#qty').val() != '') {
       
       // $('#qty').prop('disabled',true);
       var jumlah = $('#qty').val()*$('#harga').val().split(".").join("").replace(',','.');
        $('#jumlah').val(jumlah.toLocaleString('id'));
       
         
      }else{
        $('#qty').prop('disabled',false);
      }
      $('#harga').val(data.split('Rp')[1]);
     
     
  })
  $("#qty").keyup(function(){
        var jumlah = $(this).val()*$('#harga').val().split('.').join('').replace(',','.');
        console.log(jumlah);
         $('#jumlah').val(jumlah.toLocaleString('id'));
    });
   $("#harga").keyup(function(){
        var jumlah = $(this).val().split('.').join('').replace(',','.')*$('#qty').val();
        $('#harga').val(formatRupiah($(this).val(), "Rp. "));
        $('#jumlah').val(jumlah.toLocaleString('id'));
    });
function sugestbarang(distributor){
  var result = distributor.replace(/ /g, "-");
  $('#harga').prop('readonly',true);
  //$('.barang').val('').trigger('change');
  var barang= $('#barang').select2({
      placeholder: 'Ketikan disini',
      tags: true,
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugesthargadistributor/'+result,
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
      },
      createTag: function (tag) {
         return {
             id: tag.term,
             text: tag.term,
             tag: true
         };
     }
    }).on('#barang select2:select', function (evt) {
     console.log(evt.params.data);
     if(evt.params.data.tag == true) {
      console.log('not');
      $('#harga').prop('readonly',false);
      $("#barang").attr('name', 'barang_manual');
         return;
     }
     $('#harga').prop('readonly',true);
     $("#barang").attr('name', 'barang');
 });
return barang;

}
 $('#distributorup').on('change', function() {

      var data = $("#distributorup option:selected").text();
   
      sugestbarangup(data);
    $('#barangup').val('').trigger('change');
    $('#barangup').prop('disabled',false);
    $('#qty').prop('disabled',false);
    $('#jumlahup').val('');
     $(".select2-selection").on("focus", function () {
        $(this).parent().parent().prev().select2("open");
    });
   
  })
   
 $('#barangup').on('change', function() {
      var data = $("#barangup option:selected").text();
      var rp = data.split('.').join("").split('Rp')[1];
      
      $('#hargaup').val(rp);
      $('#jumlahup').val('');
      

      if ($('#qtyup').val() != '') {
       
       // $('#qty').prop('disabled',true);
       var jumlah = $('#qtyup').val()*$('#hargaup').val().split(".").join("").replace(',','.');
        $('#jumlahup').val(jumlah.toLocaleString('id'));
       
         
      }else{
        $('#qtyup').prop('disabled',false);
      }
      $('#hargaup').val(data.split('Rp')[1]);
     
     
  })
  $("#qtyup").keyup(function(){
        var jumlah = $(this).val()*$('#hargaup').val().split('.').join('').replace(',','.');
        console.log(jumlah);
         $('#jumlahup').val(jumlah.toLocaleString('id'));
    });
   $("#hargaup").keyup(function(){
        var jumlah = $(this).val().split('.').join('').replace(',','.')*$('#qtyup').val();
        $('#hargaup').val(formatRupiah($(this).val(), "Rp. "));
        $('#jumlahup').val(jumlah.toLocaleString('id'));
    });
function sugestbarangup(distributor){
  var result = distributor.replace(/ /g, "-");
  $('#hargaup').prop('readonly',true);
  //$('.barang').val('').trigger('change');
  var barang= $('#barangup').select2({
      dropdownParent: $("#modubah"),
      placeholder: 'Ketikan disini',
      tags: true,
      allowClear: true,
      width: '100%',
      ajax: {
        url: site_url+'Master/sugesthargadistributor/'+result,
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
      },
      createTag: function (tag) {
         return {
             id: tag.term,
             text: tag.term,
             tag: true
         };
     }
    }).on('select2:select', function (evt) {
     
     if(evt.params.data.tag == true) {
      console.log('not');
      $('#hargaup').prop('readonly',false);
      $("#barangup").attr('name', 'barang_manual');
         return;
     }
     $('#hargaup').prop('readonly',true);
     $("#barangup").attr('name', 'barang');
 });
return barang;

}
function save(){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addhpp",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
            
                $('.datepicker').val('');
                $('#distributor').val('').trigger('change');
                $('#barang').val('').trigger('change');
                $('#jumlah').val('').trigger('change');
                $('#harga').val('');
                $('#qty').val('');
                $('#qty').prop('disabled',true);
                $('#barang').prop('disabled',true);
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
    var url = site_url+"Master/hpshpp/";
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
   var url = site_url+"Master/gethpp/";
    $('#formubah')[0].reset(); // reset form on modals
   //Ajax Load data from ajax
    
    $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            

            $('#qtyup').prop('disabled',false);
            $('#barangup').prop('disabled',false);
            $('#id').val(data.id);
            $('#tanggalup').val(data.tanggal);
            $('#qtyup').val(data.qty);
           
            s2.append($('<option>').text(data.distributor));
            s2.val(data.distributor).trigger("change");
            var barang = sugestbarangup(data.distributor)
            if (data.barang.length) {
              barang.append($('<option>').text(data.barang+' Rp'+data.harga.toLocaleString('id')));
              barang.val(data.barang+' Rp'+data.harga.toLocaleString('id')).trigger("change");
            }else{

              barang.append($('<option>').text(data.barang_manual));
              barang.val(data.barang_manual).trigger("change");
              $('#hargaup').prop('readonly',false);
              $("#barangup").attr('name', 'barang_manual');
            }
             console.log(data.jumlah.replace('.',','));
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
        url: site_url+"Master/uphpp",
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