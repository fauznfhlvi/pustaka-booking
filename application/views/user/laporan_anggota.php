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
            <a href="<?= base_url('laporan/cetak_laporan_anggota'); ?>" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a>
            <a href="<?= base_url('laporan/laporan_pdf_anggota'); ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Download Pdf</a>
            <a href="<?= base_url('laporan/export_excel_anggota'); ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export ke Excel</a>
            <table class="table mt-3">
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
            </div>
    </div>
</div>
<!-- /.container-fluid -->