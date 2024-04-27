<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="shadow p-3 mb-5 rounded-3 mt-3">
        <div class="card-body">
            <form action="<?= base_url('barang/update') ?>" method="post">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="<?= $barang['id'] ?>">
                    <label for="kode_barang" class="form-label">Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control" placeholder="Kode Barang" id="kode_barang" value="<?= $barang['kode_barang'] ?>">
                </div>
                <div class="form-group">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" id="nama_barang" value="<?= $barang['nama_barang'] ?>">
                </div>
                <div class="form-group">
                    <label for="exp" class="form-label">Exp</label>
                    <input type="date" name="exp" class="form-control" placeholder="Exp" value="<?= $barang['exp'] ?>" id="exp">
                </div>
                <div class="form-group">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="<?= $barang['stock'] ?>" placeholder="Stock" id="stock">
                </div>
                <div class="form-group">
                    <label for="harga_perbarang" class="form-label">Harga Perbarang</label>
                    <input type="text" name="harga_perbarang" class="form-control" value="<?= $barang['harga_perbarang'] ?>" placeholder="Harga Perbarang" id="harga_perbarang">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/vendor/jquery-number/jquery.number.js"></script>
<script>
    $(document).ready(function() {
        $('#harga_perbarang').number(true, 0, ',', '.');
        let user = "<?php $this->session->userdata('roleId'); ?>";
        if (user != 1) {
            $('#kode_barang').attr('readonly', true);
        }

    });
</script>