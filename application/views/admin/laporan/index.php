<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="mt-3 ">
        <div class="shadow-sm p-3 mb-3 p-3 rounded mt-3">
            <form action="<?= base_url('laporan/excel') ?>" method="post">
                <div class="row">
                    <div class="col-lg-3 col-md-12 ">
                        <div class="form-grup">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 ">
                        <div class="form-grup">
                            <label for="tanggal" class="form-label">Petugas</label>
                            <select name="petugas" class="form-select" id="petugas">
                                <option selected>Pilih Petugas</option>
                                <?php foreach ($petugas as $p): ?>
                                    <option value="<?= $p['username'] ?>"><?= $p['username'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 ">
                        <div class="form-grup">
                            <label for="tanggal" class="form-label">Metode Pembayaran</label>
                            <select name="metode" class="form-select" id="metode">
                                <option selected>Pilih Metode Pembayaran</option>
                                <?php foreach ($metode as $m): ?>
                                    <option value="<?= $m->name_metode ?>"><?= $m->name_metode ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 ">
                        <label for="" class="form-label" style="color: white;">ok</label>
                        <button class="btn btn-success col-12">Download</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="shadow-sm p-3 mb-5 rounded-3 ">

            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered" id="tables">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Nomor Transaksi</th>
                                <th>Nomor Faktur</th>
                                <th>Tanggal</th>
                                <th>Petugas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($laporan as $b): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $b['no_transaksi'] ?></td>
                                    <td><?= $b['no_faktur'] ?></td>
                                    <td><?= $b['tanggal'] ?></td>
                                    <td><?= $b['nama_kasir'] ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= base_url('laporan/detail/' . $b['id_transaksi']) ?>"
                                                class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
                                            <a href="<?= base_url('laporan/hapus/' . $b['id_transaksi']) ?>"
                                                class="btn btn-danger btn-hapus"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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