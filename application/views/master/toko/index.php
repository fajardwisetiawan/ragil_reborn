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
                    <a href="<?= back() ?>" type="button" class="btn btn-primary float-left"><i class="fas fa-chevron-left"></i> Kembali</a>
                </div>
                <form method="POST" action="<?= base_url("master/pcare/save") ?>" id="form_add" enctype='multipart/form-data'>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="recipient-name" class="control-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" name="alamat_lengkap" id="alamat_lengkap" value="<?= $toko ? $toko->alamat_lengkap : ""  ?>" readonly="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label" >Cons ID</label>
                                    <input type="text" class="form-control" name="cons_id" id="cons_id" value="<?= $po->cons_id ?>" readonly="true">
                                </div>
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label">Secret ID</label>
                                    <input type="text" class="form-control" name="secret_id" id="secret_id" value="<?= $po->secret_id ?>" readonly="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label">Pcare Username</label>
                                    <input type="text" class="form-control" name="pcare_username" id="pcare_username" value="<?= $po->pcare_username ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label">Pcare Password</label>
                                    <input type="text" class="form-control" name="pcare_password" id="pcare_password" value="<?= $po->pcare_password ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label">Nomor Rekening</label>
                                    <input type="text" class="form-control" name="nomor_rekening" id="nomor_rekening" value="<?= $po->nomor_rekening ?>" readonly="true">
                                </div>
                                <div class="col-md-6">
                                    <label for="recipient-name" class="control-label">Periksa Koneksi BPJS</label>
                                    <button id="btnCekBPJS" class="btn btn-info" style="width: 100%;">
                                        <i class="fas fa-network-wired"></i> Periksa Koneksi Ke BPJS
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success ml-1" style="width: 100%;">
                            <i class="fas fa-save"></i> SIMPAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<div class="modal fade myModal" id="modal_ubah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Ubah <?= $title ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url("master/bank/update") ?>" id="form_add" enctype='multipart/form-data'>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name" class="control-label">Nama Bank <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="id_edit" id="id_edit" placeholder="ID" required>
                                <input type="text" class="form-control" name="nama_edit" id="nama_edit" placeholder="Nama Bank" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name" class="control-label">Nomor Rekening <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="no_rekening_edit" id="no_rekening_edit" placeholder="Nomor Rekening" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary add-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_data').DataTable();
    });

    function modal_edit(id) {
        $.ajax({
            url: "<?= base_url('master/bank/getById/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            contentType: "application/json; charset=utf-8",
            success: function(result) {
                $('#id_edit').val(result.id);
                $("#nama_edit").val(result.nama)
                $("#no_rekening_edit").val(result.no_rekening)
            }
        });
    }

    function hapus(id) {
        swal.fire({
            title: 'Hapus Data ?',
            text: "Data akan terhapus secara permanent",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('master/bank/delete') ?>",
                    data: {
                        "id": id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.response_code == 200) {
                            Swal.fire(
                                'Terhapus',
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