<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>index2.html"><b>Admin</b>GMSUSA</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Enter your credentials here</p>
      <?php echo $user; ?>
      <form  method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Username/Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="user_pass" id="user_pass" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="" id="" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>dist/js/adminlte.min.js"></script>

<!-- Toastr -->
<script src="<?php echo base_url(); ?>plugins/toastr/toastr.min.js"></script>


<?php if ( isset( $msg_error ) ): ?>
  <div id="dom-target" style="display: none;">  
    <?php
      echo "<pre>";
      print_r ($msg_error);
      echo "</pre>";
    ?>
  </div>  
<?php endif;?>
<script>
  var msg_success = "<?php echo $this->session->flashdata('msg_success') ?>";
  if ( msg_success != "" ) {
    toastr.success('Success!', msg_success );
  }

  var msg_error = "<?php echo $this->session->flashdata('msg_error') ?>";
  if ( msg_error != "" ) {
    toastr.error('Error!', msg_error );
  }

  var div = document.getElementById("dom-target");
  var msg_error = div.textContent;
  if ( msg_error != "" || msg_error == 'false') {
    toastr.error('Error!', msg_error );
  }
</script>

</body>
</html>
