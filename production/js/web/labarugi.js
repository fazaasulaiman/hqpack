var pengeluaran,kotor,foc,rusak,hilang,tot,kpm,tgl1,tgl2; 
$(function() {
var inputkpm = $("#kpm");
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpm.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            inputkpm.change(function(){
                var current = inputkpm.typeahead("getActive");
                $('#id').val(current.id);
            });
    $('#pencarian').click(function () {
    if ( $('#form').parsley().validate()){
        cari();
    }
    else
    {
      gagal();
    }
	});
	$('#print').click(function () {
		print();
	});
	$('#pdf').click(function () {
		pdf();
	});
});
function cari(){
	$('#foc,#rusak,#hilang,#pengeluaran,#pengeluaran2,#kotor,#tot').empty();

	$.ajax({
		url:site_url+'Laporan/getangka',
		data:$('#form').serialize(),
		dataType:"json",
		type:"POST",
		success:function(data){
			if(data.status){
				kotor=(+data.kotor);
				foc=(+data.foc);
				rusak=(+data.rusak);
				hilang=(+data.hilang);
				pengeluaran=(+data.foc)+(+data.rusak)+(+data.hilang);
				tot=kotor-pengeluaran;
				$('#kotor').text('Rp '+price(kotor));
				$('#foc').text('Rp '+price(foc)+' (+)');
				$('#rusak').text('Rp '+price(rusak));
				$('#hilang').text('Rp '+price(hilang));
				$('#pengeluaran').text('Rp '+price(pengeluaran));
				$('#pengeluaran2').text('Rp '+price(pengeluaran)+' (-)');
				$('#tot').text('Rp '+price(tot));
				kpm=$('#kpm').val();
				tgl2=$('#tgl2').val();
				tgl1=$('#tgl1').val();
				$('#form')[0].reset();
				berhasil();
			}else{
				info('Data transaksi penjualan tidak ada');
				$('#form')[0].reset();
			}
		}
	});
}
function print(){
	$(".printini").printThis({ 
    debug: true,              
    importCSS: true,             
    importStyle: true,         
    printContainer: true,       
    loadCSS: site_url+"vendors/bootstrap/dist/css/bootstrap.css", 
    pageTitle: "laporan Laba Rugi",             
    removeInline: false,        
    printDelay: 333,            
    header: null,             
    formValues: true          
    }); 
}
function pdf(){
 var docDefinition = {
   content: [
     
     { text: 'Laporan Laba Rugi Bersih '+kpm+' '+tgl1+' sampai '+tgl2, fontSize: 16 , style:'header'},
		
		{
			style: 'tableExample',
			table: {
				widths: [200, 200, 200, 200],
				body: [
					['Laba Kotor', '', 'Rp '+price(+kotor)],
					['Biaya pengeluaran :','',''],
					['\t\t\t\t\t'+'Hilang','Rp '+price(+hilang),''],
					['\t\t\t\t\t'+'Rusak','Rp '+price(+rusak),''],
					['\t\t\t\t\t'+'FOC',
					{
							text: 'Rp '+price(+foc)+' (+)'
						},''],
					['Total Pengeluaran','Rp '+price(+pengeluaran),'Rp '+price(+pengeluaran)+' (-)'],
					['Laba Bersih','','Rp '+price(+tot)]
				]
			},
		layout:'noBorders'
		},

     
   ]
 };
// open the PDF in a new window
 pdfMake.createPdf(docDefinition).open();
}