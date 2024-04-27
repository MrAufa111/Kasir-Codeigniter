<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/boxicons/css/boxicons.css">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/DataTables/datatables.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/DataTables/DataTables-2.0.1/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/fontawesome-free/css/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/dist/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/dist/select2-bootstrap4.css">
    <script src="<?= base_url() ?>assets/js/jquery-3.6.0.js"></script>

    <title><?= $title ?></title>
</head>

<body>
    <div class="swall" data-swall="<?= $this->session->flashdata('success') ?>"></div>
    <div class="error" data-error="<?= $this->session->flashdata('error') ?>"></div>
    <div class="container-fluid">
        <div class="row  col-lg-12">
            <?php $this->load->view('admin/template/sidebar') ?>
            <?php $this->load->view($page) ?>

        </div>
    </div>

    <script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
</body>

</html>