<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css') ?>">

	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
		.row {
			margin-bottom: 5px
		}
	</style>
</head>
<body>

	

	<?php if ($this->session->flashdata('success')): ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h2><?php echo $this->session->flashdata('success'); ?></h2>
		</div>
	<?php endif ?>

	<?php if ($this->session->flashdata('error')): ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo '<h2>Upload Gagal !.</h2>'.$this->session->flashdata('error'); ?>
		</div>
	<?php endif ?>

	<div id="container">
		<div style="background-color: #AEE4E7">
		<h1>Upload Bukti Kegiatan Pembelajaran !</h1>
			
		</div>

		<?php echo form_open_multipart(''); ?>
		<div id="body">
			<div class="row">
				<div class="col-md-2">
					<label for="kelas">Kelas</label>
				</div>
				<div class="col-md-5">
					<select name="kelas" id="kelas" class="form-control" required>
						<option value="">-- pilih kelas --</option>
						<?php foreach ($kelas as $kelas): ?>
							<option value="<?= $kelas->kodeKelas ?>"><?= $kelas->namaKelas ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="nama">Nama Siswa</label>
				</div>
				<div class="col-md-5">
					<select name="nama" id="nama" class="form-control" required disabled="">
						<option value="">-- pilih siswa --</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
					<label for="mapel">Pilih Mapel</label>
				</div>
				<div class="col-md-5">
					<select name="mapel" id="mapel" class="form-control" required disabled="">
						<option value="">-- pilih mapel --</option>
						<?php foreach ($mapel as $mapel): ?>
							<option value="<?= $mapel->kodeMapel ?>"><?= $mapel->namaMapel ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
					<label for="guru">Pilih Guru</label>
				</div>
				<div class="col-md-5">
					<select name="guru" id="guru" class="form-control" required disabled="">
						<option value="">-- pilih guru --</option>
						<?php foreach ($guru as $guru): ?>
							<option value="<?= $guru->email ?>"><?= $guru->nama ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
					<label for="file">Pilih bukti laporan</label>
				</div>
				<div class="col-md-5">
					<input type="file" name="file" id="file" accept=".jpg, .png" required="" class="form-control" disabled="">
				</div>
			</div>

			<div class="row" style="margin-top: 10px">
				<div class="col-md-2">
				</div>
				<div class="col-md-5">
					<input type="submit" class="btn btn-primary" value="Upload">
				</div>
			</div>


		</div>
		<?php echo form_close(); ?>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. SMAN 1 Jorong</p>
	</div>
	<script type="text/javascript" src="<?php echo base_url('assets/jquery.min.js') ?>"></script>
	<script>
		$(document).ready(function(){
			$('#kelas').on('change', function(){
				kodeKelas = $(this).val();
				$.ajax({
					url: '<?php echo base_url('index.php/welcome/get_siswa'); ?>',
					type: 'post',
					data: {kodeKelas:kodeKelas},
					dataType: 'json',
					success: function(data) {
						$("#nama").prop('disabled', false);
						$('#nama').html(data);
					},
					error: function(){
						alert('error');
					}
				});

			});
		});
	</script>

	<script>
		$(document).ready(function(){
			$('#nama').on('change', function(){
				$("#mapel").prop('disabled', false);
			})
		})
	</script>

	<script>
		$(document).ready(function(){
			$('#mapel').on('change', function(){
				$("#guru").prop('disabled', false);
			})
		})
	</script>

	<script>
		$(document).ready(function(){
			$('#guru').on('change', function(){
				$("#file").prop('disabled', false);
			})
		})
	</script>

</body>
</html>