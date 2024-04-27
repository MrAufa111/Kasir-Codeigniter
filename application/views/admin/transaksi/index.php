<div class="col py-3">
    <h3 class="mt-2 mb-4"><?= $title ?></h3>
    <hr>
    <?php
    date_default_timezone_set('Asia/Bangkok');
    $tanggal = date('Y-m-d h:i:s');
    ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="namakasir" class="form-label">Nama Kasir</label>
                        <input type="text" class="form-control" readonly placeholder="Nama Kasir" disabled id="namakasir" name="namakasir" value="<?= $kasir ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="nofaktur" class="form-label">No Faktur</label>
                        <input type="text" class="form-control" placeholder="No Faktur" readonly disabled id="nofaktur" name="nofaktur">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="notransaksi" class="form-label">No Transaksi</label>
                        <input type="text" class="form-control" placeholder="No Transaksi" disabled value="<?= $transaksi ?>" readonly id="notransaksi" name="notransaksi">
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="hidden" id="tanggal2" name="tanggal2" value="<?= $tanggal ?>">
                        <input type="text" class="form-control" placeholder="Tanggal" disabled readonly id="tanggal" name="tanggal">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="kodebarang" class="form-label">Kode Barang</label>
                        <select name="kodebarang" class="form-select" id="kodebarang" data-placeholder="Kode Barang">
                            <option></option>
                            <?php foreach ($barang as $b) : ?>
                                <option value="<?= $b->kode_barang ?>"><?= $b->kode_barang ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="from-group">
                        <label for="namabarang" class="form-label">Nama Barang</label>
                        <input type="text" name="namabarang" id="namabarang" readonly disabled placeholder="Nama Barang" class="form-control">
                    </div>
                </div>
                <div class="col-3">
                    <div class="from-group">
                        <label for="hargabarang" class="form-label">Harga Barang</label>
                        <input type="text" name="hargabarang" id="hargabarang" readonly disabled placeholder="Harga Barang" class="form-control">
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="qyt" class="form-label">Qty </label>
                        <div class="d-flex">
                            <input type="number" class="form-control" id="qyt" name="qyt" placeholder="Masukan Kuantitas Barang">
                            <button class="btn btn-success" id="tambahBarang"><i class="bi bi-cart-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-8">
                    <div class="table table-responsive">
                        <table class="table table-bordered" id="tablebarang">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Kode Barang</th>
                                    <th width="20%">Nama Barang</th>
                                    <th width="15%">Harga</th>
                                    <th width="15%">Qty</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tampilanBarang">

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                date_default_timezone_set('Asia/Bangkok');
                $tanggal = date('Y-m-d');

                ?>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="member" class="form-label">Member(Optional)</label>
                                <select name="member" id="member" class="form-select" data-placeholder="Pilih Member">
                                    <option></option>
                                    <?php foreach ($member as $m) : ?>
                                        <option value="<?= $m->nama_member ?>" <?= $m->exp < $tanggal ? 'disabled' : '' ?>>
                                            <?= $m->nama_member ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mt-2">
                                <span class="fs-3 fw-bold">Total :</span> <span class="fs-3 fw-bold" id="total">0</span>
                            </div>
                            <div class="">
                                <span class="fw-bold">Diskon :</span> <span class=" fw-bold" id="diskon">0</span>
                            </div>
                            <div class="">
                                <span class="fw-bold">Pembayaran :</span> <span class=" fw-bold" id="pembayaran">0</span>
                            </div>

                            <div class="">
                                <span class="fw-bold">Kembalian :</span> <span class=" fw-bold" id="kembalian">0</span>
                            </div>
                            <div class="form-group mt-2">
                                <select class="form-select" id="jenisPembayaran" data-placeholder="Choose one thing">
                                    <option selected disabled>Pilih Metode Pembayaran</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="bayar" name="bayar" placeholder="bayar" style="display: none;">
                                </div>
                            </div>
                            <div class="mt-3 ">
                                <button class=" w-100 btn btn-success" style="display: none;" id="simpan">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/vendor/select2/dist/select2.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-number/jquery.number.js"></script>

