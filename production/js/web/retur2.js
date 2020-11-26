$(function() {
shortcut.add("F3",function() {
   var rowid=$('#transaksi-item td:last').attr("data-cart");
     hapus(rowid);
});
shortcut.add("F6",function() {
   
      transaksi();  
    
});
$(document).on("click",".transaksi-delete-item",function(e){
        var rowid = $(this).attr("data-cart");
        hapus(rowid);
    });
$('#bayar-barang').click(function () {
      transaksi();  
    });
$(".retur_penjualan_qty").on("keyup change",function(e){
        var id = $(this).attr("row-id");
        var qty = $(this).val();
        update(id,qty);
    });
});

function hapus(rowid){
 $.getJSON(site_url+ 'Pos/deletebarang/'+rowid,function(data){
            if(data.status){
            $("#"+rowid).remove();
            $("#total-pembelian").text('Rp'+data.harga);
            $("#total-item").text('Rp'+data.jumlah);
            }
        });
}
function transaksi(){
    var id_penjualan=$('#id_penjualan').text();
     $.ajax({
                url: site_url+"Pos/addretur",
                data: {id_penjualan:id_penjualan},
                type: 'POST',
                dataType:"json",
                success: function (data) {
                   if(data.status){
                    berhasil();
                    location.href = site_url+"Pos/retur";
                   }
                }
            });
}
function update(id,qty){
    $.ajax({
            url:site_url+'/Pos/update_jumlah/'+id,
            data:{qty:qty},
            type:"POST",
            dataType:"json",
            success:function(data){
                if(data.status){
                    $("#total-pembelian").text("Rp "+price(data.total));
                    $("#total-item").text(data.jumlah);
                    berhasil();
                }
            }

        });
}