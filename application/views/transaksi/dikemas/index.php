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
                <div class="card-body table-responsive">
                    <table id="table_data" class="table nowrap table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 3%">No.</th>
                                <th style="width: 8%" class="text-center">Aksi</th>
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
                                foreach ($transaksi as $t) { 
                            ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td class="text-center">
                                        <button type="button" title="Verifikasi Pembayaran" onclick="verifikasi_pengiriman('<?= $t->id ?>', '<?= $nama_produk ?>', '<?= $t->nama_user ?>')" class="btn btn-sm btn-success waves-effect waves-light"><span class="btn-label text-white"><i class="fas fa-check"></i></span></button>
                                    </td>
                                    <td><?= $t->nama_produk ?></td>
                                    <td>Rp. <?= number_format($t->harga,2) ?></td>
                                    <td><?= $t->ukuran ?></td>
                                    <td><?= $t->jumlah ?></td>
                                    <td><?= $t->catatan ?></td>
                                    <td><?= $t->created_at ?></td>
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

    function verifikasi_pengiriman(id, nama_produk, nama_user) {
        swal.fire({
            title: 'Verifikasi pembayaran ' + nama_produk + ' atas nama ' + nama_user,
            text: "Pesanan yang sudah diverifikasi akan masuk ke list barang dikirim",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Verifkasi'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('transaksi/dikemas/verifikasi_pengiriman') ?>",
                    data: {
                        "id": id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.response_code == 200) {
                            Swal.fire(
                                'Berhasil',
                                data.response_message,
                                'success'
                            ).then((result) => {
                                location.reload()
                            })
                        } else {
                            Swal.close();
                            Swal.fire("Oops", data.response_message, "error");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Oops", xhr.responseText, "error");
                    }
                })
            }
        });
    }
</script>