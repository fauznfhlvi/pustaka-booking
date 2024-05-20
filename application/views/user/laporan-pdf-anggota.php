<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <style type ="text/css">
            .tabel-data{
                width :500px
                border-collapse : collapse;
            }
            .table-data tr th, 
            .table-data tr td{
                border :1px solid black
                font-size :11pt;
                padding:20px 20px 20px 20px;
            }
        </style>
        <h3><center>Laporan Data Anggota Perpusatakaan Online </center></h3>
        <br/>
        <table class = "table-data">
        <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Anggota</th>
                        <th>Email</th>
                        <th>Role ID</th>
                        <th>Aktif</th>
                        <th>Member Sejak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1 ;
                        foreach ($anggota as $a) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $a['nama']; ?></td>
                                <td><?= $a['email']; ?></td>
                                <td><?= $a['role_id']; ?></td>
                                <td><?= $a['is_active']; ?></td>
                                <td><?= date('Y', $a['tanggal_input']); ?></td>
                            </tr>
                    <?php } ?>
                </tbody>
        </table>
    </body>
</html>