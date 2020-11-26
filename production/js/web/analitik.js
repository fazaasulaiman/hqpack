var pieOptions = {
  events: false,
  animation: {
    duration: 500,
    easing: "easeOutQuart",
    onComplete: function () {
      var ctx = this.chart.ctx;
      ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
      ctx.textAlign = 'center';
      ctx.textBaseline = 'bottom';

      this.data.datasets.forEach(function (dataset) {

        for (var i = 0; i < dataset.data.length; i++) {
          var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
              total = dataset._meta[Object.keys(dataset._meta)[0]].total,
              mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
              start_angle = model.startAngle,
              end_angle = model.endAngle,
              mid_angle = start_angle + (end_angle - start_angle)/2;

          var x = mid_radius * Math.cos(mid_angle);
          var y = mid_radius * Math.sin(mid_angle);

          ctx.fillStyle = '#fff';
          if (i == 3){ // Darker text color for lighter background
            ctx.fillStyle = '#444';
          }
          var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
          ctx.fillText(dataset.data[i], model.x + x, model.y + y);
          // Display percent in another line, line break doesn't work for fillText
          ctx.fillText(percent, model.x + x, model.y + y + 15);
        }
      });               
    }
  }
};

 $(document).ready(function() {
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
     var inputkpm1 = $("#kpm1");
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpm1.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            inputkpm1.change(function(){
                var current = inputkpm1.typeahead("getActive");
                $('#id1').val(current.id);
            });
    	var inputkpm2 = $("#kpm2");
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpm2.typeahead({
              source: data,
              minLength:1,
            });
             
        },'json');
            inputkpm2.change(function(){
                var current = inputkpm2.typeahead("getActive");
                $('#id2').val(current.id);
            });
	$('#pencarian').click(function () {
	if ( $('#form').parsley().validate()){
    banding=$('#bandingtahun').val();
	barstahun(banding);
	}else{
	gagal();
	}
	});
  $('#pencarian2').click(function () {
  if ( $('#form2').parsley().validate()){
    banding=$('#bandingkpm').val();
  barskpm(banding);
  }else{
  gagal();
  }
  });
});
function barskpm(banding){
  var url,laba;
  if(banding=='kotor'){
     url=site_url+'laporan/analkotorkpm';
     laba='Laba Kotor';
  }
  if(banding=='bersih')
  {
     url=site_url+'laporan/bersihkpm';
     laba='Laba Bersih';
  }
$("#barchart").remove();
$('#taruh').append('<canvas id="barchart" id="status" width="100;" height="50;"></canvas>');
$.ajax({
	url:url,
	data:$('#form2').serialize(),
	type:"POST",
	dataType:"json",
	success: function(valu){
		if(valu.status){
			var ctx = $("#barchart").get(0).getContext("2d");
      var options = {
        scales: {
        xAxes: [{
            barPercentage: 0.4,
            display: true,
                ticks: {
                     beginAtZero: true
                }
        }],   
    },
        animation: {
         onComplete: function() {
            var ctx = this.chart.ctx;
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            var chart = this;
            var datasets = this.config.data.datasets;

            datasets.forEach(function (dataset, i) {
                ctx.font = "20px Arial";
                        ctx.fillStyle = "White";
                        chart.getDatasetMeta(i).data.forEach(function (p, j) {
                            ctx.fillText(datasets[i].data[j], p._model.x-((20/100)*p._model.x), p._model.y);
                        });
                
            });
            }
        }
    
};
var data = {
    labels: [$('#kpm1').val(),$('#kpm2').val()],
    datasets: [
        {
            label:laba+' perbandingan '+$('#kpm1').val()+' dan '+$('#kpm2').val()+' pertanggal '+$('#tgl1').val()+' sampai '+$('#tgl2').val(),
           backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            data: [valu.angka1, valu.angka2],
            borderWidth:1
        }
    ]
};
	var myBarChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: data,
    options:options
	});
$('#form2')[0].reset();
		}

	}
});

}
function barstahun(banding){
  var url,laba;
  if(banding=='kotor'){
     url=site_url+'laporan/analkotortahun';
     laba='Laba Kotor';
  }else{
     url=site_url+'laporan/bersihtahun';
     laba='Laba Kotor';
  }
$("#barchart").remove();
$('#taruh').append('<canvas id="barchart" id="status" width="100;" height="50;"></canvas>');
$.ajax({
	url:url,
	data:$('#form').serialize(),
	type:"POST",
	dataType:"json",
	success: function(valu){
		if(valu.status){
			var ctx = $("#barchart").get(0).getContext("2d");
var data = {
    labels: ["Januari", "Februai", "Maret", "April", "Mei", "Juni", "Juli","Agustus","September","Oktober","November","Desember"],
    datasets: [
        {
            label: laba+' '+$('#kpm').val()+' tahun '+$('#tahun').val(),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            data: [valu.jan, valu.feb, valu.mar,valu.apr, valu.mei, valu.jun, valu.jul, valu.agus,valu.sept,valu.okt,valu.nov,valu.des],
        }
    ]
};
	var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options:{
          scales:{
               yAxes: [{
                  display: true,
                  ticks: {
                       beginAtZero: true
                  }
              }]
          },
          animation: {
         onComplete: function() {
            var ctx = this.chart.ctx;
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            var chart = this;
            var datasets = this.config.data.datasets;

            datasets.forEach(function (dataset, i) {
                ctx.font = "12px Arial";
                        ctx.fillStyle = "White";
                        chart.getDatasetMeta(i).data.forEach(function (p, j) {
                            ctx.fillText(datasets[i].data[j], p._model.x, p._model.y + 20);
                        });
                
            });
            }
        }
    }
	});
$('#form')[0].reset();
		}

	}
});

}