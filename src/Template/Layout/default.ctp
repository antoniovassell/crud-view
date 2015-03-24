<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?php
    echo $this->Html->css([
        '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
        'http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css',
        '/adminlte/dist/css/AdminLTE.min.css',
        '/adminlte/dist/css/skins/skin-black.min.css',
        '/adminlte/plugins/iCheck/all.css',
        '/adminlte/plugins/timepicker/bootstrap-timepicker.min.css',
        '/adminlte/plugins/iCheck/all.css',
        '/adminlte/plugins/daterangepicker/daterangepicker-bs3.css',
        '/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        '/adminlte/plugins/datatables/dataTables.bootstrap.css',
        '/adminlte/plugins/daterangepicker/daterangepicker-bs3.css',
    ]);
    ?>
    <!--[if lt IE 9]>
    <?php
        echo $this->Html->script([
    'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js',
    'https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'
    ]);
    ?>
    <![endif]-->
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="skin-black">
<div class="wrapper">
    <?= $this->element('Admin/header'); ?>
    <?= $this->element('Admin/sidebar'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $this->get('title'); ?>
            </h1>
            <?= $this->element('Admin/breadcrumbs'); ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php echo $this->element('Admin/menu_actions'); ?>
            <?= $this->fetch('content'); ?>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?= $this->element('Admin/footer'); ?>
</div><!-- ./wrapper -->
</div>
<?php
echo $this->Html->script([
    '/adminlte/plugins/jQuery/jQuery-2.1.3.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js',
    '/adminlte/plugins/input-mask/jquery.inputmask.js',
    '/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js',
    '/adminlte/plugins/input-mask/jquery.inputmask.extensions.js',
    '/adminlte/plugins/daterangepicker/daterangepicker.js',
    '/adminlte/plugins/timepicker/bootstrap-timepicker.min.js',
    '/adminlte/plugins/slimScroll/jquery.slimscroll.min.js',
    '/adminlte/plugins/iCheck/icheck.min.js',
    '/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
    '/adminlte/plugins/fastclick/fastclick.min.js',
    '/adminlte/plugins/datatables/dataTables.bootstrap.js',
    '/adminlte/dist/js/app.min.js',
    '/adminlte/plugins/input-mask/jquery.inputmask.js',
    '/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js',
    '/adminlte/plugins/input-mask/jquery.inputmask.extensions.js',
    '/adminlte/plugins/daterangepicker/daterangepicker.js',
    'admin/app.js'
]);
echo $this->fetch('script');
?>
</body>
</html>
