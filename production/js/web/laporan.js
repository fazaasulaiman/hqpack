var penjualan,pengeluaran,kotor,pdfkotor,total,hpp;
var o = {};
$(function() {
	$('#pdf').click(function () {
		pdf();
	});
	$(".datepicker").datepicker({
    
        // The format you want
        todayHighlight: true,
        todayBtn: true,
        altFormat: "yy-mm-dd",
        autoclose: true,
        // The format the user actually sees
        format: "dd M yy",
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
});


function cari(){
	//$('#foc,#rusak,#hilang,#pengeluaran,#pengeluaran2,#kotor,#tot').empty();
var html = '<tr><td colspan="3" style="text-align:center;"><h3>LAPORAN LABA RUGI <br> PERIODE ';
	html += $('#tgl1').val()+' SAMPAI '+$('#tgl2').val()+' </h3></td>';
	$('#judul,.kotor,#father,#pengeluaran,#pengeluaran2,#tot','#hpp').empty();
	/*$('#before').before().empty();*/
	$('#judul').append(html);
	$.ajax({
		url:site_url+'Master/getLaporan',
		data:$('#form').serialize(),
		dataType:"json",
		type:"POST",
		success:function(data){
			if(data.status){
				pengeluaran = 0;
 				var report = data.report
 				
 				penjualan = report.penjualan;
 				pdfkotor = report.kotor;
 				hpp = report.hpp;
				$('.kotor').text('+Rp '+report.kotor);
				$('#hpp').text('-Rp '+report.hpp);
				$('#penjualan').text('+Rp '+report.penjualan);
				console.log(report);
				$.each(report, function( index, value ) {
					if (index !== 'penjualan' && index !== 'kotor' && index !== 'hpp') {
						$('#father').append('<tr><td><b><u>'+index+'</b></u></td><td id="hilang"></td><td></td></tr>');
						$.each(value, function( subindex, subval ) {
							$('#father').append('<tr><td><div class="col-md-12">'+subval.text+'</div></td><td>-Rp '+price((+subval.jumlah))+'</td><td></td></tr>');
							pengeluaran  = pengeluaran + (+subval.jumlah);
						});
					}
					
				});
				//penjualan = report.penjualan.split('.').join("");
			
				(report.kotor.length>3) ? kotor= report.kotor.split('.').join("").replace(',','.'):kotor = report.kotor;
				console.log(kotor);
				pengeluaran = pengeluaran;
				total = kotor - pengeluaran;
				total = total.toFixed(2);
				(Math.sign(total) <0) ? rp = '-Rp ':rp = 'Rp ';
				console.log(total);
				total = rp+formatRupiah(total.replace('.',','), "Rp. ");
				$('#pengeluaran').text('Rp '+price(pengeluaran));
				$('#pengeluaran2').text('Rp '+price(pengeluaran)+' (-)');
				$('#tot').text(total);
				//$('#before').before('<tr><td><b><u>cek</b></u></td><td id="hilang"></td><td></td></tr>')
				/*kotor=(+data.kotor);
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
				kpm=$('#kpm').val();*/
				tgl2=$('#tgl2').val();
				tgl1=$('#tgl1').val();
				delete report.Penjualan;
				delete report.kotor;
				o = report;
				$('#form')[0].reset();
				berhasil();
			}else{
				info('Data transaksi penjualan tidak ada');
				$('#form')[0].reset();
			}
		}
	});
}
function pdf(){
	console.log(o);
	var arr = [];

	arr.push(['Penjualan','+Rp '+penjualan,'']);
	arr.push(['HPP','-Rp '+hpp,'']);
	arr.push(['Laba Kotor','+Rp '+pdfkotor,'+Rp '+pdfkotor]);
	
	$.each(o, function( index, value ) {
		if (index !== 'penjualan' && index !== 'kotor' && index !== 'hpp') {
			arr.push([index,'','']);
			var i =1;
			$.each(value, function( subindex, subval ) {
				
				arr.push(['\u200B\t\t\t'+i+'. '+subval.text,'-Rp '+formatRupiah(subval.jumlah, "Rp. "),'']);
				i++;
			});
		}	
	})
	arr.push(['Total Pengeluaran','-Rp '+ price(pengeluaran),'Rp '+ price(pengeluaran)+' (-)']);
	arr.push(['Laba Bersih','',total]);

	console.log(arr);
 var docDefinition = {
   content: [
  
     { text: 'LAPORAN LABA RUGI PERIODE', fontSize: 16 , style:'header' ,alignment:'center'},
     { text: tgl1+' SAMPAI '+tgl2+'\n\n\n\n', fontSize: 16 , style:'header',alignment:'center'},
		
		{
			style: 'tableExample',
			table: {
				widths: [200, 200, 200, 200],
			
				body: arr
			},
		layout:'noBorders'
		},

     
   ]
 };
// open the PDF in a new window
 pdfMake.createPdf(docDefinition).open();
}