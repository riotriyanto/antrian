<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo base_url() ?>/assets/css/loket_style.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/assets/css/loket_style2.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">

<link href="<?php echo base_url() ?>/assets/css/loket_style3.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/assets/css/loket_style4.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Pilih Loket</title>

 <!-- Image and text -->
<!-- <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="../images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    DISDUKCAPIL KAB. KLATEN
  </a>
  <a style="float: right;" href="logout.php"><button class="btn btn-sm btn-danger" style="margin-left: 10px;margin-top: 7px;">Keluar</button></a>
</nav> -->
          <div class="container">
          <div class="row">
          <div class="span12"><br>
            <div class="row">
                <div class="col-md-12" style="margin-top: -20px;">
                    <font style="font-size: 30px;">Selamat datang, <?php echo $_SESSION['nama']; ?></font>
                    <a style="float: right;" href="<?php echo base_url() ?>cs/logout"><button class="btn btn-sm btn-danger" style="margin-left: 10px;margin-top: 7px;">Keluar</button></a>
                </div>
            </div>
            <?php if ($this->session->flashdata('warning')):  ?>
                    <div class="alert alert-warning">  
                       <a href="#" class="close" data-dismiss="alert">&times;</a>  
                       <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>  
                     </div>
                <?php endif; ?>
          <div class="widget-header" style="">
          <h3 style="padding: 7px;"> Pilih Loket</h3></div>
            <!-- /widget-header -->
                        <?php 
                            $url = $api;
                            $content =     file_get_contents($url."get_loket.php");
                            // print_r($content);
                            $data = json_decode($content, true);
                            $j=1;
                            $h=1;
                            $n=4;
                            echo "<div class='widget-content'><div id='big_stats' class='cf'>";
                            foreach($data as $d =>$value){
                                if ($value['status'] == "aktif") {
                                    $d = "";                                    
                                    $btn = "btn-danger";
                                }else{
                                    $d = site_url('cs/transLoket');
                                    $btn = "btn-success";
                                }
                                    echo "
                                                
                                            <form class='stat value' method ='POST' action='".$d."'>
                                            	<input type='hidden' name='id_loket' value='".$value['id_loket']."'>
                                                <input type='hidden' name='nomor_loket' value='".$value['nomor_loket']."'>
                                            	<input style='color:white' class='value btn ".$btn."' type='submit' name='kirim' value='".$value['nomor_loket']."'>
                                            </form>
                                        
                                    ";
                                    while ($j == $n) {
                                        $j =0;
                                        echo "
                                            </div>
                                            </div>
                                            <div class='widget-content'>
                                            <div id='big_stats' class='cf'>
                                        ";
                                    }
                                    $j++;
                            }
                            echo "</div><div>";
                         ?> 
          <!-- /widget -->
            <!-- /widget-header -->
