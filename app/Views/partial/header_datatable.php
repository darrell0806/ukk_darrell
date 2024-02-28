<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    
    <link rel="stylesheet" href="<?=base_url('assets/compiled/css/app.css')?>" />
    <link rel="stylesheet" href="<?=base_url('assets/compiled/css/app-dark.css')?>" />

    <!-- Favicon -->
    <?php 
    $db = \Config\Database::connect();
    $builder = $db->table('website');
    $logo = $builder->select('favicon_website')
    ->where('deleted_at', null)
    ->get()
    ->getRow();

    ?>
<link
      rel="shortcut icon"
      href="<?php echo base_url('assets/compiled/svg/obor.png')?>"
      type="image/x-icon"
    />
    <link
      rel="shortcut icon"
      href="<?php echo base_url('assets/compiled/svg/obor.png')?>"
      type="image/png"
    />


    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?=base_url('assets/extensions/@fortawesome/fontawesome-pro/css/all.min.css')?>">

    <!-- Datatables -->
    <link rel="stylesheet" href="<?=base_url('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/compiled/css/table-datatable-jquery.css')?>">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/custom/custom_style.css')?>">

    <!-- File Uploader -->
    <link rel="stylesheet" href="<?=base_url('assets/extensions/filepond/filepond.css')?>" />
    <link rel="stylesheet" href="<?=base_url('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css')?>"
    />
    <link rel="stylesheet" href="<?=base_url('assets/extensions/toastify-js/src/toastify.css')?>"
    />

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?=base_url('assets/extensions/sweetalert2/sweetalert2.min.css')?>"/>
    <link
      rel="stylesheet"
      href="<?=base_url('assets/extensions/choices.js/public/assets/styles/choices.css')?>"
    />
    <style>
        @media print {
            @page {
                margin-top: 30px;
                margin-bottom: 10px;
            }
        }
    </style>

    <link
      rel="stylesheet"
      href="<?php echo base_url('assets/extensions/flatpickr/flatpickr.min.css')?>"/>

</head>

<body>