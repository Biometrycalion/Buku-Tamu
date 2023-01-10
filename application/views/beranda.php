<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style>
        .bg-judul {
            background-color:#7FFF00;
            color:black;
        }
        #camera {
          clip-path: circle(50% at 50% 50%); /* Membuat sudut-sudutnya menjadi bulat */
        }
    </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav fixed">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
            <?php foreach ($aplikasi->result_array() as $row) { ?>
                <a href="<?= base_url() ?>" class="navbar-brand"><b><?= $row['nama'] ?></b></a>
            <?php } ?>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?= base_url('index.php/home') ?>"><i class="fa fa-key"></i> Login</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          FORMULIR BUKU TAMU
          <small>isilah formulir dengan data yang sesuai/benar</small>
        </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol> -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan') ?>"></div>
        <div class="box box-default">
          <div class="box-header with-border">  
            </center><h4 class="box-title">FORMULIR BUKU TAMU</h4></center>
          </div>
          <center>
            <video id="camera" width="300" height="300" autoplay></video>
            <canvas style="display: none;" id="snapshot" width="300" height="300"></canvas>
          </center>
            <form onsubmit="takeSnapshot()" action="<?= base_url('index.php/welcome/insert') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="snapshot-data" name="snapshot">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="box-body">
                  <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenisKelamin" class="form-control" required>
                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Telp</label>
                        <input type="number" name="telp" class="form-control" placeholder="Telp" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Keperluan</label>
                        <select name="keperluan" class="form-control" required>
                            <option value="" selected disabled>-- Pilih Keperluan --</option>
                            <option value="0">Formulir permohonan bantuan hukum</option>
                            <option value="1">Formulir permohonan penggeledahan</option>
                            <option value="2">Formulir pemberitahuan perkara</option>
                            <option value="3">Formulir surat kuasa</option>
                            <option value="4">Formulir permohonan penangguhan eksekusi</option>
                            <option value="5">Formulir permohonan peninjauan kembali</option>
                            <option value="6">Formulir permohonan penggantian jaksa penuntut umum</option>
                            <option value="7">Formulir permohonan rekonsiliasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tujuan Kepada</label>
                        <input type="text" name="kepada" class="form-control" placeholder="Kepada" required>
                    </div>
                </div>
                <div class="box-footer">
                   
                    <button type="submit" class="btn btn-primary pull-right">
                        <div class="fa fa-save"></div> Simpan
                    </button>
                </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
        <b>.</b>.
        </div>
        <strong>Copyright &copy; <?= date('Y') ?> <a href="https://shopee.co.id/muhaidi7499" target="blank">Oscar Store</a>.</strong> All rights reserved.
        
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- Sweet Alert -->
<script src="<?= base_url('assets') ?>/bower_components/sweetalert/sweetalert.min.js"></script>
<!-- jQuery 3 -->
<script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url('assets') ?>/bower_components/jquery-mask/dist/jquery.mask.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url('assets') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets') ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
<script>
  // Ambil elemen video
  var video = document.getElementById('camera');

  // Minta izin akses camera
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(stream) {
      // Jika izin diberikan, tampilkan video dari camera pada elemen <video>
      video.srcObject = stream;
    })
    .catch(function(error) {
      // Jika izin ditolak, tampilkan pesan error
      console.error('Error accessing camera:', error);
    });

    function takeSnapshot() {
    // Ambil elemen <video>, <canvas>, dan <input type="hidden">
    var video = document.getElementById('camera');
    var snapshot = document.getElementById('snapshot');
    var snapshotDataInput = document.getElementById('snapshot-data');

    // Ambil context dari <canvas>
    var context = snapshot.getContext('2d');

    // Tampilkan snapshot dari <video> pada <canvas>
    context.drawImage(video, 0, 0, snapshot.width, snapshot.height);

    // Ambil data URL dari snapshot yang ada pada <canvas>
    var snapshotDataURL = snapshot.toDataURL();

    // Masukkan data URL dari snapshot ke dalam elemen <input type="hidden">
    snapshotDataInput.value = snapshotDataURL;
  }
  // Notifikasi
  const flashData = $('.flash-data').data('flashdata');
  if (flashData){
    swal({
      title: "Selamat!",
      text: flashData,
      icon: "success",
    });
  }
  
  var rupiah = document.getElementById('rupiah1');
    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    var rupiah2 = document.getElementById('rupiah2');
    rupiah2.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah2.value = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah2        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah2 += separator + ribuan.join('.');
      }
 
      rupiah2 = split[1] != undefined ? rupiah2 + ',' + split[1] : rupiah2;
      return prefix == undefined ? rupiah2 : (rupiah2 ? 'Rp. ' + rupiah2 : '');
    }

    var rupiah3 = document.getElementById('rupiah3');
    rupiah3.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah3.value = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah3        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah3 += separator + ribuan.join('.');
      }
 
      rupiah3 = split[1] != undefined ? rupiah3 + ',' + split[1] : rupiah3;
      return prefix == undefined ? rupiah3 : (rupiah3 ? 'Rp. ' + rupiah3 : '');
    }

    var rupiah4 = document.getElementById('rupiah4');
    rupiah4.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah4.value = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah4        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah4 += separator + ribuan.join('.');
      }
 
      rupiah4 = split[1] != undefined ? rupiah4 + ',' + split[1] : rupiah4;
      return prefix == undefined ? rupiah4 : (rupiah4 ? 'Rp. ' + rupiah4 : '');
    }
</script>
</body>
</html>
