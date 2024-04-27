<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="mt-3 ">

        <div class="shadow-sm p-3 mb-5 rounded-3 ">
            <form action="<?= base_url('masterToko/update/' . $toko['id']); ?>" method="post">
                <div class="form-group">
                    <label for="" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" name="nama_toko" id="nama_toko" value="<?= $toko['nama_toko']; ?>">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Alamat Toko</label>
                    <input type="text" class="form-control" name="alamat_toko" id="alamat_toko" value="<?= $toko['alamat']; ?>">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" value="<?= $toko['no_telp']; ?>">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/vendor/DataTables/datatables.js"></script>
<script src="<?= base_url() ?>assets/vendor/DataTables/DataTables-2.0.1/js/dataTables.bootstrap5.js"></script>
<script src="<?= base_url() ?>assets/vendor/select2/dist/select2.min.js"></script>
<script>
    $('#petugas').select2({

        theme: 'bootstrap4',
    });

    $('#tables').DataTable();
</script>