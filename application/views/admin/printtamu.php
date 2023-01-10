<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= $title ?></title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
        <![endif]-->
    </head>
    <?php
        date_default_timezone_set('Asia/Jakarta');
    ?>
    <body>
        <div class="container">
            <center><h3><?= strtoupper($title) ?></h3></center>

            <table>
                <tr>
                    <td width="100px">Tanggal</td>
                    <td width="10px">:</td>
                    <td>
                        <?php
                            if ($tglawal == $tglakhir) {
                                echo date('d F Y', strtotime($tglawal));
                            } else {
                                echo date('d F Y', strtotime($tglawal)) . ' s/d ' . date('d F Y', strtotime($tglakhir));
                            }
                        ?>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="10px">#</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Instansi</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Keperluan</th>
                        <th>Terdaftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($tamu->result_array() as $row) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['jenisKelamin'] ?></td>
                            <td><?= $row['instansi'] ?></td>
                            <td><?= $row['telp'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['keperluan'] ?></td>
                            <td><?= date('d M Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <font style="position: fixed; bottom: 0"><i><small>Dicetak Pada <?= date('d F Y H:i:s') ?> Oleh <?= $this->session->userdata('nama') ?></small></i></font>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script>
            window.print();
        </script>
    </body>
</html>