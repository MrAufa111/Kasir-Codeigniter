<?php $user = $this->session->userdata('username'); ?>
<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-secondary">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-light min-vh-100">
        <a href="<?= base_url() ?>" class="d-flex align-items-center text-center pb-3 mb-md-0 me-md-auto text-light text-decoration-none">
            <span class="fs-3 d-none d-sm-inline">Point Of Sales</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <?php if ($this->session->userdata('roleId') == 1) : ?>
                <li class="nav-item">
                    <a href="<?= base_url('Dashboard') ?>" class="nav-link align-middle px-0 text-light">
                        <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a href="<?= base_url('Transaksi') ?>" class="nav-link align-middle px-0 text-light">
                    <i class="fs-4 bi-cart"></i> <span class="ms-1 d-none d-sm-inline">Transaksi</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('Barang') ?>" class="nav-link align-middle px-0 text-light">
                    <i class="fs-4 bi-box"></i> <span class="ms-1 d-none d-sm-inline">Barang</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('Member') ?>" class="nav-link align-middle px-0 text-light">
                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Member</span>
                </a>
            </li>
            <?php if ($this->session->userdata('roleId') == 1) : ?>
                <li>
                    <a href="#submenu1" data-bs-toggle="collapse" class="nav-link text-light px-0 align-middle">
                        <i class="fs-4 bi-person"></i><span class="ms-1 d-none d-sm-inline">user</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="<?= base_url('user/userSetting') ?>" class="nav-link px-0 text-light"> <span class="d-none d-sm-inline">User
                                    Setting</span></a>
                        </li>
                        <li>
                            <a href="<?= base_url('user/Role') ?>" class="nav-link px-0 text-light"> <span class="d-none d-sm-inline">Role</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('mastertoko') ?>" class="nav-link align-middle px-0 text-light">
                        <i class="fs-4 bi-shop"></i> <span class="ms-1 d-none d-sm-inline">Master Toko</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('laporan') ?>" class="nav-link align-middle px-0 text-light">
                        <i class="fs-4 bi-file-earmark-excel"></i> <span class="ms-1 d-none d-sm-inline">Laporan
                            Transaksi</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="d-none d-sm-inline mx-1"><?= $user ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-light text-small shadow">

                <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>