<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets-admin/") ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url("assets-admin/") ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("assets-admin/") ?>css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url("assets-admin/") ?>css/style.css">
</head>

<body class="hold-transition login-page">
  <input type="hidden" id="hidden_site_url_input" value="<?php echo site_url() ?>">
  <input type="hidden" id="hidden_base_url_input" value="<?php echo base_url() ?>">
  <input type="hidden" id="hidden_admin_site_url_input" value="<?php echo site_url(ADMIN_SLUG) ?>">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

        <form action="<?php echo current_url() ?>" method="post" class="form-needs-validation reload-page-form" novalidate="novalidate">
          <div class="error-box"></div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Request new password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="<?php echo site_url(ADMIN_SLUG . "/login") ?>">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url("assets-admin/") ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url("assets-admin/") ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url("assets-admin/") ?>js/adminlte.min.js"></script>
  <script src="<?php echo base_url("assets-admin/") ?>js/style.js"></script>
</body>

</html>