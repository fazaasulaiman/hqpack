var bulan1,bulan2,tahun1,tahun2;
$(function() {
	$('#pdf').click(function () {
		pdf();
	});
	$(".datepickermonth").datepicker({
    
        // The format you want
    format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    autoclose: true,
        // The format the user actually sees
        format: "M yy",
    });
    $(".datepickeryear").datepicker({
    
        // The format you want
     format: "yyyy",
     viewMode: "years", 
     minViewMode: "years",
     autoclose: true,
        // The format the user actually sees
        format: "yyyy",
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
	$('#cariyear').click(function () {
	    if ( $('#formyear').parsley().validate()){
	        cariyear();
	    }
	    else
	    {
	      gagal();
	    }
	});
	$('#downloadPdf').click(function(event) {
		
		var node = document.getElementById('taruh');
	    var options = {
	        quality: 2
	    };
	    domtoimage.toJpeg(node, options).then(function (dataUrl)
	    {
	        var doc = new jsPDF('landscape');
	        doc.addImage(dataUrl, 'JPEG', 10, 10, 280, 150);
	        filename = 'Chart Perbandingan Bulan '+bulan1+' dan '+bulan2;
	        doc.save(filename+'.pdf');
	    });
    });
    $('#downloadPdf2').click(function(event) {
		
		var node = document.getElementById('taruhyear');
	    var options = {
	        quality: 2
	    };
	    domtoimage.toJpeg(node, options).then(function (dataUrl)
	    {
	        var doc = new jsPDF('landscape');
	        doc.addImage(dataUrl, 'JPEG', 10, 10, 280, 150);
	        filename = 'Chart Perbandingan Tahun '+tahun1+' dan '+tahun2;
	        doc.save(filename+'.pdf');
	    });
    });
	
});

function cari(){
	$("#barchart").remove();
	$('#taruh').append('<canvas id="barchart" id="status" width="1200;" height="600;"></canvas>');
	$.ajax({
		url:site_url+'Master/chartMonth',
		data:$('#form').serialize(),
		dataType:"json",
		type:"POST",
		success:function(data){
			if(data.status){
				month1 = data.chart.month1;
				month2 = data.chart.month2;
				bulan1 = $('#month1').val();
				bulan2 = $('#month2').val();
				var ctx = document.getElementById('barchart').getContext('2d');
				var myChart = new Chart(ctx, {
			    type: 'bar',
			    data: {
			        labels: ['Penjualan', 'Laba Kotor', 'Laba Bersih'],
			        datasets: [
			        	{
				        	label: $('#month1').val(),
				          	backgroundColor: "#3e95cd",
				          	data: [month1.penjualan,month1.kotor,month1.bersih]
			        	},
			        	{
				          label: $('#month2').val(),
				          backgroundColor: "#8e5ea2",
				          data: [month2.penjualan,month2.kotor,month2.bersih]
			        	}
			        ]
			    },
				    options: {
				        title: {
				        display: true,
				        text: 'Bagan Perbandingan aktivitas usaha',
				      	},
				      	tooltips: {
				          callbacks: {
				                label: function(t, data) {
									if (t.datasetIndex === 0) {
							           var value = data.datasets[0].data[t.index];
							            var rp;
							           (value<0) ? rp ='-Rp ' : rp ='Rp ';
				                    	return rp+formatRupiah(value.toString().replace('.',','), "Rp. ");
							        } else if (t.datasetIndex === 1) {
							            var value = data.datasets[1].data[t.index];
				                    	 var rp;
							           (value<0) ? rp ='-Rp ' : rp ='Rp ';
				                    	return rp+formatRupiah(value.toString().replace('.',','), "Rp. ");
							        }
				                    
				                }
				          } // end callbacks:
				        }, //end tooltips   
				        scales: {
			                yAxes: [{
			                    ticks: {
			                        beginAtZero:true,
			                        callback: function(value, index, values) {
			                            
			                            return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			                          
			                       }                            
			                    }
			                }]
				        }
				        

				    }
				});
				$('#form')[0].reset();
			}else{
				info('Data transaksi penjualan tidak ada');
				$('#form')[0].reset();
			}
		}
	});
}
function cariyear(){
	$("#barchartyear").remove();
	$('#taruhyear').append('<canvas id="barchartyear" width="100;" height="50;"></canvas>');
	$.ajax({
		url:site_url+'Master/chartYear',
		data:$('#formyear').serialize(),
		dataType:"json",
		type:"POST",
		success:function(data){
			if(data.status){
				year1 = data.chart.year1;
				year2 = data.chart.year2;
				tahun1 = $('#year1').val();
				tahun2 = $('#year2').val();
				var ctx = document.getElementById('barchartyear').getContext('2d');
				var myChart = new Chart(ctx, {
			    type: 'bar',
			    data: {
			        labels: ['Penjualan', 'Laba Kotor', 'Laba Bersih'],
			        datasets: [
			        	{
				        	label: $('#year1').val(),
				          	backgroundColor: "#3e95cd",
				          	data: [year1.penjualan,year1.kotor,year1.bersih]
			        	},
			        	{
				          label: $('#year2').val(),
				          backgroundColor: "#8e5ea2",
				          data: [year2.penjualan,year2.kotor,year2.bersih]
			        	}
			        ]
			    },
				    options: {
				        title: {
				        display: true,
				        text: 'Bagan Perbandingan aktivitas usaha',
				      	},
				      	tooltips: {
				          callbacks: {
				                label: function(t, data) {
									if (t.datasetIndex === 0) {
							           var value = data.datasets[0].data[t.index];
							            var rp;
							           (value<0) ? rp ='-Rp ' : rp ='Rp ';
				                    	return rp+formatRupiah(value.toString().replace('.',','), "Rp. ");
							        } else if (t.datasetIndex === 1) {
							            var value = data.datasets[1].data[t.index];
				                    	 var rp;
							           (value<0) ? rp ='-Rp ' : rp ='Rp ';
				                    	return rp+formatRupiah(value.toString().replace('.',','), "Rp. ");
							        }
				                    
				                }
				          } // end callbacks:
				        }, //end tooltips   
				        scales: {
			                yAxes: [{
			                    ticks: {
			                        beginAtZero:true,
			                        callback: function(value, index, values) {
			                             return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			                       }                            
			                    }
			                }]
				        }
				        

				    }
				});
				$('#formyear')[0].reset();
			}else{
				info('Data transaksi penjualan tidak ada');
				$('#formyear')[0].reset();
			}
		}
	});
}