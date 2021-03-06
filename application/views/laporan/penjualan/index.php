<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"><b><?= $title ?></b> | <?= $app_name ?></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <?php if ($this->session->flashdata("gagal")) : ?>
            <div class="alert bg-danger alert-dismissible fade show" role="alert">
                <strong>Gagal !</strong> <?= $this->session->flashdata("gagal") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php unset($_SESSION["gagal"]);
        endif; ?>

        <?php if ($this->session->flashdata("sukses")) : ?>
            <div class="alert bg-success alert-dismissible fade show" role="alert">
                <strong>Sukses !</strong> <?= $this->session->flashdata("sukses") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php unset($_SESSION["sukses"]);
        endif; ?>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url('laporan/penjualan/excel') ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Laporan <?= $title ?></a>
                </div>
                <div class="card-body table-responsive">
                    <table id="table_data" class="table nowrap table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 3%">No.</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Ukuran</th>
                                <th>Jumlah</th>
                                <th>Catatan</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach ($laporan as $l) { 
                            ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td><?= $l->nama_produk ?></td>
                                    <td>Rp. <?= number_format($l->harga,2) ?></td>
                                    <td><?= $l->ukuran ?></td>
                                    <td><?= $l->jumlah ?></td>
                                    <td><?= $l->catatan ?></td>
                                    <td><?= $l->created_at ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('#table_data').DataTable();
    });
</script>