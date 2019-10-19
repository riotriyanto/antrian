<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/vector-map/jqvmap.css">
    <link href="assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css" />
    <title>DISDUKCAPIL KAB. KLATEN</title>
    <style type="text/css">
        .col-xl-3{
            
        }
    </style>
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        <?php include '../api.php'; ?>
        $(document).ready(function(){
            $.ajax({
                    type : "POST",
                    url : "<?php echo $url ?>admin/get_nama_aplikasi.php",
                    dataType : "JSON",
                    data : {},
                    success : function(data){
                    $('#nama_aplikasi').html(data.isi);
                    }
                })
        })
    </script>
</head>
<?php
    session_start();
    if (empty($_SESSION['id_user'])) {
        echo "<script>location='../login.php'</script>";
    }
 ?>
<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top" style="background-image: url('../images/back1.png');">
                <a class="navbar-brand" href="index.php"><font id="nama_aplikasi" style="color: #fff"></font></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                        </li>
                        
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION['nama'] ?></h5>
                                </div>
                                <a class="dropdown-item" href="../logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="nav-left-sidebar sidebar-light" style="background-image: url('../images/back1.png');">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-bars"></i>MENU <span class="badge badge-success"></span></a>
                                <!-- user-circle -->
                                <div id="submenu-1" class="collapse submenu" style="background-color: #fff">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="layanan.php">Manajemen Layanan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="loket.php">Manajemen Loket</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="user.php">Manajemen User</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="waktu.php">Waktu Pelayanan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="teks.php">Teks Berjalan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-cog mr-2"></i>PENGATURAN <span class="badge badge-success"></span></a>
                                <div id="submenu-2" class="collapse submenu" style="background-color: #fff">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="antrian.php">Maksimal Antrian</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="gambar_android.php">Gambar Android</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="gambar_slide.php">Gambar Slide</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="jarak.php">Maksimal Jarak</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="notif.php">Notifikasi Android</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="namaApp.php">Nama Aplikasi</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-2"><i class="fa fa-fw fa-user-circle"></i>Akun <span class="badge badge-success"></span></a>
                                <div id="submenu-3" class="collapse submenu" style="background-color: #fff">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link " href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="dashboard-wrapper">
            <div class="dashboard-finance">
                <div class="container-fluid dashboard-content">
                    
