<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<title>JTS - Presensi Online &amp; JTS Presensi</title>

	<style>
		/* CSS comes here */
		#video {
			border: 1px solid black;
			width: 320px;
			height: 240px;
		}

		#photo {
			border: 1px solid black;
			width: 320px;
			height: 320px;
		}

		#canvas {
			display: none;
		}

		.camera {
			width: 340px;
			display: inline-block;
		}

		.output {
			width: 340px;
			display: inline-block;
		}
		/*
				#startbutton {
					display: block;
					position: relative;
					margin-left: auto;
					margin-right: auto;
					bottom: 36px;
					padding: 5px;
					background-color: #6a67ce;
					border: 1px solid rgba(255, 255, 255, 0.7);
					font-size: 14px;
					color: rgba(255, 255, 255, 1.0);
					cursor: pointer;
				}
		*/
		.contentarea {
			font-size: 16px;
			font-family: Arial;
			text-align: center;
		}
	</style>
	<!-- Icons -->
	<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
	<link rel="shortcut icon" href="<?php echo base_url('assets/files/logodepan/jts-icon.png');?>"
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url('assets/files/logodepan/jts-icon.png');?>"
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/files/logodepan/jts-icon.png');?>"
	<!-- END Icons -->

	<!-- Stylesheets -->
	<!-- Fonts and OneUI framework -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
	<!-- SWEET ALERT -->
	<link rel="stylesheet" href="<?php echo base_url('assets/js/sweetalert2/sweetalert2.css');?>">

	<link rel="stylesheet" id="css-main" href="<?php echo base_url('assets/css/oneui.min.css');?>"


</head>
<body>

<!--?php echo $message;?-->
<!--BUTTON-->

<div class="d-flex justify-content-center">
	<div class="center-block" style="width:320px;background-color:#ccc;">
		<button class="btn btn-success btn-lg" style="margin:0px; color:#ffffff;" type="button" id="checkin"> Masuk <i class="fa fa-check-circle"></i></button>
		<button class="btn btn-danger btn-lg float-right" style="margin:0px; color:#ffffff;" type="button" id="checkout"> Pulang <i class="fa fa-clock"></i></button>
	</div>
</div>
<div class="d-flex justify-content-center">
	<div class="center-block" style="width:320px;background-color:#ccc;">
		<button class="btn btn-info btn-lg" style="margin:0px; color:#ffffff;" type="button" id="restin">Mulai Istirahat<i class="fa fa-check-circle"></i></button>
		<button class="btn btn-warning btn-lg float-right" style="margin:0px; color:#ffffff;" type="button" id="restout">Akhir Istirahat<i class="fa fa-clock"></i></button>
	</div>
</div>
<div class="d-flex justify-content-center">
	<div class="center-block" style="width:320px;background-color:#ccc;">
		<div class="d-flex justify-content-center">
			<div class="center-block" style="font-size: 12px">
			<?php echo $dtl['nmlengkap'].',  '.$dtl['nmsubdept']; ?>
			</div>
		</div>
	</div>
</div>

<div class="col-sm-12">
	<div class="contentarea">

		<div class="camera">
			<video id="video">Video stream not available.</video>
		</div>

		<div><button id="clearbutton">Clear photo</button></div>
		<canvas id="canvas"></canvas>
		<div class="output">
			<form  enctype="multipart/form-data" action="<?php echo site_url('#')?>" method="post" id="formOnlineAbsen">
				<img id="photo" name="photo"alt="The screen capture will appear in this box.">
				<input type="hidden" id="ctype" name="ctype">
				<input type="hidden" id="lang" name="lang">
				<input type="hidden" id="long" name="long">
				<input type="hidden" id="photoimage" name="photoimage" >
				<input type="hidden" id="browser" name="browser" value="<?php echo $yourbrowser; ?>">
			</form>

		</div>
	</div>
</div>
<div class="d-flex justify-content-center">

		<a href="<?php echo base_url('absen/logout');?>" class="btn btn-dark btn-lg d-flex justify-content-center" style="margin:0px; color:#ffffff;" type="button" id="logout"> Logout <i class="fa fa-close"></i></a>

