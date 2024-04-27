<div class="col py-3">
    <div class="fs-2">
        <span><?= $title ?></span>
    </div>
    <hr>
    <div class="shadow-sm rounded-3 p-3">
        <form action="<?= base_url('laporan/edit/' . $laporan['id_transaksi']) ?>" method="post">
            <div class="row" id="form">
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="no_faktur" class="form-label">Nomor Faktur</label>
                        <input type="text" class="form-control" name="no_faktur" readonly disabled id="no_faktur" "
                        value=" <?= $laporan['no_faktur'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="no_trans" class="form-label">Nomor Transaksi</label>
                        <input type="text" class="form-control" name="no_trans" readonly disabled id="no_trans"
                            value="<?= $laporan['no_transaksi'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="nama_kasir" class="form-label">Nama Kasir</label>
                        <input type="text" class="form-control" name="nama_kasir" readonly disabled id="nama_kasir"
                            value="<?= $laporan['nama_kasir'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" readonly disabled id="tanggal"
                            value="<?= $laporan['tanggal'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="member" class="form-label">Member</label>
                        <input type="text" class="form-control" name="member" readonly disabled id="member"
                            value="<?= $laporan['member'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="metode_pem" class="form-label">Metode Pembayaran</label>
                        <input type="text" class="form-control" name="metode_pem" readonly disabled id="metode_pem"
                            value="<?= $laporan['metode_pembayaran'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="pembayaran" class="form-label">Pembayaran</label>
                        <input type="text" class="form-control" name="pembayaran" readonly disabled id="pembayaran"
                            value="<?= $laporan['pembayaran'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="kembalian" class="form-label">Kembalian</label>
                        <input type="text" class="form-control" name="kembalian" readonly disabled id="kembalian"
                            value="<?= $laporan['kembalian'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="diskon" class="form-label">Diskon</label>
                        <input type="text" class="form-control" name="diskon" readonly disabled id="diskon"
                            value="<?= $laporan['diskon'] ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="total" class="form-label">Total</label>
                        <input type="text" class="form-control" name="total" readonly disabled id="total"
                            value="<?= $laporan['total'] ?>">
                    </div>
                </div>
                <div class="table table-responsive mt-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga Barang</th>
                                <th>Harga Total</th>
                                <th id="action" style="display:none">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tampilanbarang">

                        </tbody>
                    </table>
                </div>
                <?php if ($this->session->userdata('roleId') == 1): ?>
                    <div class="mt-2 d-flex justify-content-end">
                        <a class="btn btn-secondary" id="Edit">Edit</a>
                        <button class="btn btn-success" type="submit" id="success" style="display: none;">Submit</button>
                    </div>
                <?php endif; ?>
        </form>
    </div>

</div>
<script src="<?= base_url() ?>assets/vendor/jquery-number/jquery.number.js"></script>

<script>
    $(document).ready(function () {
        $('#pembayaran').number(true, 0, ',', '.')
        $('#kembalian').number(true, 0, ',', '.')
        $('#diskon').number(true, 0, ',', '.')
        $('#total').number(true, 0, ',', '.')
        $('#Edit').on('click', function () {
            $('#form input').removeAttr('readonly disabled');
            $(this).css('display', 'none');
            $('#success').css('display', 'block')
            $('#action').css('display', 'block');
            $('.aksi').removeAttr('style');
        })
        // console.log(id);





    });
    $(document).ready(function () {
        let getID = "<?= $this->uri->segment('3'); ?>";
        let url = "<?= base_url('laporan/get/') ?>" + getID;
        let row = $('#tampilanbarang tr');
        let column = row.length;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                let result = response[0];
                $.each(response, function (index, result) {
                    $('#tampilanbarang').append(
                        '<tr class="row-table">' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td class="kodebarang">' + result.kode_barang + '</td>' +
                        '<td class="namaBarang">' + result.nama_barang + '</td>' +
                        '<td class="qyt">' + result.qyt + '</td>' +
                        '<td class="hargabarang">' + result.harga_barang + '</td>' +
                        '<td class="subTotalHarga">' + result.harga_total_barang + '</td>' +
                        '<td class="aksi" style="display:none"><button class="btn btn-danger deleteval' + result.id_detail + '"><i class="bi bi-trash"></i></button></td>' +
                        '</tr>'
                    );
                    $('#tampilanbarang').on('click', ".deleteval" + result.id_detail, function () {
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('laporan/hapusbarang/') ?>" + result.id_detail,
                            success: function (response) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Barang Berhasil Di Hapus",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                        let row = $(this).closest('tr');
                        row.remove();
                    })
                });


            }
        });

    });

</script>