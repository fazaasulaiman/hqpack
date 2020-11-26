$(document).ready(function() {
 
   $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true  
    });
});
   var site_url = "<?php echo site_url(); ?>";
   var csfrData = {};
  csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
  $.ajaxSetup({
  data: csfrData
  });
var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
          
            var d = day + "-" + month + "-" + year;
function berhasil(){
  new PNotify({
     title: 'Regular Success',
    text: 'Sukses melakukan aksi',
    type: 'success',
    styling: 'bootstrap3',
    delay:3000
});
}
function gagal(){
  new PNotify({
     title: 'Gagal',
    text: 'Isi sesuai dengan yang diminta',
    type: 'notice',
    styling: 'bootstrap3',
    delay:3000
});
}
function info(ket){
  new PNotify({
     title: 'Info',
    text: ket,
    type: 'error',
    styling: 'bootstrap3',
    delay:3000
});
}
function price(input){
    return (input).formatMoney(0, ',', ',');
}
Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d === undefined ? "." : d,
        t = t === undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
function suggestkpm(){
  var inputkpmindex = $('.kpmindex');
 $.get(site_url+'Master/sugestkpm', function(data){
              inputkpmindex.typeahead({
              source: data,
              minLength:1,
            });
            },'json');
            inputkpmindex.change(function(){
                var current = $(this).typeahead("getActive");
                alert(current.id);
                $(this).next('.id_kpmindex').val(current.id);
            });
}