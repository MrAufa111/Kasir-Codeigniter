<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <?php $date = date('Y-m-d'); ?>

    <div class="mt-3 ">
        <?php if ($this->session->userdata['roleId'] == 1) : ?>
            <div class="shadow-sm p-3 mb-3 p-3 rounded mt-3">
                <form action="<?= base_url('barang/excel') ?>" method="post">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 ">
                            <div class="form-grup">
                                <label for="tanggal" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $date; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 ">
                            <div class="form-grup">
                                <label for="stanggal" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" name="stanggal" id="stanggal" value="<?= $date; ?>">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 ">
                            <label for="" class="form-label" style="color: white;">ok</label>
                            <button class="btn btn-success col-12">Download</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>
        <div class="shadow p-3 mb-5 rounded-3 mt-3">
            <div class="">
                <a class="btn btn-primary" href="<?= base_url('barang/tambahBarang') ?>">Tambah Barang</a>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered" id="tables">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Exp</th>
                                <th>Stok</th>
                                <th>Harga Perbarang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($barang as $b) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $b['kode_barang'] ?></td>
                                    <td><?= $b['nama_barang'] ?></td>
                                    <td><?= $b['exp'] ?></td>
                                    <td><?= $b['stock'] ?></td>
                                    <td><?= $b['harga_perbarang'] ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                            </button>
                                            <ul class="dropdown-menu">
                                                <li> <a href="<?= base_url('barang/editBarang/' . $b['id']) ?>" class=" dropdown-item   ">Edit<i class="bi bi-pencil"></i></a></li>
                                                <?php if ($this->session->userdata('roleId') == 1) : ?>
                                                    <li> <a href="<?= base_url('barang/delete/' . $b['id']) ?>" class="dropdown-item  btn-hapus">Delete<i class="bi bi-trash"></i></a></li>
                                                <?php endif; ?>
                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tambahStok<?= $b['id'] ?>" href="#">Tambah
                                                        Stock <i class="bi bi-plus"></i></a></li>

                                            </ul>
                                        </div>
                                        <div class="btn-group">


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

<?php foreach ($barang as $b) : ?>
    <div class="modal fade" id="tambahStok<?= $b['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Stock Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('barang/updateStock/' . $b['id']) ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="text" class="form-control" name="stock" id="stock" placeholder="stock" value="<?= $b['stock'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script src="<?= base_url() ?>assets/vendor/DataTables/datatables.js"></script>
<script src="<?= base_url() ?>assets/vendor/DataTables/DataTables-2.0.1/js/dataTables.bootstrap5.js"></script>
<script>
    $('#tables').DataTable();
</script>