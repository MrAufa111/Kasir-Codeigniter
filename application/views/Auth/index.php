<div class="swall" data-swall="<?= $this->session->flashdata('success') ?>"></div>
<div class="error" data-error="<?= $this->session->flashdata('error') ?>"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="d-flex justify-content-center align-items-center">
                <div class="col-lg-4 py-5">
                    <div class="shadow p-3 mb-5 rounded-3 mt-3">
                        <div class="card-header">
                            <div class="text-center">
                                <span class="fs-2 fw-bold">Login</span>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <form action="<?= base_url('Auth/login') ?>" method="post">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Username...">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password...">
                                </div>
                                <div class=" mt-2">
                                    <button class="btn btn-primary col-lg-12" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>