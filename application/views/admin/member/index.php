<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <?php
    date_default_timezone_set('Asia/Bangkok');
    $tanggal = date('Y-m-d ');
    ?>
    <div class="mt-3 ">

        <div class="shadow p-3 mb-5 rounded-3 mt-3">
            <div class="btn-group">
                <a class="btn btn-primary" href="<?= base_url('member/tambahMember') ?>">Tambah Member</a>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDiskon">Diskon</button>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered " id="tables">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Member</th>
                                <th>No Telp</th>
                                <th width="10%">Exp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($member as $b) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $b['nama_member'] ?></td>
                                    <td><?= $b['no_telp'] ?></td>
                                    <td>
                                        <?php if ($b['exp'] >= $tanggal) : ?>
                                            <span class="badge text-bg-success">Aktif Sampai :
                                                <?= date('d-m-Y', strtotime($b['exp'])); ?></span>
                                        <?php else : ?>
                                            <span class="badge text-bg-danger">Expired</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= base_url('member/editMember/' . $b['id']) ?>" class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
                                            <a href="<?= base_url('member/delete/' . $b['id']) ?>" class="btn btn-danger btn-hapus"><i class="bi bi-trash"></i></a>
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

<div class="modal fade" id="modalDiskon" tabindex="-1" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Diskon
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('diskon/update') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="diskon" class="form-label">Diskon</label>
                        <div class="d-flex">
                            <input type="hidden" name="id" id="id" value="<?= $diskon['id'] ?>">
                            <input type="text" name="diskon" value="<?= str_replace('%', '', $diskon['diskon']) ?>" id="diskon" placeholder="Diskon" class="form-control">
                            <span class="btn btn-secondary">%</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="minimal">Minimal Pembelanjaan</label>
                        <input type="text" name="minimal" value="<?= $diskon['minimal_pembelanjaan'] ?>" id="minimal" placeholder="Minimal Pembelanjaan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="<?= base_url() ?>assets/vendor/DataTables/datatables.js"></script>
<script src="<?= base_url() ?>assets/vendor/DataTables/DataTables-2.0.1/js/dataTables.bootstrap5.js"></script>
<script>
    $('#tables').DataTable();
    let user = "<?= $this->session->userdata('roleId'); ?>"
    if (user != 1) {
        $('#diskon').attr('readonly', true);
        $('#minimal').attr('readonly', true);
        $('#diskon').attr('disabled', true);
        $('#minimal').attr('disabled', true);
        $('#save').css('display', 'none');
    }
</script>