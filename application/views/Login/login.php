<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SMK N 1 SAYEGAN! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-datepicker -->
    <link href="<?php echo base_url()?>vendors/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url()?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url()?>vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="<?php echo base_url()?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo base_url()?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo base_url()?>vendors/pnotify/dist/pnotify.animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
                  <div class="modal fade" id="mod_show" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <br>
                        <div class="modal-body mid_center">
                            <form id="formreset">
                              <div class="col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                  <input type="email" name="email" id="email" required="" class="form-control" placeholder="Masukan email...">

                                  <span class="input-group-btn" id="button">
                                          
                                      </span>
                                </div>
                              </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

            <form id="formlogin" data-parsley-validate="">
              <h1>Login Form</h1>
              <div>
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <input type="email" name="email" id="email" required="required" data-parsley-type="email" class="form-control" placeholder="Username">
              </div>
              <div>
                <input type="password" name="password" required="required" minlength="6" id="password" class="form-control" placeholder="Password">
              </div>
              
              <div>
              <a class="btn btn-default" id="masuk">Masuk</a>
              <a  href="#" id="modalshow" class="reset_pass">Lupa password?</a>
              <a  href="#" id="modalshowresend" class="reset_pass">Resend veritifikasi</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Belum punya akun?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> SMK N 1 Sayegan!</h1>
                  <p>©2017 All Rights Reserved. SMK N 1 Sayegan!. Privacy and Terms</p>
                </div>
              </div>
            </form> 
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form id="formregis" data-parsley-validate>
              <h1>Buat akun</h1>
              <div>
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
               <input type="text" id="username" required="required" pattern="[a-z A-Z]+" placeholder="Nama" name="username" class="form-control">
              </div>
              <div>
                <input type="email" id="email" required="required" data-parsley-type="email" name="email"  class="form-control" placeholder="Email">
              </div>
              <div>
                <input type="password" name="password" required="required" minlength="6" id="regpassword" class="form-control" placeholder="Password">
              </div>
              <div>
                <input type="password" name="konpassword" data-parsley-equalto="#regpassword" id="konpassword" required="required" class="form-control" placeholder="Konfirmasi Password">
              </div>
              <div>
                <input type="text" name="thnmasuk"  id="thnmasuk" required="required" class="form-control datepicker" placeholder="Tahun Masuk Di SMK">
              </div>
              <div>
                    <select class="form-control" name="program" id="pilihanprogram" required="required">
                        <option value="">-- please program/jurusan --</option>
                        
                    </select>
              </div>
              
              <div>
                <a class="btn btn-default" type="reset">Reset</a>
                <a class="btn btn-default" id="validate">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url()?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap-datepicker -->
    <script src="<?php echo base_url()?>vendors/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url()?>vendors/datepicker/locales/bootstrap-datepicker.id.js"></script>
     <!-- parsleyjs -->
       <script src="<?php echo base_url()?>vendors/parsleyjs/dist/parsley.min.js"></script>
       <script src="<?php echo base_url()?>vendors/parsleyjs/dist/i18n/id.js"></script>
       <!-- PNotify -->
    <script src="<?php echo base_url()?>vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo base_url()?>vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo base_url()?>vendors/pnotify/dist/pnotify.animate.min.js"></script>
    <script src="<?php echo base_url()?>vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <script src="<?php echo base_url()?>production/js/web/login.js"></script>
       <script>

   var site_url = "<?php echo site_url(); ?>";
   var csfrData = {};
  csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
  $.ajaxSetup({
  data: csfrData
  });
</script>
  </body>
</html>
