<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="mt-3 ">

        <div class="shadow-sm p-3 mb-5 rounded-3 ">

            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered" id="tables">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Nama Toko</th>
                                <th>Alamat</th>
                                <th class="text-start">Nomor Telepon</th>
                                <th width="5%" align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($laporan as $b) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $b['nama_toko'] ?></td>
                                    <td><?= $b['alamat'] ?></td>
                                    <td class="text-start"><?= $b['no_telp'] ?></td>
                                    <td align="center">
                                        <div class="btn-group">
                                            <a href="<?= base_url('masterToko/detail/' . $b['id']) ?>" class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
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