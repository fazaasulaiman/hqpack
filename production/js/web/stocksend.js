var tgl;
$(document).on("click",".kirim-delete-item",function(e){
        var key = $(this).attr("data-cart");
        $("#"+key).remove();
       
    });
$(document).on("click",".faktur",function(e){
    
        var print;
        nota = $(this).attr("nota");
        tgl = $(this).attr("tgl");
         $.ajax({
        url : site_url+"Master/getfakturpengiriman",
        dataType: "JSON",
        data : {nota:nota,tanggal:tgl},
        type: "GET",
        async:false, 
        success: function(data)
        {   
            
             if(data.status){
              print = data;
              
                              
            }else{
              info('error dalam mengambil data faktur');
            }
        }
     });
         console.log(print);
         readyprint(print);
        return false;
        
       
    });
$(document).on("click",".hpskirim",function(e){
      id = $(this).attr("idkirim");
      ket = 'dengan nota: '+$(this).attr("nota")+' dan pengeriman tanggal '+$(this).attr("tgl");
      hapus($(this).attr("tgl"),$(this).attr("nota"),ket);
      riwayatbarang($(this).attr("nota"));
      return false;
        
       
    });
$(document).ready(function() {
  var hash = window.location.hash.substring(1); //get the string after the hash
  console.log(hash);
  if(hash =='view'){
     $('#panelone').remove();
     $("#headingTwo").removeClass( "collapsed" );
     $("#collapseTwo").attr('class', 'panel-collapse collapse in');
     $("#headingTwo,#collapseTwo").attr("aria-expanded", "true");
  }
 $('button').tooltip({
  trigger: 'click',
  placement: 'right'
});

function setTooltip(btn, message) {
  $(btn).tooltip('hide')
    .attr('data-original-title', message)
    .tooltip('show');
}

function hideTooltip(btn) {
  setTimeout(function() {
    $(btn).tooltip('hide');
  }, 1000);
}
  var clipboard = new ClipboardJS('.copyboard', {
    text: function(trigger) {
    return $(trigger).prev().text(); 
    }
  });
    clipboard.on('success', function(e) {
  setTooltip(e.trigger, 'Dicopy!');
  hideTooltip(e.trigger);
});

clipboard.on('error', function(e) {
  setTooltip(e.trigger, 'Gagal!');
  hideTooltip(e.trigger);
});
  $('#s2nota').select2({
      	placeholder: 'ketik No nota',
      	allowClear: true,
        width: '100%',
      	ajax: {
      		url: site_url+'Master/sugestnota',
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
   $('#s2notariwayat').select2({
        placeholder: 'ketik No nota',
        allowClear: true,
        width: '100%',
        ajax: {
          url: site_url+'Master/sugestnota',
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
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url+"Master/runstocksend",
            "type": "POST",
             "data": function ( data ) {
                data.tanggal = $('#caritanggal').val();
                data.nota = $('#carinota').val();
                data.barang = $('#caribarang').val();
                data.konsumen = $('#carikonsumen').val();
               
            }
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
           
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
           
            },
        ],
         
           

    });

  var hash = window.location.hash.substring(1); //get the string after the hash
  });
 $('#filter').click(function(){ //button filter event click
    
        table.ajax.reload(null,false);
     
    });
$('#get-barang').click(function () {
    getbarang($('#s2nota').val());
});
$('#riwayat-barang').click(function () {
    riwayatbarang($('#s2notariwayat').val());
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


function save(){
    $('#validate').text('Submit...'); //change button text
    $('#validate').attr('disabled'); //set button enable 
    var print;
    
 $.ajax({
        context: this,
        url: site_url+"Master/addstocksend",
        type: "POST",
        data: $('#tambah').serialize(),
        dataType: "JSON",
        async:false, 
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                $('#send-item').children().empty().remove();
                $('#s2nota').val('').trigger('change');
                berhasil();
                info('mohon tunggu sebentar...');
                print = data;
                
               table.ajax.reload(null,false);
                
            }else{
              $('#send-item').children().empty().remove();
                $('#s2nota').val('').trigger('change');
              table.ajax.reload(null,false);
              info(data.message);
            }
            $('#validate').text('Submit'); //change button text
            $('#validate').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            info('error lain Hub faza');
            $('#validate').text('Submit'); //change button text
            $('#validate').attr('disabled',false); //set button enable 

        }
    });
 console.log(print);
         readyprint(print);
        return false;
}


function getbarang(nota)
{
$('#send-item').children().empty().remove();
var url = site_url+"Master/getbarangfromnota/";

$.ajax({
    url : url,
    type: "get",
    data: {nota:nota},
    dataType: "JSON",
    success: function(data)
    {
       var display = '';
         jQuery.each(data, function(index,item) {
          if(item.qty > 0 ){
            display += '<tr class="cart-value" id="'+item.id+'"><input type="hidden" value="'+item.id+'" name="trx['+item.id+'][id_labarugi]">' +
                  /*'<td></td>' +*/
                  '<td>'+ item.tanggal +'</td>' +
                  '<td><input type="hidden" value="'+item.barang+'" name="trx['+item.id+'][barang]">'+item.barang +'</td>' +
                  '<td>'+item.qty +'</td>' +
                  '<td><input type="text"  name="trx['+item.id+'][jumlah]" class="form-control col-md-7 col-xs-12" data-parsley-max="'+item.qty +'" data-parsley-type="integer" required="required"></td>' +
                  '<td><textarea type="text"  name="trx['+item.id+'][note]" class="form-control col-md-7 col-xs-12"></textarea></td>' +
                  '<td data-cart="'+item.id+'"><span class="btn btn-danger btn-sm kirim-delete-item"  data-cart="'+item.id+'">x</span></td>' +
                  '</tr>'; 
          }
          

            $("#nama-konsumen").text('Konsumen: '+item.konsumen);  
          });
           
        $("#send-item").append(display);    
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    },
});
}
function riwayatbarang(nota)
{
$('#riwayat').children().empty().remove();
var url = site_url+"Master/getriawayat/";

$.ajax({
    url : url,
    type: "get",
    data: {nota:nota},
    dataType: "JSON",
    success: function(data)
    {
       var display = '<div class="col-md-6 col-sm-6"><table class="table table-striped"><thead><tr><th>Barang</th><th>Jumlah</th><th>Jumlah Dikirim</th><th>Sisa</th></tr></thead><tbody>';
         jQuery.each(data.tabel, function(index,item) {
          display += ' <tr><td>'+item.barang+'</td><td>'+item.jumlah_order+'</td><td>'+item.jumlah_kirim+'</td><td>'+item.qty+'</td></tr>';
          
            //$("#nama-konsumen").text('Konsumen: '+item.konsumen);  
          });
         display += '</tbody></table></div>';
         display += '<div class="col-md-6 col-sm-6"> <ul class="list-unstyled timeline widget">';
         jQuery.each(data.riwayat, function(index,item) {
          tgl = moment(index, 'YYYY-MM-DD').format('DD MMM YYYY');
            display += '<li><div class="block"><div class="block_content"><h2 class="title"><a><i class="fa fa-truck" aria-hidden="true">'+
            '</i> Pengiriman Kepada &nbsp;'+data.konsumen+'&nbsp;</a><a class="btn btn-round btn-success btn-xs faktur" nota="'+data.nota+'" tgl="'+index+'">Faktur</a>';
            display +='<a class="btn btn-round btn-danger btn-xs hpskirim" idkirim="'+item.id+'" nota="'+data.nota+'" tgl="'+index+'">Hapus</a></h2>';
            display += '<div class="byline"><span>'+tgl+'</span> oleh <a>Hqpacks</a></div>';
            display += '<p class="excerpt">Telah Dilakukan Pengiriman pada tanggal '+moment(index, 'YYYY-MM-DD').format('DD MMM YYYY')+' Kepada konsumen: '+data.konsumen+' No nota: '+data.nota+' dengan rincian berikut: ';
            display += '<table class="table table-striped"><thead><tr><th>Jumlah</th><th>Barang</th></tr></thead><tbody>';
          
            jQuery.each(item, function(key,val) {
              display += '<tr><td>'+val.jumlah+'</td><td>'+val.barang+'</td></tr>';
            })
            display += '</tbody></table>';
        });
        display += '</p></div></div></li></ul>';
           
        $("#riwayat").append(display);    
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    },
});
}
function readyprint(data){
console.log(data.tanggal);

  var copy = [];
  var kirim = [];
  
  kirim.push([
                    {text:'Dengan ini kami menyatakan bahwa telah menerima sejumlah barang dalam kondisi baik dengan jumlah dan deskripsi sebagai berikut',colSpan:4,border: [false, false, false, false],style:'section'},
                    {},
                    {},
                    {}
                ],[
                    {text:'No',fillColor: '#dedede'},
                    {text:'Deskripsi',fillColor: '#dedede'},
                    {text:'Qty',fillColor: '#dedede'},
                    {text:'Remaks',fillColor: '#dedede'},
                ]);
  i =0;
  data.data.forEach(function (item) { 
           kirim.push([i+1,item.barang,item.jumlah,item.note]);
           i++;
  });
    copy.push([
                    {text:'Dengan ini kami menyatakan bahwa telah menerima sejumlah barang dalam kondisi baik dengan jumlah dan deskripsi sebagai berikut',colSpan:4,border: [false, false, false, false],style:'section'},
                    {},
                    {},
                    {}
                ],[
                    {text:'No',fillColor: '#dedede'},
                    {text:'Deskripsi',fillColor: '#dedede'},
                    {text:'Qty',fillColor: '#dedede'},
                    {text:'Remaks',fillColor: '#dedede'},
                ]);
  i =0;
  data.data.forEach(function (item) { 
           copy.push([i+1,item.barang,item.jumlah,item.note]);
           i++;
  });

   tanggal=moment(data.tanggal, 'YYYY-MM-DD').format('DD-MM-YYYY');
   console.log(copy);
  
var dd = {
  pageSize: 'A5',
  pageMargins: [30, 135, 40, 60],
  header: function(currentPage, pageCount) {
    return {
            margin : [30,10],
            columns: [
               
                    {
              layout: 'noBorders',
              table: {
                  widths: [ 'auto', 'auto', '*'],
                 
                body: [
                  [{},{}, {
                            text: 'Hal ' + currentPage.toString() + '/' + pageCount,
                            fontSize: 9,
                            alignment: 'right',
                            }],
                  [
                  {
                                image:'data:image/png;base64,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',
                                width: 40,
                                
                            }, 
                  {
                                text: 'Jl. Asem Gede, Gg. Assalam Utama No. 2\nCondong catur, Depok, Sleman, Yogyakarta\nPh / WA : 0812 7701 5665\nEmail : cso@hqpacks.com',
                                fontSize: 7,
                      margin: 4
                  },
                            {
                                text:'TANDA TERIMA',
                                margin: 3,
                      fontSize: 18,
                                bold: true,
                                alignment: 'right',
                  }],
                  [{text:'',margin: 4},{},{}],
                  [ {colSpan:3,
                                 text: 'No.  : '+data.nota+ ' - TT\n Tgl  : '+data.tanggal,
                                   fillColor: '#dedede',
                                },{},{}]
                ],
                
              }
                },
        
            ],        
   };
  },
  content: [
      
        {text:'Kepada Yth',fontSize: 9},
        {
            text:data.konsumen,
            bold: true,
            fontSize: 9,
        },
        
        {
            style: 'section',
            table: {
                widths: '49%',
                body: [
                    [ 
                        
                        {
                          text: data.alamat,
                          fontSize: 9,
                        },
                        
                    ]
                ]
            },
            layout: 'noBorders',
        },
      
        {
           style:'section',
            table: {
                widths: ['4%','*','10%','*' ],
                body: kirim
            },
            layout: 'Borders',
             margin: [ 1,1 , 1, 20 ],
            
        },
         {
           style:'section',
            table: {
                widths: ['25%','25%','25%','25%'],
                heights: [70,0,0],
                body: [
                    [
                        {text:'Diterima oleh:',alignment:'center',},
                        {},
                        {},
                        {text:'Dikirim Oleh',alignment:'center'},
                    ],
                   
                    [{canvas: [ { type: 'line', x1: 0, y1: 0, x2: 80, y2: 0, lineWidth: 1 } ],
                        alignment:'center',
                    },
                        {},
                        {},
                        {canvas: [ { type: 'line', x1: 0, y1: 0, x2: 80, y2: 0, lineWidth: 1 } ],
                        alignment:'center',
                        pageBreak:'after',
                    },
                    ],
                     
                    
                    
                ]
            },
            layout: 'noBorders',
             margin: [1, 3]
            
        },
         {text:'Kepada Yth',fontSize: 9},
        {
            text:data.konsumen,
            bold: true,
            fontSize: 9,
        },
        
        {
            style: 'section',
            table: {
                widths: '49%',
                body: [
                    [ 
                        
                        {
                          text: data.alamat,
                          fontSize: 9,
                        },
                        
                    ]
                ]
            },
            layout: 'noBorders',
        },
      
        {
           style:'section',
            table: {
                widths: ['4%','*','10%','*' ],
                body: copy
            },
            layout: 'Borders',
             margin: [1, 1]
            
        },
         {
           style:'section',
            table: {
                widths: ['25%','25%','25%','25%'],
                heights: [70,0,0],
                body: [
                    [
                        {text:'Diterima oleh:',alignment:'center',},
                        {},
                        {},
                        {text:'Dikirim Oleh',alignment:'center'},
                    ],
                   
                    [{canvas: [ { type: 'line', x1: 0, y1: 0, x2: 80, y2: 0, lineWidth: 1 } ],
                        alignment:'center',
                    },
                        {},
                        {},
                        {canvas: [ { type: 'line', x1: 0, y1: 0, x2: 80, y2: 0, lineWidth: 1 } ],
                        alignment:'center',
                    },
                    ],
                     [
                        {},
                        {},
                        {},
                        {},
                    ],
                    
                    
                ]
            },
            layout: 'noBorders',
             margin: [1, 30]
            
        },
      
  ],
  styles: {
    header: {
      fontSize: 18,
      bold: true
    },
    bigger: {
      fontSize: 22,
      bold: true,
      
    },
    section :{
        fontSize:9,
    },
    filledHeader: {
            bold: true,
            fontSize: 14,
            color: 'gray',
            fillColor: 'black',
            alignment: 'left'
        }
  }
  
}

// open the PDF in a new window

   pdfMake.createPdf(dd).open();



    
}

function edit(id)
{
    
var url = site_url+"Master/getstock/";
$('#formubah')[0].reset(); // reset form on modals
//Ajax Load data from ajax
$.ajax({
    url : url+id,
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
        
        $('#id').val(data.id);
        $('#jumlahup').val(data.jumlah);
        $('#barangup').val(data.barang);
        $('#konsumenup').val(data.konsumen);
        $('#tanggalup').val(data.tanggal);
        $('#notaup').val(data.nota);
        $('#noteup').val(data.note);
        $('#jumlahup').attr("data-parsley-max",data.batas);
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
function update(){
$('#validate2').text('Submit...'); //change button text
$('#validate2').attr('disabled'); //set button enable 
$.ajax({
    context: this,
    url: site_url+"Master/upstock",
    type: "POST",
    data: $('#formubah').serialize(),
    dataType: "JSON",
    success: function(data)
    {
        if(data.status) //if success close modal 
        {
            berhasil();
            $('#modubah').modal('hide');
            $('#validate2').text('Submit'); 
            $('#validate2').attr('disabled',false);
            table.ajax.reload(null,false);
            
        }

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('data nama konsumen tidak boleh sama');
        $('#validate2').text('Submit'); //change button text
        $('#validate2').attr('disabled',false); //set button enable 

    }
});
}

function hapus(tgl,nota,ket){
  console.log(tgl)
      if(confirm('apakah ada yakin ingin menghapus data ini '+ket)){
    var url = site_url+"Master/hpsstock/";
  $.ajax({
        url : url,
        data: {tanggal:tgl,nota:nota},
        type: "GET",
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
function hapusnota(nota,ket){
      if(confirm('apakah ada yakin ingin menghapus keselurhan data di nota ini "'+nota+'"')){
    var url = site_url+"Master/hpsstock/";
  $.ajax({
        url : url,
        data: {nota:nota},
        type: "GET",
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