<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Hq pack</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jensey Bootstrap -->
    <link href="<?php echo base_url()?>vendors/jasny-bootstrap/css/jasny-bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- NProgress -->
    <link href="<?php echo base_url()?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url()?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url()?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-datepicker -->
    <link href="<?php echo base_url()?>vendors/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="<?php echo base_url()?>vendors/loadingjs/jquery.loading.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>vendors/icomoon/style.css">
    <!-- PNotify -->
    <link href="<?php echo base_url()?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo base_url()?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo base_url()?>vendors/pnotify/dist/pnotify.animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url()?>vendors/Chart.js/dist/Chart.min.css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url()?>vendors/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>vendors/datatables/extensions/Buttons/css/buttons.dataTables.min.css">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>build/css/custom.min.css" rel="stylesheet">
     <style>
    .containerimage {
      max-width: 640px;
      margin: 20px auto;
    }
    img {
      width: 100%;
    }
    .icon-Logo-HQpacks:before {
  content: "\e900";
  color: "black";
}
  </style>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url()?>Beranda" class="site_title"><span class="icon-Logo-HQpacks"></span> <span>HQpacks</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="/favicon-32x32.png" alt="..." class="img-circle profile_img ppindex">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userdata('NAMA')?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                <?php if($this->session->userdata('LEVEL')==1) {?>
                 <li><a href="<?php echo base_url()?>Beranda"><i class="fa fa-home"></i> Home</a></li>
                  
                  <?php } if($this->session->userdata('LEVEL')==2) {?>
                   <li><a href="<?php echo base_url()?>Beranda"><i class="fa fa-home"></i> Home</a></li>
                  <li><a><i class="fa fa-database" aria-hidden="true"></i> Database <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url()?>Master/konsumen">Konsumen</a></li>
                      <li><a href="<?php echo base_url()?>Master/distributor">Distributor</a></li>
                      <li><a href="<?php echo base_url()?>Master/hargadistributor">Harga distrbutor</a></li>
                       <li><a href="<?php echo base_url()?>Master/followup">Follow up</a></li>
                       <li><a href="<?php echo base_url()?>Master/pricelist">Price List</a></li>
                       <li><a href="<?php echo base_url()?>Master/inventaris">Inventaris</a></li>
                       <li><a href="<?php echo base_url()?>Master/stock">Stock</a></li>
                      
                    </ul>
                  </li>
                   <li><a><i class="fa fa-file-text "></i> Lap. Keuangan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url()?>Master/beban">Beban</a></li>
                      <li><a href="<?php echo base_url()?>Master/detaillaporan">Detail Laba Rugi</a></li>
                      <li><a href="<?php echo base_url()?>Master/laporan">Laporan Laba Rugi</a></li>
                      
                       <li><a href="<?php echo base_url()?>Master/invoice">Invoice</a></li>
                      <li><a href="<?php echo base_url()?>Master/chart">Chart</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-wrench"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url()?>Master/masterdata">Master Data</a></li>
                      
                    </ul>
                  </li>
                  <?php }?>
                </ul>
              </div>
            </div>
          
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
               
              </div>

              <ul class="nav navbar-nav navbar-left">
                <li class="">
                   <a href="<?php echo base_url()?>Master/konsumen#view">Konsumen</a>
                 </li>
                 <li class="">
                   <a href="<?php echo base_url()?>Master/distributor#view">Distributor</a>
                 </li>
                 <li class="">
                    <a href="<?php echo base_url()?>Master/hargadistributor#view">Harga Dist</a>
                 </li>
                 <li class="">
                     <a href="<?php echo base_url()?>Master/followup#view">Follow Up</a>
                 </li>
                  <li class="">
                     <a href="<?php echo base_url()?>Master/invoice">POS</a>
                 </li>
                
              </ul>
              <ul class="nav navbar-nav pull-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url()?>production/images/user.png" alt="" class="ppindex"><?php echo $this->session->userdata('NAMA')?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li><a href="<?php echo base_url()?>Master/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <di id="spinjs">
        <?php $this->load->view($view); ?>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Hq Pack Management by Faza Sulaiman</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url()?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- jensey Bootstrap -->
    <script src="<?php echo base_url()?>vendors/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    
    <script src="<?php echo base_url()?>vendors/bootstrap/dist/js/bootstrap3-typeahead.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url()?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url()?>vendors/nprogress/nprogress.js"></script>
     <!-- shortcut -->
    <script src="<?php echo base_url()?>vendors/shortcut/shortcut.js"></script>
   
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url()?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url()?>vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url()?>vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url()?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
     <!-- Chart.js -->
   <script src="<?php echo base_url()?>vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- jspdf -->
   <script src="<?php echo base_url()?>vendors/jspdf/dist/jspdf.min.js"></script>
   <script src="<?php echo base_url()?>vendors/jspdf/libs/dom-to-image/dom-to-image.min.js"></script>
    
     <!-- bootstrap-datepicker -->
    <script src="<?php echo base_url()?>vendors/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datepicker/locales/bootstrap-datepicker.id.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url()?>build/js/custom.min.js"></script>
   
    <!-- DataTables -->
    <script src="<?php echo base_url()?>vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/jszip.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/pdfmake.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/vfs_fonts.js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/extensions/sum/sum().js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/extensions/Buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
    <!-- print this -->
    <script src="<?php echo base_url()?>vendors/printThis/printThis.js"></script>
    <script src="<?php echo base_url()?>vendors/printThis/jquery.printElement.min.js"></script>
    <!-- loadingjs -->
    <script src="<?php echo base_url()?>vendors/loadingjs/jquery.loading.min.js"></script>
     <!-- parsleyjs -->
     
    <script src="<?php echo base_url()?>vendors/parsleyjs/dist/parsley.min.js"></script>
   <script src="<?php echo base_url()?>vendors/parsleyjs/dist/i18n/id.js"></script>
    <!-- PNotify -->
    <script src="<?php echo base_url()?>vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo base_url()?>vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo base_url()?>vendors/pnotify/dist/pnotify.animate.min.js"></script>
    <script src="<?php echo base_url()?>vendors/pnotify/dist/pnotify.nonblock.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> 
    <script src="<?php echo base_url()?>production/js/web/moneyformat.js"></script> 
    <script src="<?php echo $js2; ?>"></script>
    <script src="<?php echo $js; ?>"></script>
    <script>
       $(document).ready(function() {
   $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true  
    });
    $(".select2-selection").on("focus", function () {
        $(this).parent().parent().prev().select2("open");
    });

     $('#tambah').keypress(function (e) {
      if (e.which == 13 && getLastPartOfUrl(window.location.href) != 'hargadistributor' && getLastPartOfUrl(window.location.href) != 'konsumen' && getLastPartOfUrl(window.location.href) != 'pricelist'&& getLastPartOfUrl(window.location.href) != 'inventaris') {
        $('#validate').click();
        return false;   
      }
    });
     $('#formubah').keypress(function (e) {
      if (e.which == 13 && getLastPartOfUrl(window.location.href) != 'hargadistributor' && getLastPartOfUrl(window.location.href) != 'konsumen' && getLastPartOfUrl(window.location.href) != 'pricelist' && getLastPartOfUrl(window.location.href) != 'inventaris') {
        $('#validate2').click();
        return false;   
      }
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
var getLastPartOfUrl =function($url) {
    var url = $url;
    var urlsplit = url.split("/");
    var lastpart = urlsplit[urlsplit.length-1];
    if(lastpart==='')
    {
        lastpart = urlsplit[urlsplit.length-2];
    }
    return lastpart;
}
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
function error(){
  new PNotify({
     title: 'Gagal',
    text: text,
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
    return (input).formatMoney(0, ',', '.');
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
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? rupiah : "";
}

    </script>
    

  </body>
</html>
