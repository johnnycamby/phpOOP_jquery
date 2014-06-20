<!doctype html>

<html lang="en">
    <head>
        <title>Test</title>

        <link href="<?= base_url() ?>public/third-party/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= base_url() ?>public/css/style.css" rel="stylesheet"/>


        <script src="<?= base_url() ?>public/third-party/js/jquery.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>public/third-party/js/bootstrap.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>public/js/dashboard/result.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>public/js/dashboard/event.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>public/js/dashboard/template.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>public/js/dashboard.js" type="text/javascript"></script>

        <script>

            $(function() {

                /* Init the Dashboard Application*/
                var dashboard = new Dashboard();
            });
        </script>

    </head>
    <body>

<!--        <nav class="navbar">
            <div class="navbar-inner">
                <span class="brand">jrDash</span>
                <ul class="nav">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">User</a></li>
                    <li><a href="<?= site_url('dashboard/logout') ?>">Logout</a></li>
                </ul>
            </div>
        </nav> -->


        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <span class="brand">jrDash</span>
                <ul class="nav">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">User</a></li>
                    <li><a href="<?= site_url('dashboard/logout') ?>">Logout</a></li>
                </ul>
                </div>
            </div>
        </div>

        <!-- start wrapper -->
        <div class="wrapper">
            
            <!-- Goto styles to make this div not appear on the page-->
            <div id="error" class="alert alert-error hide"></div>
            <div id="success" class="alert alert-success hide"></div>
            