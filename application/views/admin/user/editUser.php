<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="shadow p-3 mb-5 rounded-3 mt-3">
        <div class="card-body">
            <form action="<?= base_url('user/updateUser') ?>" method="post">
                <input type="hidden" value="<?= $user['id'] ?>" name="id" id="id">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>"
                        placeholder="Username" id="username">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                </div>
                <div class="form-group">
                    <label for="v_password" class="form-label">Verifikasi Password</label>
                    <input type="password" name="v_password" class="form-control" placeholder="Verifikasi Password"
                        id="v_password">
                </div>
                <div class="form-group">
                    <label for="form_label">Role</label>
                    <select name="role" class="form-select" id="role">
                        <option>Select Role</option>
                        <?php foreach ($role as $r): ?>
                            <option value="<?= $r['id'] ?>" <?= $user['roleId'] == $r['id'] ? 'selected' : 'selected' ?>>
                                <?= $r['name_role'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>