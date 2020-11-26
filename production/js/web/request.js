var tot;
var bayar=0;
$(function() {
var input = $("#barang");
  $.get(site_url+'Request/barang', function(data){
              input.typeahead({
              source: data,
              minLength:1,
            });  
        },'json');
            input.change(function(){
                var current = input.typeahead("getActive");
                $('#id').val(current.id);
                $('#kode').val(current.kode);
                $('#barang').val(current.name);
            });
        });
        
$(document).on("click",".req-delete-item",function(e){
        var rowid = $(this).attr("data-cart");
        hapus(rowid);
    });
shortcut.add("F1",function() {
     if ( $('#form').parsley().validate()){
        tambah();
    }
    else
    {
      gagal();
    }
});
shortcut.add("F3",function() {
   var rowid=$('#req-item td:last').attr("data-cart");
     hapus(rowid);
});
shortcut.add("F6",function() {
      req();  
});
$('#tambah-barang').click(function () {
    if ( $('#form').parsley().validate()){
        tambah();
    }
    else
    {
      gagal();
    }
    });
$('#req-barang').click(function () {
    req();  
});

function tambah(){
    $.ajax({
        url:site_url+'Request/addbarang',
        data: $('#form').serialize(),
        type:"POST",
        dataType:"json",
        success: function(data){
            if(data.status){
                var res = data;
                $(".cart-value").remove();
                        $.each(res.data, function(key,value) {
                var display = '<tr class="cart-value" id="'+ key +'">' +
                                        '<td>'+ value.kode +'</td>' +
                                        '<td>'+ value.name +'</td>' +
                                        '<td>'+ value.qty +'</td>' +
                                        '<td data-cart="'+ key +'"><span class="btn btn-danger btn-sm req-delete-item" data-cart="'+ key +'">x</span></td>' +
                                        '</tr>';
                    $("#req-item").append(display);
                    });
                    $('#form')[0].reset();
                }
        }
    });
}
function req(){
    $.ajax({
                url: site_url+"Request/addreq",
                type: 'POST',
                dataType:"json",
                success: function (data) {
                   if(data.status){
                    $('#req-item').empty();
                    berhasil();
                   }else{
                    $('#req-item').empty();
                    info(data.ket);
                   }
                }
            });
}
function hapus(rowid){
 $.getJSON(site_url+ 'Request/deletebarang/'+rowid,function(data){
            if(data.status){
            $("#"+rowid).remove();
            }
        });
}
