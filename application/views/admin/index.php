<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="row">

        <div class="col-lg-4 col-md-12">
            <div class="card  shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <span>Pemasukan</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <div class="d-flex justify-content-end">
                                <div class="btn-group">
                                    <a class="text-dark " data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= base_url(); ?>Laporan">Liat Detail</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xl-3">
                            <div class="card bg-success text-center">
                                <i class="fs-3 bi-currency-dollar" style="color:white"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-xl-9">
                            <div class="">
                                <span class="fs-4" id="pemasukan">Rp. 0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12" id="ma">
            <div class="card  shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <span>Member Aktif</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <div class="d-flex justify-content-end">
                                <div class="btn-group">
                                    <a class="text-dark " data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= base_url(); ?>member">Liat Detail</a></li>
                                        <li><a class="dropdown-item" id="btn-change">Liat Member Tidak Aktif</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xl-3">
                            <div class="card bg-secondary text-center">
                                <i class="fs-3 bi-people" style="color:white"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-xl-9">
                            <div class="">
                                <span class="fs-4" id="member">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 d-none" id="mta">
            <div class="card  shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <span>Member Tidak Aktif</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <div class="d-flex justify-content-end">
                                <div class="btn-group">
                                    <a class="text-dark " data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= base_url(); ?>member">Liat Detail</a></li>
                                        <li><a class="dropdown-item" id="btn-change-tidak">Liat Member Tidak Aktif</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xl-3">
                            <div class="card bg-secondary text-center">
                                <i class="fs-3 bi-people" style="color:white"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-xl-9">
                            <div class="">
                                <span class="fs-4" id="membertidakAktif">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card  shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <span>Transaksi</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <div class="d-flex justify-content-end">
                                <a href="" class="text-dark"><i class="bi bi-three-dots"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xl-3">
                            <div class="card bg-primary text-center">
                                <i class="fs-3 bi-cart" style="color:white"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-xl-9">
                            <div class="">
                                <span class="fs-4" id="transaksi">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/vendor/jquery-number/jquery.number.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('dashboard/getCountPemasukan'); ?>",
            dataType: 'json',
            success: function(response) {
                let pemasukan = parseFloat(response.total_penjualan[0].total_penjualan)
                let member = parseFloat(response.total_member[0].jumlah_member);
                let transaksi = parseFloat(response.countTransaksi[0].Total_transaksi);
                let membertidakaktif = parseFloat(response.memberTidakAktif[0].total_member_tidak_aktif)
                if (!isNaN(pemasukan) && !isNaN(member) && !isNaN(transaksi) && !isNaN(membertidakaktif)) {
                    let formatPemasukan = $.number(pemasukan, 0, ',', '.');
                    $('#pemasukan').text("Rp. " + formatPemasukan);
                    $('#member').text(member);
                    $('#transaksi').text(transaksi);
                    $('#membertidakAktif').text(membertidakaktif);
                } else {
                    console.log('ok');
                }

            }
        });
        $('#btn-change').on('click', function() {
            $('#mta').removeClass('d-none');
            $('#ma').addClass('d-none');
        })
        $('#btn-change-tidak').on('click', function() {
            $('#mta').addClass('d-none');
            $('#ma').removeClass('d-none');
        })
    });
</script>