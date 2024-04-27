<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.css">
    <script src="<?= base_url() ?>assets/js/jquery-3.6.0.js"></script>
    <title><?= $title ?></title>
</head>

<body>

    <?php $this->load->view($page); ?>

    <script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
</body>

</html>