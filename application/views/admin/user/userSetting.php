<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="mt-3 ">
        <div class="shadow p-3 mb-5 rounded-3 mt-3">
            <div class="btn-group">
                <a class="btn btn-primary" href="<?= base_url('user/tambahUser') ?>">Tambah User</a>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered" id="tables">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Username</th>
                                <th width="30%">Password</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($user as $b):
                                if ($b['id'] != 1):
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $b['username'] ?></td>
                                        <td>.....</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url('user/editUser/' . $b['id']) ?>"
                                                    class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
                                                <a href="<?= base_url('user/deleteUser/' . $b['id']) ?>"
                                                    class="btn btn-danger btn-hapus"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="<?= base_url() ?>assets/vendor/DataTables/datatables.js"></script>
<script src="<?= base_url() ?>assets/vendor/DataTables/DataTables-2.0.1/js/dataTables.bootstrap5.js"></script>
<script>
    $('#tables').DataTable();


</script>