</div>


<script src="<?php echo base_url('assets/js/oneui.core.min.js');?>"></script>

<!--
	OneUI JS

	Custom functionality including Blocks/Layout API as well as other vital and optional helpers
	webpack is putting everything together at assets/_js/main/app.js
-->
<script src="<?php echo base_url('assets/js/oneui.app.min.js');?>"></script>

<!-- Page JS Plugins -->
<script src="<?php echo base_url('assets/js/plugins/jquery-validation/jquery.validate.min.js');?>"></script>

<!-- Sweet Alert  -->
<script src="<?php echo base_url('assets/js/sweetalert2/sweetalert2.all.min.js');?>"> </script>
<script src="<?php echo base_url('assets/js/sweetalert2/sweetalert2.min.js');?>"> </script>

<script>

	var HOST_URL = '<?php echo base_url();?>';
	var base = function(url){
		return '<?php echo base_url();?>' + url;
	}
	var site = function(url){
		return base(url) + '.html';
	}
	var debugmode = function() {
		return <?php echo ($this->config->item('debugmode')) ? 'true' : 'false';?>;
	}


	var langGlobal = null;
	var longGlobal = null;
	function do_something(coords) {
		//console.log(coords)
		// Do something with the coords here
		/*x.innerHTML = "Latitude: " + coords.latitude +
			"<br>Longitude: " + coords.longitude +
			"<br>ip: " + coords.ip +
			"<br>city: " + coords.city +
			"<br>region: " + coords.region +
			"<br>country: " + coords.country +
			"<br>country: " + coords.country +
			"<br>lx: " + coords.lx +
			"<br>timezone: " + coords.timezone ;*/
		$('[name="lang"]').val(coords.latitude);
		$('[name="long"]').val(coords.longitude)

		langGlobal = coords.latitude;
		longGlobal = coords.longitude;


	}


	var x = document.getElementById("demo");
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
						do_something(position.coords);
					},
					function(failure) {
						$.getJSON('https://ipinfo.io/geo', function(response) {
							var loc = response.loc.split(',');
							var coords = {
								lx: 'TEST',
								latitude: loc[0],
								longitude: loc[1],
								ip: response.ip,
								city: response.city,
								region: response.region,
								country: response.country,
								timezone: response.timezone,
							};
							do_something(coords);
						});
					});

		} else {
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}


	/* JS comes here */

	(function() {

		var width = 320; // We will scale the photo width to this
		var height = 0; // This will be computed based on the input stream

		var streaming = false;

		var video = null;
		var canvas = null;
		var photo = null;
		var photoimage = null;
		var checkin = null;
		var checkout = null;
		var restin = null;
		var restout = null;

		var alamat = null;
		var dusun = null;
		var desa= null;
		var kota = null;
		var kabupaten = null;
		var provinsi = null;
		var negara = null;
		var kodepos = null;

		function startup() {
			video = document.getElementById('video');
			canvas = document.getElementById('canvas');
			photo = document.getElementById('photo');
			photoimage = document.getElementById('photoimage');
			checkin = document.getElementById('checkin');
			checkout = document.getElementById('checkout');
			restin = document.getElementById('restin');
			restout = document.getElementById('restout');

			clearbutton = document.getElementById('clearbutton');
			getLocation();
			navigator.mediaDevices.getUserMedia({
				video: true,
				audio: false
			})
					.then(function(stream) {
						video.srcObject = stream;
						video.play();
					})
					.catch(function(err) {
						console.log("An error occurred: " + err);
					});

			video.addEventListener('canplay', function(ev) {
				if (!streaming) {
					height = video.videoHeight / (video.videoWidth / width);

					if (isNaN(height)) {
						height = width / (4 / 3);
					}

					video.setAttribute('width', width);
					video.setAttribute('height', height);
					canvas.setAttribute('width', width);
					canvas.setAttribute('height', height);
					streaming = true;
				}
			}, false);

			checkin.addEventListener('click', function(ev) {
				takepicture();
				ev.preventDefault();

				if (langGlobal && longGlobal){
					$.ajax({
						url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + langGlobal + ',' +longGlobal +'&sensor=true&key=AIzaSyBQrYhF3qliAcn88A0dqfv1OvfaQD0XO9E',
						type: "GET",
						datatype : "JSON",
						dataFilter: function (data) {
							var json = jQuery.parseJSON(data);
								console.log(json.results[0]);
								console.log('ALAMAT : ' + json.results[0].formatted_address);
								console.log('DUSUN : ' + json.results[0].address_components[0].long_name);
								console.log('DESA: ' + json.results[0].address_components[1].long_name);
								console.log('KOTA : ' + json.results[0].address_components[2].long_name);
								console.log('KABUPATEN : ' + json.results[0].address_components[3].long_name);
								console.log('PROVINSI : ' + json.results[0].address_components[4].long_name);
								console.log('NEGARA : ' + json.results[0].address_components[5].long_name);
								console.log('KODE_POS : ' + json.results[0].address_components[6].long_name);

							alamat = json.results[0].formatted_address;
							dusun = json.results[0].address_components[0].long_name;
							desa = json.results[0].address_components[1].long_name;
							kota = json.results[0].address_components[2].long_name;
							kabupaten = json.results[0].address_components[3].long_name;
							provinsi = json.results[0].address_components[4].long_name;
							negara = json.results[0].address_components[5].long_name;
							kodepos = json.results[0].address_components[6].long_name;

							// ajax adding data to database
							var form = $('#formOnlineAbsen');
							$.ajax({
								url: HOST_URL + 'absen/saveOnlineAbsen',
								type: "POST",
								data: form.serialize() + "&ctype=IN" +
										"&alamat=" + alamat +"" +
										"&dusun=" + dusun +"" +
										"&desa=" + desa +"" +
										"&kota=" + kota +"" +
										"&kabupaten=" + kabupaten +"" +
										"&provinsi=" + provinsi +"" +
										"&negara=" + negara +"" +
										"&kodepos=" + kodepos +"" ,
								datatype : "JSON",
								dataFilter: function (data) {
									var json = jQuery.parseJSON(data);
									if (json.status) //if success close modal and reload ajax table
									{
										Swal.fire({
											title: json.title,
											html:  json.messages,
											backdrop: true,
											allowOutsideClick: false,
											showConfirmButton: true,
											showDenyButton: false,
											showCancelButton: false,
											confirmButtonText: `Ok`,
											icon: 'success',
											//denyButtonText: `Don't save`,
										});

									} else {
										//alert(json.messages);
										Swal.fire({
											title: 'Gagal Fail...!!!',
											text: json.messages,
											backdrop: true,
											allowOutsideClick: false,
											showConfirmButton: true,
											showDenyButton: false,
											showCancelButton: false,
											icon: 'error',
											//denyButtonText: `Don't save`,
										});
									}
									$('#btnSave').text('save'); //change button text
									$('#btnSave').attr('disabled', false); //set button enable


								},
								error: function (jqXHR, textStatus, errorThrown) {
									// alert('Gagal Menyimpan / Ubah data / data sudah ada');
									swal({
										title: "Galat!!",
										text: json.messages,
										type: "error"
									});
									$('#btnSave').text('save'); //change button text
									$('#btnSave').attr('disabled', false); //set button enable

								}
							});
							},
						error: function (jqXHR, textStatus, errorThrown) {
							//console.log('error');

							}
						});






				} else {
					Swal.fire({
						title: 'Failed',
						text:  'Gagal Mengambil Coordinat, Silahakan Ulangi !!!',
						backdrop: true,
						allowOutsideClick: false,
						showConfirmButton: false,
						showDenyButton: true,
						showCancelButton: false,
						icon: 'error',
						//denyButtonText: `Don't save`,
					});
				}

			}, false);
			checkout.addEventListener('click', function(ev) {
				takepicture();
				ev.preventDefault();

				if (langGlobal && longGlobal){
					$.ajax({
						url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + langGlobal + ',' +longGlobal +'&sensor=true&key=AIzaSyBQrYhF3qliAcn88A0dqfv1OvfaQD0XO9E',
						type: "GET",
						datatype : "JSON",
						dataFilter: function (data) {
							var json = jQuery.parseJSON(data);
							console.log(json.results[0]);
							console.log('ALAMAT : ' + json.results[0].formatted_address);
							console.log('DUSUN : ' + json.results[0].address_components[0].long_name);
							console.log('DESA: ' + json.results[0].address_components[1].long_name);
							console.log('KOTA : ' + json.results[0].address_components[2].long_name);
							console.log('KABUPATEN : ' + json.results[0].address_components[3].long_name);
							console.log('PROVINSI : ' + json.results[0].address_components[4].long_name);
							console.log('NEGARA : ' + json.results[0].address_components[5].long_name);
							console.log('KODE_POS : ' + json.results[0].address_components[6].long_name);

							alamat = json.results[0].formatted_address;
							dusun = json.results[0].address_components[0].long_name;
							desa = json.results[0].address_components[1].long_name;
							kota = json.results[0].address_components[2].long_name;
							kabupaten = json.results[0].address_components[3].long_name;
							provinsi = json.results[0].address_components[4].long_name;
							negara = json.results[0].address_components[5].long_name;
							kodepos = json.results[0].address_components[6].long_name;

							// ajax adding data to database
							var form = $('#formOnlineAbsen');
							$.ajax({
								url: HOST_URL + 'absen/saveOnlineAbsen',
								type: "POST",
								data: form.serialize() + "&ctype=OUT" +
										"&alamat=" + alamat +"" +
										"&dusun=" + dusun +"" +
										"&desa=" + desa +"" +
										"&kota=" + kota +"" +
										"&kabupaten=" + kabupaten +"" +
										"&provinsi=" + provinsi +"" +
										"&negara=" + negara +"" +
										"&kodepos=" + kodepos +"" ,
								datatype : "JSON",
								dataFilter: function (data) {
									var json = jQuery.parseJSON(data);
									if (json.status) //if success close modal and reload ajax table
									{
										Swal.fire({
											title: json.title,
											html:  json.messages,
											backdrop: true,
											allowOutsideClick: false,
											showConfirmButton: true,
											showDenyButton: false,
											showCancelButton: false,
											confirmButtonText: `Ok`,
											icon: 'success',
											//denyButtonText: `Don't save`,
										});

									} else {
										//alert(json.messages);
										Swal.fire({
											title: 'Gagal Fail...!!!',
											text: json.messages,
											backdrop: true,
											allowOutsideClick: false,
											showConfirmButton: true,
											showDenyButton: false,
											showCancelButton: false,
											icon: 'error',
											//denyButtonText: `Don't save`,
										});
									}
									$('#btnSave').text('save'); //change button text
									$('#btnSave').attr('disabled', false); //set button enable


								},
								error: function (jqXHR, textStatus, errorThrown) {
									// alert('Gagal Menyimpan / Ubah data / data sudah ada');
									swal({
										title: "Galat!!",
										text: json.messages,
										type: "error"
									});
									$('#btnSave').text('save'); //change button text
									$('#btnSave').attr('disabled', false); //set button enable

								}
							});
						},
						error: function (jqXHR, textStatus, errorThrown) {
							//console.log('error');

						}
					});






				} else {
					Swal.fire({
						title: 'Failed',
						text:  'Gagal Mengambil Coordinat, Silahakan Ulangi !!!',
						backdrop: true,
						allowOutsideClick: false,
						showConfirmButton: false,
						showDenyButton: true,
						showCancelButton: false,
						icon: 'error',
						//denyButtonText: `Don't save`,
					});
				}
			}, false);
			restout.addEventListener('click', function(ev) {
				takepicture();
				ev.preventDefault();

				if (langGlobal && longGlobal){
					$.ajax({
						url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + langGlobal + ',' +longGlobal +'&sensor=true&key=AIzaSyBQrYhF3qliAcn88A0dqfv1OvfaQD0XO9E',
						type: "GET",
						datatype : "JSON",
						dataFilter: function (data) {
							var json = jQuery.parseJSON(data);
							console.log(json.results[0]);
							console.log('ALAMAT : ' + json.results[0].formatted_address);
							console.log('DUSUN : ' + json.results[0].address_components[0].long_name);
							console.log('DESA: ' + json.results[0].address_components[1].long_name);
							console.log('KOTA : ' + json.results[0].address_components[2].long_name);
							console.log('KABUPATEN : ' + json.results[0].address_components[3].long_name);
							console.log('PROVINSI : ' + json.results[0].address_components[4].long_name);
							console.log('NEGARA : ' + json.results[0].address_components[5].long_name);
							console.log('KODE_POS : ' + json.results[0].address_components[6].long_name);

							alamat = json.results[0].formatted_address;
							dusun = json.results[0].address_components[0].long_name;
							desa = json.results[0].address_components[1].long_name;
							kota = json.results[0].address_components[2].long_name;
							kabupaten = json.results[0].address_components[3].long_name;
							provinsi = json.results[0].address_components[4].long_name;
							negara = json.results[0].address_components[5].long_name;
							kodepos = json.results[0].address_components[6].long_name;

							// ajax adding data to database
							var form = $('#formOnlineAbsen');
							$.ajax({
								url: HOST_URL + 'absen/saveOnlineAbsen',
								type: "POST",
								data: form.serialize() + "&ctype=R-OUT" +
										"&alamat=" + alamat +"" +
										"&dusun=" + dusun +"" +
										"&desa=" + desa +"" +
										"&kota=" + kota +"" +
										"&kabupaten=" + kabupaten +"" +
										"&provinsi=" + provinsi +"" +
										"&negara=" + negara +"" +
										"&kodepos=" + kodepos +"" ,
								datatype : "JSON",
								dataFilter: function (data) {
									var json = jQuery.parseJSON(data);
									if (json.status) //if success close modal and reload ajax table
									{
										Swal.fire({
											title: json.title,
											html:  json.messages,
											backdrop: true,
											allowOutsideClick: false,
											showConfirmButton: true,
											showDenyButton: false,
											showCancelButton: false,
											confirmButtonText: `Ok`,
											icon: 'success',
											//denyButtonText: `Don't save`,
										});

									} else {
										//alert(json.messages);
										Swal.fire({
											title: 'Gagal Fail...!!!',
											text: json.messages,
											backdrop: true,
											allowOutsideClick: false,
											showConfirmButton: true,
											showDenyButton: false,
											showCancelButton: false,
											icon: 'error',
											//denyButtonText: `Don't save`,
										});
									}
									$('#btnSave').text('save'); //change button text
									$('#btnSave').attr('disabled', false); //set button enable


								},
								error: function (jqXHR, textStatus, errorThrown) {
									// alert('Gagal Menyimpan / Ubah data / data sudah ada');
									swal({
										title: "Galat!!",
										text: json.messages,
										type: "error"
									});
									$('#btnSave').text('save'); //change button text
									$('#btnSave').attr('disabled', false); //set button enable

								}
							});
						},
						error: function (jqXHR, textStatus, errorThrown) {
							//console.log('error');

						}
					});






				} else {
					Swal.fire({
						title: 'Failed',
						text:  'Gagal Mengambil Coordinat, Silahakan Ulangi !!!',
						backdrop: true,
						allowOutsideClick: false,
						showConfirmButton: false,
						showDenyButton: true,
						showCancelButton: false,
						icon: 'error',
						//denyButtonText: `Don't save`,
					});
				}
			}, false);
			restin.addEventListener('click', function(ev) {
				takepicture();
				ev.preventDefault();

				if (langGlobal && longGlobal){
					$.ajax({
						url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + langGlobal + ',' +longGlobal +'&sensor=true&key=AIzaSyBQrYhF3qliAcn88A0dqfv1OvfaQD0XO9E',
						type: "GET",
						datatype : "JSON",
						dataFilter: function (data) {
							var json = jQuery.parseJSON(data);
							console.log(json.results[0]);
							console.log('ALAMAT : ' + json.results[0].formatted_address);
							console.log('DUSUN : ' + json.results[0].address_components[0].long_name);
							console.log('DESA: ' + json.results[0].address_components[1].long_name);
							console.log('KOTA : ' + json.results[0].address_components[2].long_name);
							console.log('KABUPATEN : ' + json.results[0].address_components[3].long_name);
							console.log('PROVINSI : ' + json.results[0].address_components[4].long_name);
							console.log('NEGARA : ' + json.results[0].address_components[5].long_name);
							console.log('KODE_POS : ' + json.results[0].address_components[6].long_name);

							alamat = json.results[0].formatted_address;
							dusun = json.results[0].address_components[0].long_name;
							desa = json.results[0].address_components[1].long_name;
							kota = json.results[0].address_components[2].long_name;
							kabupaten = json.results[0].address_components[3].long_name;
							provinsi = json.results[0].address_components[4].long_name;
							negara = json.results[0].address_components[5].long_name;
							kodepos = json.results[0].address_components[6].long_name;

							// ajax adding data to database
							var form = $('#formOnlineAbsen');
							$.ajax({
								url: HOST_URL + 'absen/saveOnlineAbsen',
								type: "POST",
								data: form.serialize() + "&ctype=R-IN" +
										"&alamat=" + alamat +"" +
										"&dusun=" + dusun +"" +
										"&desa=" + desa +"" +
										"&kota=" + kota +"" +
										"&kabupaten=" + kabupaten +"" +
										"&provinsi=" + provinsi +"" +
										"&negara=" + negara +"" +
										"&kodepos=" + kodepos +"" ,
								datatype : "JSON",
								dataFilter: function (data) {
									var json = jQuery.parseJSON(data);
									if (json.status) //if success close modal and reload ajax table
									{
										Swal.fire({
											title: json.title,
											html:  json.messages,
											backdrop: true,
											allowOutsideClick: false,
											showConfirmButton: true,
											showDenyButton: false,
											showCancelButton: false,
											confirmButtonText: `Ok`,
											icon: 'success',
											//denyButtonText: `Don't save`,
										});

									} else {
										//alert(json.messages);
										Swal.fire({
											title: 'Gagal Fail...!!!',
											text: json.messages,
											backdrop: true,
											allowOutsideClick: false,
											showConfirmButton: true,
											showDenyButton: false,
											showCancelButton: false,
											icon: 'error',
											//denyButtonText: `Don't save`,
										});
									}
									$('#btnSave').text('save'); //change button text
									$('#btnSave').attr('disabled', false); //set button enable


								},
								error: function (jqXHR, textStatus, errorThrown) {
									// alert('Gagal Menyimpan / Ubah data / data sudah ada');
									swal({
										title: "Galat!!",
										text: json.messages,
										type: "error"
									});
									$('#btnSave').text('save'); //change button text
									$('#btnSave').attr('disabled', false); //set button enable

								}
							});
						},
						error: function (jqXHR, textStatus, errorThrown) {
							//console.log('error');

						}
					});






				} else {
					Swal.fire({
						title: 'Failed',
						text:  'Gagal Mengambil Coordinat, Silahakan Ulangi !!!',
						backdrop: true,
						allowOutsideClick: false,
						showConfirmButton: false,
						showDenyButton: true,
						showCancelButton: false,
						icon: 'error',
						//denyButtonText: `Don't save`,
					});
				}

			}, false);


			clearbutton.addEventListener('click', function(ev) {
				clearphoto();
				ev.preventDefault();
			}, false);

			clearphoto();
		}


		function clearphoto() {
			var context = canvas.getContext('2d');
			context.fillStyle = "#AAA";
			context.fillRect(0, 0, canvas.width, canvas.height);

			var data = canvas.toDataURL('image/png');
			photo.setAttribute('src', data);
		}

		function takepicture() {
			var context = canvas.getContext('2d');
			if (width && height) {
				canvas.width = width;
				canvas.height = height;
				context.drawImage(video, 0, 0, width, height);

				var data = canvas.toDataURL('image/png');
				photo.setAttribute('src', data);
				photoimage.setAttribute('value',data);

			} else {
				clearphoto();
			}
		}

		window.addEventListener('load', startup, false);
	})();




</script>
</body>
</html>
