<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>JTS Starter | Log in</title>
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/indoprima_icon.png'); ?>">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>"
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>"
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css');?>"
	<!-- JTS CUSTOM COLOR-->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/fiky-jts-custom.css');?>"



	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition login-page"  style="background-image: url('<?php echo base_url('assets/img/logo-depan/bg_depan.jpg');?>">

<div class="login-box">
	<!-- /.login-logo -->
	<div class="login-box-body">
		<div class="login-logo">
			<!--<a href="<?php /*echo base_url('assets/index2.html');*/?>"><b> JTS </b>Starter</a>-->
			<img src="<?php echo base_url('assets/img/logo-depan/jts-logo.jpg');?>" width="100%" class="img-rounded">
		</div>
		<p class="login-box-msg">Sign in to start your session</p>

		<form class="form-horizontal" role="form" action="<?php echo site_url('web/proses');?>" method="post">

			<div class="form-group has-feedback">
				<input type="text" autocomplete="off"  class="form-control" placeholder="Username" name="username" >
				<span class="glyphicon glyphicon-envelope form-control-feedback" ></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" autocomplete="off" class="form-control" placeholder="Password"  name="password" >
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-3 control-label">
				</label>
				<div class="col-sm-9">
					<?php echo $captcha_img;?>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-3 control-label">
					Kode</label>
				<div class="col-sm-9">
					<input type="text" autocomplete="off" name="captcha" class="form-control" placeholder="masukan Kode" required	>
					<?php
					$wrong = $this->input->get('cap_error');
					if($wrong){
						echo '<span style="color:#ff0000;">Oops Wrong Captcha, Try Again !!!</span>';
					}
					?>
					<?php echo '<span style="color:#ff0000;">'. $this->session->flashdata('message').'</span>';?>
				</div>
			</div>
			<div class="row">

				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox"> Remember Me
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-jts btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
		<?php /*
        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>
        <!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>
*/ ?>
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
</script>
</body>
</html>
