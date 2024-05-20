<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <a href="<?= base_url('laporan/cetak_laporan_buku'); ?>" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a>
            <a href="<?= base_url('laporan/data_user'); ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Download Pdf</a>
            <a href="<?= base_url('laporan/export_excel'); ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export ke Excel</a><table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Anggota</th>
                        <th>Email</th>
                        <th>role_id</th>
                        <th>Aktif</th>
                        <th>Member Sejak</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                foreach ($user as $user){
                ?>
                <tr>
                    <th scope = "row"><?= $no++;?></th>
                    <td><?= $user ['nama anggota'];?></td>
                    <td><?= $user ['pengarang'];?></td>
                    <td><?= $user ['penerbit'];?></td>
                    <td><?= $user  ['tahun_terbit'];?></td>
                    <td><?= $user  ['isbn'];?></td>
                    <td><?= $user  ['stok'];?></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
            </div>
    </div>
</div>
<!-- /.container-fluid -->