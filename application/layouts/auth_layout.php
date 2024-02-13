<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Antrian Pelayanan dan Persidangan Pengadilan Agama Jakarta Utara.">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon/') ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon/') ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon/') ?>/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url('assets/favicon/') ?>/site.webmanifest">
    <title>Login | APDP - PAJU</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <?php $this->addons->css() ?>
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?= base_url() ?>assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/responsive.css">
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <?= $page ?>
        <!-- latest jquery-->
        <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
        <!-- Bootstrap js-->
        <script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
        <!-- feather icon js-->
        <script src="<?= base_url() ?>assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="<?= base_url() ?>assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="<?= base_url() ?>assets/js/config.js"></script>
        <!-- Plugins JS start-->
        <?php $this->addons->js() ?>
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="<?= base_url() ?>assets/js/script.js"></script>
    </div>
</body>

</html>