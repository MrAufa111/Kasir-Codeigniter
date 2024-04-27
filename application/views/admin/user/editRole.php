<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="shadow p-3 mb-5 rounded-3 mt-3">
        <div class="card-body">
            <form action="<?= base_url('user/updateRole') ?>" method="post">
                <div class="form-group">
                    <input type="hidden" value="<?= $role['id'] ?>" name="id" id="id">
                    <label for="role" class="form-label">Nama Role</label>
                    <input type="text" name="role" class="form-control" value="<?= $role['name_role'] ?>"
                        placeholder="Role" id="role">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>