<script>
    $('#bayar').number(true, 0, ',', '.')
    $('#member').select2({
        theme: 'bootstrap4',
    });
    $('#kodebarang').select2({
        theme: 'bootstrap4',
    });

    function generateNomorFaktur(length) {
        let result = ''
        const characters = '0123456789'
        const charactersLength = characters.length;
        let counter = 0
        while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength))
            counter += 1
        }
        return result
    }

    function kodeFaktur(length) {
        let result = ''
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
        const charactersLength = characters.length
        let counter = 0
        while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength))
            counter += 1
        }
        return result
    }

    $(document).ready(function() {
        let notrans = $('#notransaksi').val()
        let formattedDate = new Date().toISOString().slice(0, 10).replace(/-/g, "")
        let transactionCode = kodeFaktur(4)
        let randomCode = generateNomorFaktur(4)
        let invoiceNumber = notrans + '-' + formattedDate + '-' + transactionCode + '-' + randomCode;

        $('#nofaktur').val(invoiceNumber)
    });

    function updateTanggal() {
        var now = new Date()
        var tanggalFormatted = now.toLocaleString('en-US', {
            timeZone: 'Asia/Bangkok',
            hour12: false
        });
        $('#tanggal').val(tanggalFormatted)
    }
    setInterval(updateTanggal, 1000)
    updateTanggal();

    let tanggaal = $('#tanggal').val()


    $('#bayar').number(true, 0, ',', '.')
    $('#jenisPembayaran').on('change', function() {
        $('#bayar').css('display', 'block')
        $('#simpan').css('display', 'block')
    });
</script>

