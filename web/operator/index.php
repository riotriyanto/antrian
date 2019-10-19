<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="../css/loket_style.css" rel="stylesheet">
	<link href="../css/loket_style2.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
	        rel="stylesheet">
	<link href="../css/font-awesome.css" rel="stylesheet">
	<link href="../css/loket_style3.css" rel="stylesheet">
	<link href="../css/loket_style4.css" rel="stylesheet">
	<title>Operator DISDULCAPIL KLATEN</title>
</head>
<?php
    session_start();
    if (empty($_SESSION['id_user'])) {
        echo "<script>location='../login.php'</script>";
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
                  <font style="font-size: 30px;">Hai <b><?php session_start(); echo $_SESSION['nama'] ?></b></font><a href="../logout.php"><button id="keluar" class="btn btn-danger" style="float: right;margin-top: 6px;"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Keluar</button></a><br><br>
                <div class="widget-header" style="padding-top: 15px;padding-left: 7px;">
                <h3>Pemberitahuan berkas jadi</h3>
                </div> <!-- /widget-header -->
                <div class="widget-content">
                <div class="tabbable">          
                <br>
                <!-- menambahkan layanan -->
              <div class="widget-content">
              <div id="big_stats" class="cf">          
              <div class="tabbable">
              <div class="tab-content">
                <div class="stat"><span id="" class="value"></span><br><br>
                    <form>
                      <label>Masukan Nomor Antrian</label>
                      <input type="text" name="nomor_antrian" id="nomor_antrian" class="form-control" style="height: 30px;" placeholder="Masukkan Nomor Antrian"><br>
                      <font style="font-size: 10px;font-weight: bold;color: red" id="p_a"></font>
                    </form>
                  </div>
                <div  id="edit-profile2" class="form-horizontal" method="post" action="">
                <fieldset>                
                      <div class="control-group">                     
                      <label class="control-label" for="nik" style="font-weight: bold; margin-top: 60px;">Catatan Tambahan</label>
                      <div class="controls" id="NIK" style="font-weight: bold; margin-top: 54px;">
                        <form>
                          <textarea name="pesan" id="pesan" class="form-control" style="width: 500px;"></textarea>
                        </form>
                        
                      </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                      
                      <label class="span2"  for="status"></label>
                      <input id="kirim" type="submit" value="KIRIM" style="margin-left: 160px;" button class="button btn btn-info"></button>
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
  	$('#p_a').css("display", "none");
    $('#kirim').on('click', function(){
    	$('#p_a').css("display", "none");
    	$('#nomor_antrian').css("background-color", "#fff");
      var nomor_antrian= $('#nomor_antrian').val();
      var kode = nomor_antrian.toUpperCase();
      var kode_layanan = kode.substr(0,1);
      var nomor = nomor_antrian.substr(1,1);
      var pesan = document.getElementById("pesan").value
      // alert(pesan);
      $.ajax({
        url : "http://103.100.27.19/api_antrian/operator/pemberitahuan.php",
        type : "POST",
        dataType : "JSON",
        data : {kode_layanan:kode_layanan, nomor:nomor, pesan:pesan},
        success : function(data){
          console.log(data);
          if (data.status) {
            $('#nomor_antrian').val('');
            $("textarea#pesan").val('');
          }else{
            $('#nomor_antrian').css("background-color", "pink");
            // alert(data.pesan);
            $('#p_a').css("display", "inline");
            $('#p_a').html(data.pesan);
          }
        }
      })
    })
  })
</script>
