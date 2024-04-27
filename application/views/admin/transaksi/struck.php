<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">
    <title>Cetak Nota</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-size: 15px;
            font-family: monospace;
        }

        .sheet {
            margin: auto;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
            page-break-after: always;
        }


        body.struk .sheet {
            padding: 2mm;
            width: 90mm;
            background: white;
            color: black;
            box-shadow: 0 .5mm 2mm rgba(0, 0, 0, .3);

        }

        /*.txt-left {
            text-align: left;
        }

        .txt-center {
            text-align: center;
        }

        .txt-right {
            text-align: right;
        }

        @media screen {
            body {
                background: #e0e0e0;
                font-family: monospace;
            }

            .sheet {
                background: white;
                box-shadow: 0 .5mm 2mm rgba(0, 0, 0, .3);
                margin: auto;

            }
        } */

        /** Fix for Chrome issue #273306 **/
        @media print {
            body {
                font-family: monospace;
            }

            body.struk {
                text-align: left;
            }

            .txt-left {
                text-align: left;
            }

            .txt-center {
                text-align: center;
            }

            .txt-right {
                text-align: right;
            }

            /* .print-section {
                display: flex;
                flex-direction: column;
                justify-content: center;
                justify-items: center;
                align-items: center;
                margin-left: auto;
            } */
        }
    </style>
</head>

<?php $toko = $this->db->get_where('masterToko', ['id' => '1'])->row_array(); ?>

<body class="struk  justify-content-center d-flex">
    <div class="">
        <section class="sheet  ">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td><?= $toko['nama_toko']; ?></td>
                </tr>
                <tr>
                    <td><?= $toko['alamat']; ?></td>
                </tr>
                <tr>
                    <td>Telp: <?= $toko['no_telp']; ?></td>
                </tr>
            </table>

            <?= str_repeat("=", 40) ?><br />
            <table cellpadding="0" cellspacing="0" style="width:100%">
                <tr>
                    <td align="left" class="txt-left">Nota&nbsp;</td>
                    <td align="left" class="txt-left">:</td>
                    <td align="left" class="txt-left">&nbsp;<?= $data_transaksi['no_faktur']; ?></td>
                </tr>
                <tr>
                    <td align="left" class="txt-left">Kasir</td>
                    <td align="left" class="txt-left">:</td>
                    <td align="left" class="txt-left">&nbsp;<?= $data_transaksi['nama_kasir']; ?></td>
                </tr>
                <tr>
                    <td align="left" class="txt-left">Tgl.&nbsp;</td>
                    <td align="left" class="txt-left">:</td>
                    <td align="left" class="txt-left">&nbsp;<?= $data_transaksi['tanggal']; ?></td>
                </tr>

            </table>
            <?= str_repeat("=", 40) ?><br />
            <table cellpadding="0" cellspacing="0" style="width:100%">
                <tr>
                    <td align="left" class="txt-left" width="50%">Item</td>
                    <td align="left" class="txt-left">Qty</td>
                    <td align="left" class="txt-left">Harga</td>
                    <td align="left" class="txt-left">Total</td>
                </tr>
                <?php foreach ($data_barang as $b) : ?>
                    <tr>
                        <td align="left" class="txt-left"><?= $b['nama_barang']; ?></td>
                        <td align="left" class="txt-left"><?= $b['qyt']; ?></td>
                        <td align="left" class="txt-left"><?= $b['harga_barang']; ?></td>
                        <td align="left" class="txt-left"><?= $b['harga_total_barang']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br />
            <table cellpadding="0" cellspacing="0" style="width:100%">
                <tr>
                    <td align="left" class="txt-left" width="80%">Metode Pembayaran</td>
                    <td align="left" class="txt-left"><?= $data_transaksi['metode_pembayaran']; ?></td>
                </tr>
                <tr>
                    <td align="left" class="txt-left" width="80%">Pembayaran</td>
                    <td align="left" class="txt-left"><?= $data_transaksi['pembayaran']; ?></td>
                </tr>
                <tr>
                    <td align="left" class="txt-left" width="80%">Kembalian</td>
                    <td align="left" class="txt-left"><?= $data_transaksi['kembalian']; ?></td>
                </tr>
                <tr>
                    <td align="left" class="txt-left">Diskon</td>
                    <td align="left" class="txt-left"><?= $data_transaksi['diskon']; ?></td>
                </tr>

                <tr>
                    <td align="left" class="txt-left">Grand&nbspTotal</td>
                    <td align="left" class="txt-left"><?= $data_transaksi['total']; ?></td>
                </tr>
            </table>
            <br />
            <p>Terima kasih atas kunjungan anda</p>
            <br /><br /><br /><br />
        </section>
    </div>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.js"></script>
</body>

</html>