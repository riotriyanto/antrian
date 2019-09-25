<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="../css/loket_style.css" rel="stylesheet">
<link href="../css/loket_style2.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="../css/font-awesome.css" rel="stylesheet">
<link href="../css/loket_style3.css" rel="stylesheet">
<link href="../css/loket_style4.css" rel="stylesheet">
<?php
session_set_cookie_params(3600,"/");
  session_start();
    if (empty($_SESSION['nomor_loket'])) {
      echo "<script>location='logout.php'</script>";
    }
  ?>
<div class="main">
    <div class="main-inner">
        <div class="container">
          <div class="row">     
            <div class="span12"><br>
              <div class="row">
              </div>      
                <div class="widget ">
                  <font style="font-size: 30px;">Hai <b><?php echo $_SESSION['nama'] ?></b>, anda berada di Loket <b><?php echo $_SESSION['nomor_loket']; ?></b></font><a href="logout.php"><button id="keluar" class="btn btn-danger" style="float: right;margin-top: 6px;"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Keluar</button></a><br><br>
                <div class="widget-header" style="padding-top: 15px;padding-left: 7px;">
                <h3>Layanan <?php echo $_POST['jenis_layanan']; ?></h3>
                </div> <!-- /widget-header -->
                <div class="widget-content">
                  <a href="layanan.php"><button class="btn btn-info" id="pilih">Pilih Layanan</button></a>
                <div class="tabbable">          
                <br>
                <!-- menambahkan layanan -->
              <div class="widget-content">
              <div id="big_stats" class="cf">          
              <div class="tabbable">
              <div class="tab-content">
                <div class="stat"><span id="nomor_antrian" class="value"></span><br><br>
                    <button id="recall" class="button btn btn-warning">Panggil Ulang</button>
                    <button id="next" class="button btn btn-success">Selanjutnya</button></div>
                <div  id="edit-profile2" class="form-horizontal" method="post" action="">
                <fieldset>                
                      <div class="control-group">                     
                      <label class="control-label" for="nik">NIK Pelanggan</label>
                      <div class="controls" id="NIK" style="font-weight: bold; margin-top: 4px;">
                      <!--<input type="text" class="span3" name="nik" value="">-->
                        
                      </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                      <label class="control-label" for="nama" style="margin-left: 15px;">Nama Pelanggan</label>
                      <div class="controls" id="nama" style="font-weight: bold; margin-top: 4px;">
                      <!--<input type="text" class="span3" name="nik" value="">-->
                        
                      </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                      
                      <label class="span2"  for="status"></label>
                      <input id="simpan" type="submit" value="SIMPAN" button class="button btn btn-info"></button>
                      <input id="hangus" type="submit" value="LEWATI" button class="button btn btn-danger"></button>
                      </div> <!-- /controls -->       
                      </div> <!-- /control-group -->                                                         
                </fieldset>                  
            </div>
            </div>
            </div>
            <!-- /widget-content -->            
            <div class="tab-content">
            <div class="tab-pane" id="formcontrols">                    
            </div>
            </div>
            </div>
                    </div> <!-- /widget-content -->                 
                </div> <!-- /widget -->             
            </div> <!-- /span8 -->
          </div> <!-- /row -->  
        </div> <!-- /container -->      
    </div> <!-- /main-inner -->  
</div> <!-- /main -->
<audio src="" class="speech" hidden></audio>
<?php include '../api.php'; ?>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#recall').css("display", "none");
      $('#simpan').css("display", "none");
      $('#hangus').css("display", "none");

      $('#next').on('click', function(){
        var id_layanan = "<?php echo $_POST['id_layanan'] ?>";
        var id_loket = "<?php echo $_SESSION['id_loket'] ?>";
        if (id_loket==""){
          location='logout.php'
        }else{
          $.ajax({
            type : 'POST',
            url :"<?php echo $url ?>cs/cs_panggil_antrian.php",
            dataType : 'JSON',
            data : {id_layanan:id_layanan, id_loket:id_loket},
            success : function(data){
              $('#NIK').html(data.nik);
              $('#nama').html(data.nama);
              window.narasi = data.narasi;
              window.nik=data.nik;
              window.id_nomor=data.id_nomor;
              window.kode_layanan=data.kode_layanan;
              window.no_antrian=data.nomor_antrian;
              $('#nomor_antrian').html(data.kode_layanan+data.nomor_antrian);
              $('#pilih').css("display", "none");
              $('#keluar').css("display", "none");
              $('#hangus').css("display", "inline");
              $('#simpan').css("display", "inline");
              $('#recall').css("display", "inline");
              $('#next').css("display", "none");
            }
          })
        }
      })

      $('#recall').on('click', function(){
        var narasi = window.narasi;
          $.ajax({
            type : 'POST',
            url :"<?php echo $url ?>cs/cs_panggil_ulang.php",
            dataType : 'JSON',
            data : {narasi:narasi},
            success : function(data){
              alert("Pemanggilan ulang nomor antrian "+window.kode_layanan+window.no_antrian);
            }
          })
      })
      $('#simpan').on('click', function(){
        var id_layanan = "<?php echo $_POST['id_layanan'] ?>";
        var nik = window.nik;
        var id_user_cs = "<?php echo $_SESSION['id_user'] ?>";
        var id_loket = "<?php echo $_SESSION['id_loket'] ?>";
        var no_antrian = window.no_antrian;
        var id_nomor = window.id_nomor;
        // alert(no_antrian);
        $.ajax({
          type : 'POST',
          url : "<?php echo $url ?>cs/simpan_transaksi.php",
          dataType : "JSON",
          data : {id_layanan:id_layanan, nik:nik, id_user_cs:id_user_cs, id_loket:id_loket, no_antrian:no_antrian, id_nomor:id_nomor},
          success : function(data){
            console.log(data);
            if (data.success == 1) {
                alert(data.pesan);
            }else{
              $('#simpan').css("display", "none");
              $('#hangus').css("display", "none");
              $('#recall').css("display", "none");
              $('#pilih').css("display", "inline");
              $('#keluar').css("display", "inline");
              $('#next').css("display", "inline");
            }
          }
        })
      })
      $('#hangus').on('click', function(){
        var id_layanan = "<?php echo $_POST['id_layanan'] ?>";
        var nik = window.nik;
        var id_user_cs = "<?php echo $_SESSION['id_user'] ?>";
        var id_loket = "<?php echo $_SESSION['id_loket'] ?>";
        var no_antrian = window.no_antrian;
        var id_nomor = window.id_nomor;

        // alert(id_nomor);
        $.ajax({
          type : 'POST',
          url : "<?php echo $url ?>cs/simpan_transaksi_hangus.php",
          dataType : "JSON",
          data : {id_layanan:id_layanan, nik:nik, id_user_cs:id_user_cs, id_loket:id_loket, no_antrian:no_antrian, id_nomor:id_nomor},
          success : function(data){
            console.log(data);
            if (data.success == 1) {
                alert(data.pesan);
            }else{
              $('#simpan').css("display", "none");
              $('#hangus').css("display", "none");
              $('#recall').css("display", "none");
              $('#pilih').css("display", "inline");
              $('#keluar').css("display", "inline");
              $('#next').css("display", "inline");
            }
          }
        })
      })
  })
</script>

