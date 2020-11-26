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

    <title>Hq Pack! |Login Form </title>

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
                 
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

            <form id="formlogin" data-parsley-validate="">
              <h1>Login Form</h1>
              <div>
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <input type="text" name="kode" id="kode" required="required" class="form-control" placeholder="Username">
              </div>
              <div>
                <input type="password" name="password" required="required"  id="password" class="form-control" placeholder="Password">
              </div>
              
              <div>
              <a class="btn btn-default" id="masuk">Masuk</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="/favicon-32x32.png" alt="Icon hqpack"><span>HQpacks</span></h1>
                  <p>©2020 All Rights Reserved. HQpacks. Privacy and Terms</p>
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