<script>
    $('#kodebarang').on('change', function() {
        let kode_barang = $(this).val()

        $.ajax({
            type: "post",
            url: "<?= base_url('transaksi/getBarang') ?>",
            data: {
                kode_barang: kode_barang
            },
            dataType: 'json',
            success: function(response) {
                let result = response
                let nama_barang = result.nama_barang
                let harga_barang = result.harga_perbarang
                $('#namabarang').val(nama_barang)
                $('#hargabarang').val(harga_barang)
            }
        });
    })

    $('#tambahBarang').on('click', function() {
        let kode_barang = $('#kodebarang').val()
        let qty = $('#qyt').val()
        $.ajax({
            type: "POST",
            url: "<?= base_url('transaksi/getBarang') ?>",
            data: {
                kode_barang: kode_barang
            },
            dataType: "json",
            success: function(response) {
                let result = response;
                let stock = parseFloat(result.stock);
                if (!isNaN(stock) && !isNaN(qty)) {
                    let stockDefault = 0
                    $('.qyt').each(function() {
                        stockDefault += parseFloat($(this).text())
                    });

                    stockDefault += parseFloat(qty);
                    if (stockDefault <= stock) {
                        let row = $('#tablebarang tr')
                        let colom = row.length
                        let namaBarang = $('#namabarang').val()
                        let hargabarang = $('#hargabarang').val()
                        let replaceHarga = hargabarang.replace(/\D/g, "")
                        let total = replaceHarga * qty
                        let subTotal = $.number(total, 0, ',', '.')

                        if (!isNaN(replaceHarga)) {
                            let subTotalHarga = 0
                            $('#tampilanBarang').append(
                                '<tr class="row-table">' +
                                '<td>' + (colom + 0) + '</td>' +
                                '<td class="kodebarang">' + kode_barang + '</td>' +
                                '<td class="namaBarang">' + namaBarang + '</td>' +
                                '<td class="hargabarang">' + hargabarang + '</td>' +
                                '<td class="qyt">' + qty + '</td>' +
                                '<td class="subTotalHarga">' + subTotal + '</td>' +
                                '<td class="aksi"><button class="btn btn-danger deleteval"><i class="bi bi-trash"></i></button></td>' +
                                '</tr>'
                            )
                            $('.subTotalHarga').each(function() {
                                let hargaStr = $(this).text()
                                hargaStr = hargaStr.replace(/[^0-9]/g, '')
                                subTotalHarga += parseFloat(hargaStr);
                            });

                            $('#total').text($.number(subTotalHarga, 0, ',', '.'))
                            $('#kodebarang').val('');
                            $('#namabarang').val('');
                            $('#hargabarang').val('');
                            $('#qyt').val('');


                            let member = $('#member').val()
                            if (member) {
                                $.ajax({
                                    type: "get",
                                    url: "<?= base_url('transaksi/getDiskon') ?>",
                                    dataType: "json",
                                    success: function(response) {
                                        let result = response[0]
                                        let resultDiskon = result.diskon
                                        let resultTotal = $('#total').text()
                                        let harga_total = parseFloat(resultTotal.replace(/\D/g, ""))
                                        let diskon = resultDiskon.replace(/%/g, "")
                                        let resultMinimal = result.minimal_pembelanjaan
                                        let minimal_pembelian = parseFloat(resultMinimal.replace(/\D/g, ""))
                                        if (harga_total >= minimal_pembelian) {
                                            let persenDiskon = diskon / 100
                                            let subTotalDiskon = harga_total * persenDiskon

                                            $('#diskon').text($.number(subTotalDiskon, 0, ',', '.'));
                                            let totalDiskonHarga = harga_total - (harga_total * persenDiskon)
                                            let totalText = $.number(totalDiskonHarga, 0, ',', '.')
                                            $('#total').text(totalText);
                                        }
                                    }
                                });
                            } else {
                                $('#total').text($.number(subTotalHarga, 0, ',', '.'))

                                $('#kodebarang').val('');
                                $('#namabarang').val('');
                                $('#hargabarang').val('');
                                $('#qyt').val('');
                            }
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "Harga",
                                icon: "error"
                            });
                        }
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Jumlah item melebihi stok yang tersedia",
                            icon: "error"
                        });
                    }
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Jumlah item melebihi stok yang tersedia",
                        icon: "error"
                    });
                }
            }
        });
    })

    $('#member').on('change', function() {
        $.ajax({
            type: "get",
            url: "<?= base_url('transaksi/getDiskon') ?>",
            dataType: "json",
            success: function(response) {
                let result = response[0]
                let resultDiskon = result.diskon
                let resultTotal = $('#total').text()
                let harga_total = parseFloat(resultTotal.replace(/\D/g, ""))
                let diskon = resultDiskon.replace(/%/g, "")
                let resultMinimal = result.minimal_pembelanjaan
                let minimal_pembelian = parseFloat(resultMinimal.replace(/\D/g, ""));
                if (harga_total >= minimal_pembelian) {
                    let persenDiskon = diskon / 100
                    let subTotalDiskon = harga_total * persenDiskon

                    $('#diskon').text($.number(subTotalDiskon, 0, ',', '.'));
                    let totalDiskonHarga = harga_total - (harga_total * persenDiskon)
                    let totalText = $.number(totalDiskonHarga, 0, ',', '.')
                    $('#total').text(totalText)
                }
            }
        });
    })
    $('#bayar').on('input', function() {
        let totalText = $('#total').text()
        let pembayaran = $(this).val()

        let replaceTotal = parseFloat(totalText.replace(/\D/g, ""))
        let replacePembayaran = parseFloat(pembayaran.replace(/\D/g, ""))
        if (!isNaN(replaceTotal) && !isNaN(replacePembayaran)) {
            let totalPembayaran = replacePembayaran - replaceTotal;

            let totalPembayaranF = $.number(totalPembayaran, 0, ',', '.')
            let PembayaranF = $.number(replacePembayaran, 0, ',', '.')
            $('#kembalian').text(totalPembayaranF);
            $('#pembayaran').text(PembayaranF);
        }
    })

    $('#simpan').on('click', function() {
        let data = [];
        let namakasir = $('#namakasir').val();
        let nofaktur = $('#nofaktur').val();
        let notransaksi = $('#notransaksi').val();
        let tanggal = $('#tanggal2').val();
        let kodebarang = $('#kodebarang').val();
        let namabarang = $('#namabarang').val();
        let hargabarang = $('#hargabarang').val();
        let member = $('#member').val();
        let total = $('#total').text();
        let pembayaran = $('#pembayaran').text();
        let kembalian = $('#kembalian').text();
        let diskon = $('#diskon').text();
        let jenisPembayaran = $('#jenisPembayaran').val();
        $('#tampilanBarang tr').each(function() {
            let row = {}
            row.kodebarang = $(this).find('.kodebarang').text()
            row.namaBarang = $(this).find('.namaBarang').text();
            row.hargabarang = $(this).find('.hargabarang').text();
            row.qyt = $(this).find('.qyt').text();
            row.totalHarga = $(this).find('.subTotalHarga').text();
            data.push(row)
        })
        $.ajax({
            type: "POST",
            url: "<?= base_url('transaksi/saveTransaksi') ?>",
            data: {
                nama_kasir: namakasir,
                noFaktur: nofaktur,
                noTrans: notransaksi,
                tanggal: tanggal,
                member: member,
                total: total,
                pembayaran: pembayaran,
                kembalian: kembalian,
                diskon: diskon,
                metode: jenisPembayaran,
                data: data
            },
            success: function(response) {
                Swal.fire({
                    title: "Transaksi Berhasil",
                    text: "Transaksi Berhasil Di lakukan",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Cetak Struck"
                }).then((result) => {
                    if (result.isConfirmed) {
                        cetakStrukFromJSON(response.struk);
                        location.reload();
                    }
                });
            },
            error: function(error) {
                console.log(error);
            }
        });

    })

    function cetakStrukFromJSON(strukHTML) {
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write(strukHTML);
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    }
    $('#tampilanBarang').on('click', '.deleteval', function() {
        let row = $(this).closest('tr');
        let hargaStr = row.find('.totalHarga').text();
        hargaStr = hargaStr.replace(/[\D]/g, "");
        let harga = parseFloat(hargaStr);

        let totalHarga = parseFloat($('#total').text().replace(/[\D]/g, ""));
        totalHarga -= harga;
        $('#total').text($.number(totalHarga, 0, ',', '.'))
        row.remove();
    })
</script>