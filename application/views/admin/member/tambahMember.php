<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="shadow p-3 mb-5 rounded-3 mt-3">
        <div class="card-body">
            <form action="<?= base_url('member/insert') ?>" method="post">

                <div class="form-group">
                    <label for="nama_member" class="form-label">Nama Member</label>
                    <input type="text" name="nama_member" class="form-control" placeholder="Nama Member"
                        id="nama_member">
                </div>
                <div class="form-group">
                    <label for="no_telp" class="form-label">Nomor Telepon</label>
                    <input type="number" name="no_telp" class="form-control" placeholder="Nomor Telepon" id="no_telp">
                </div>
                <div class="form-group">
                    <label for="exp" class="form-label">Exp</label>
                    <input type="date" name="exp" class="form-control" placeholder="Exp" id="exp">
                </div>


                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>