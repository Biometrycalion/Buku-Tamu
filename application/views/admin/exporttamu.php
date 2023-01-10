<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Export Data Tamu.xls");
?>

<table>
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
            <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
        </tr>
    <?php } ?>
</table>