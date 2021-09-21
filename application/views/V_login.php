<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<title>JTS-Absen Online &amp; Absensi Online</title>
	<!-- Icons -->
	<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
	<link rel="shortcut icon" href="<?php echo base_url('assets/files/logodepan/jts-icon.png');?>"
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url('assets/files/logodepan/jts-icon.png');?>"
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/files/logodepan/jts-icon.png');?>"
	<!-- END Icons -->

	<!-- Stylesheets -->
	<!-- Fonts and OneUI framework -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
	<link rel="stylesheet" id="css-main" href="<?php echo base_url('assets/css/oneui.min.css');?>"

	<!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
	<!-- <link rel="stylesheet" id="css-theme" href="<?php echo base_url('assets/css/themes/amethyst.min.css');?>" -->
	<!-- END Stylesheets -->
</head>
<body>
<!-- Page Container -->
<!--
	Available classes for #page-container:

GENERIC

	'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

SIDEBAR & SIDE OVERLAY

	'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
	'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
	'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
	'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
	'sidebar-dark'                              Dark themed sidebar

	'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
	'side-overlay-o'                            Visible Side Overlay by default

	'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

	'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

HEADER

	''                                          Static Header if no class is added
	'page-header-fixed'                         Fixed Header

HEADER STYLE

	''                                          Light themed Header
	'page-header-dark'                          Dark themed Header

MAIN CONTENT LAYOUT

	''                                          Full width Main Content if no class is added
	'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
	'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
-->
<div id="page-container">

	<!-- Main Container -->
	<main id="main-container">

		<!-- Page Content -->
		<div class="hero-static">
			<div class="content">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6 col-xl-4">
						<!-- Sign In Block -->
						<div class="block block-rounded block-themed mb-0">
							<div class="block-header bg-primary-dark">
								<h3 class="block-title">Sign In</h3>
								<div class="block-options">

								</div>
							</div>
							<div class="block-content">
								<div class="p-sm-3 px-lg-4 py-lg-5">
									<h1 class="h2 mb-1">JTS Presensi Online</h1>
									<p class="text-muted">
										Login untuk melakukan presensi
									</p>

									<!-- Sign In Form -->
									<!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
									<!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
									<form class="js-validation-signin" role="form" action="<?php echo site_url('login/proses');?>" method="POST">
										<div class="py-3">
											<div class="form-group">
												<input type="text" class="form-control form-control-alt form-control-lg" id="username" name="username" placeholder="Username">
											</div>
											<div class="form-group">
												<input type="password" class="form-control form-control-alt form-control-lg" id="password" name="password" placeholder="Password">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-9">

												<?php echo '<span style="color:#ff0000;">'. $this->session->flashdata('message').'</span>';?>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-6 col-xl-5">
												<button type="submit" class="btn btn-block btn-alt-primary">
													<i class="fa fa-fw fa-sign-in-alt mr-1"></i> Login
												</button>
											</div>
										</div>
									</form>
									<!-- END Sign In Form -->
								</div>
							</div>
						</div>
						<!-- END Sign In Block -->
					</div>
				</div>
			</div>
			<div class="content content-full font-size-sm text-muted text-center">
				<strong>Copyright IT Jatim Taman Steel </strong> &copy; <span data-toggle="year-copy"></span>
			</div>
		</div>
		<!-- END Page Content -->
	</main>
	<!-- END Main Container -->
</div>
<!-- END Page Container -->

<!--
	OneUI JS Core

	Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
	to handle those dependencies through webpack. Please check out assets/_js/main/bootstrap.js for more info.

	If you like, you could also include them separately directly from the assets/js/core folder in the following
	order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

	assets/js/core/jquery.min.js
	assets/js/core/bootstrap.bundle.min.js
	assets/js/core/simplebar.min.js
	assets/js/core/jquery-scrollLock.min.js
	assets/js/core/jquery.appear.min.js
	assets/js/core/js.cookie.min.js
-->
<script src="<?php echo base_url('assets/js/oneui.core.min.js');?>"></script>

<!--
	OneUI JS

	Custom functionality including Blocks/Layout API as well as other vital and optional helpers
	webpack is putting everything together at assets/_js/main/app.js
-->
<script src="<?php echo base_url('assets/js/oneui.app.min.js');?>"></script>

<!-- Page JS Plugins -->
<script src="<?php echo base_url('assets/js/plugins/jquery-validation/jquery.validate.min.js');?>"></script>

<!-- Page JS Code -->
<script src="<?php echo base_url('assets/js/pages/op_auth_signin.min.js');?>"></script>
</body>
</html>
