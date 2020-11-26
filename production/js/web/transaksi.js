var tot;
var bayar=0;
$(function() {
var input = $("#barang");
  $.get(site_url+'Pos/barang', function(data){
              input.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            input.change(function(){
                var current = input.typeahead("getActive");
                $('#id').val(current.id);
                $('#harga').val(current.jual);
                $('#produksi').val(current.produksi);
                $('#kode').val(current.kode);
                $('#namabarang').val(current.barang);
            });
        $('#jumlah').change(function(){
        $('#itemharga').val($('#harga').val()*$(this).val());  
       
        $('#diskon').change(function(){ 
        $('#itemharga').val(($('#harga').val()*$('#jumlah').val())-($('#jumlah').val()*$(this).val()));  
    });
});
    $('#tunai,#voucher,#atm').change(function(){
         bayar=(+$('#tunai').val())+(+$('#atm').val())+(+$('#voucher').val());
        
        kembali();
    });
$(document).on("click",".transaksi-delete-item",function(e){
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
   var rowid=$('#transaksi-item td:last').attr("data-cart");
     hapus(rowid);
});
shortcut.add("F6",function() {
    if(tot>bayar){
        info('Uang yang dibayarkan kurang');
    }else{
      transaksi();  
    }
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
$('#bayar-barang').click(function () {
    if(tot>bayar){
        info('Uang yang dibayarkan kurang');
    }else{
      transaksi();  
    }
   
    });
});

function tambah(){
    $.ajax({
        url:site_url+'Pos/addbarang',
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
                                        '<td>'+ value.price +'</td>' +
                                        '<td>'+ value.diskon +'</td>' +
                                        '<td>Rp'+ price(value.subtotal) +'</td>' +
                                        '<td data-cart="'+ key +'"><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="'+ key +'">x</span></td>' +
                                        '</tr>';
                    $("#transaksi-item").append(display);
                    });
                    $("#total-pembelian").text('Rp'+price(res.total_price));
                    tot=res.total_price;
                    kembali();
                    $('#form')[0].reset();
                }else{
                    info(data.ket);
                }
        

        }
    });
}
function transaksi(){
    var tunai=$('#tunai').val();
    var atm=$('#atm').val();
    var voucher=$('#voucher').val();
    $.ajax({
                url: site_url+"Pos/addtransaksi",
                data: {tunai:tunai,atm:atm,voucher:voucher},
                type: 'POST',
                dataType:"json",
                success: function (data) {
                   if(data.status){
                    $('#tunai').val('');
                    $('#atm').val('');
                    $('#voucher').val('');
                    $('#total-pembelian,#pembayaran,#kembali,#transaksi-item').empty();
                    tot=0;
                    bayar=0;
                    berhasil();
                   }else{
                    $('#tunai').val('');
                    $('#atm').val('');
                    $('#voucher').val('');
                    $('#total-pembelian,#pembayaran,#kembali,#transaksi-item').empty();
                    tot=0;
                    bayar=0;
                    info(data.ket);
                   }
                }
            });
}
function hapus(rowid){
 $.getJSON(site_url+ 'Pos/deletebarang/'+rowid,function(data){
            if(data.status){
            $("#"+rowid).remove();
            $("#total-pembelian").text('Rp'+data.harga);
            tot=data.harga;
            kembali();

            }
        });
}
function kembali(){
    $('#kembali').text('Rp '+price(bayar-tot));
    $('#pembayaran').text('Rp '+price(bayar));
}
