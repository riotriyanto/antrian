<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo base_url() ?>assets/css/loket_style.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/loket_style2.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/loket_style3.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/loket_style4.css" rel="stylesheet">
<title>Panggil Antrian</title>
<div class="main">
    <div class="main-inner">
        <div class="container">
          <div class="row">     
            <div class="span12"><br>
              <div class="row">
              </div>      
                <div class="widget ">
                  <font style="font-size: 30px;">Hai <b><?php echo $this->session->userdata('nama') ?></b>, anda berada di Loket <b><?php echo $this->session->userdata('nama_loket'); ?></b></font><a href="<?php echo base_url() ?>cs/logout"><button id="keluar" class="btn btn-danger" style="float: right;margin-top: 6px;"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Keluar</button></a><br><br>
                <div class="widget-header" style="padding-top: 15px;padding-left: 7px;">
                <h3>Layanan <?php echo $this->session->userdata('jenis_layanan'); ?></h3>
                </div> <!-- /widget-header -->
                <div class="widget-content">
                  <a href="<?php echo base_url() ?>cs/layanan"><button class="btn btn-info" id="pilih">Pilih Layanan</button></a>
                <div class="tabbable">          
                <br>
                <!-- menambahkan layanan -->
              <div class="widget-content">
              <div id="big_stats" class="cf">          
              <div class="tabbable">
              <div class="tab-content">
                <div class="stat"><span id="nomor_antrian" class="value nomor_antrian"></span><br><br>
                    <button id="recall" class="button btn btn-warning">Panggil Ulang</button>
                    <button id="next" class="button btn btn-success">Selanjutnya</button></div>
                <div  id="edit-profile2" class="form-horizontal" method="post" action="">
                <fieldset>                
                      <div class="control-group">                     
                      <label class="control-label" for="nik">NIK Pelanggan</label>
                      <div class="controls NIK" id="NIK" style="font-weight: bold; margin-top: 4px;">
                      <!--<input type="text" class="span3" name="nik" value="">-->
                        
                      </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                      <label class="control-label" for="nama" style="margin-left: 15px;">Nama Pelanggan</label>
                      <div class="controls nama" id="nama" style="font-weight: bold; margin-top: 4px;">
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    console.log("js run");
      $('#recall').css("display", "none");
      $('#simpan').css("display", "none");
      $('#hangus').css("display", "none");
      // $('#NIK').html("test");

      $('#next').on('click', function(){
        // alert("test");
        var id_layanan = "<?php echo $this->session->userdata('id_layanan') ?>";
        var id_loket = "<?php echo $this->session->userdata('id_loket') ?>";
        if (id_layanan==""){
          location='<?php echo base_url() ?>cs/layanan';
        }
        if (id_loket==""){
          location='<?php echo base_url() ?>cs';
        }else{
          $.ajax({
            type : 'POST',
            url :"<?=$api ?>cs/cs_panggil_antrian.php",
            dataType : 'JSON',
            data : {id_layanan:id_layanan, id_loket:id_loket},
            success : function(data){
              console.log(data);
              $('.NIK').html(data.nik);
              $('.nama').html(data.nama);
              window.narasi = data.narasi;
              window.nik=data.nik;
              window.id_nomor=data.id_nomor;
              window.kode_layanan=data.kode_layanan;
              window.no_antrian=data.nomor_antrian;
              $('.nomor_antrian').html(data.kode_layanan+data.nomor_antrian);
              $('#pilih').css("display", "none");
              $('#keluar').css("display", "none");
              $('#hangus').css("display", "inline");
              $('#simpan').css("display", "inline");
              $('#recall').css("display", "inline");
              $('#next').css("display", "none");
            },
            error : function(data){
              console.log(data);
              alert("Gagal terhubung ke server");
            }
          })
        }
      })

      $('#recall').on('click', function(){
        var narasi = window.narasi;
          $.ajax({
            type : 'POST',
            url :"<?=$api ?>cs/cs_panggil_ulang.php",
            dataType : 'JSON',
            data : {narasi:narasi},
            success : function(data){
              alert("Pemanggilan ulang nomor antrian "+window.kode_layanan+window.no_antrian);
            }
          })
      })
      $('#simpan').on('click', function(){
        var id_layanan = "<?php echo $this->session->userdata('id_layanan') ?>";
        var nik = window.nik;
        var id_user_cs = "<?php echo $this->session->userdata('id_user') ?>";
        var id_loket = "<?php echo $this->session->userdata('id_loket') ?>";
        var no_antrian = window.no_antrian;
        var id_nomor = window.id_nomor;
        // alert(no_antrian);
        $.ajax({
          type : 'POST',
          url : "<?=$api ?>cs/simpan_transaksi.php",
          dataType : "JSON",
          data : {id_layanan:id_layanan, nik:nik, id_user_cs:id_user_cs, id_loket:id_loket, no_antrian:no_antrian, id_nomor:id_nomor},
          success : function(data){
            console.log(data);
            if (data.success == 1) {
                alert(data.pesan);
            }else{
              
            }
            $('#simpan').css("display", "none");
              $('#hangus').css("display", "none");
              $('#recall').css("display", "none");
              $('#pilih').css("display", "inline");
              $('#keluar').css("display", "inline");
              $('#next').css("display", "inline");
          }
        })
      })
      $('#hangus').on('click', function(){
        var id_layanan = "<?php echo $this->session->userdata('id_layanan') ?>";
        var nik = window.nik;
        var id_user_cs = "<?php echo $this->session->userdata('id_user') ?>";
        var id_loket = "<?php echo $this->session->userdata('id_loket') ?>";
        var no_antrian = window.no_antrian;
        var id_nomor = window.id_nomor;
        var ket = "";

        // alert(id_nomor);
        $.ajax({
          type : 'POST',
          url : "<?=$api ?>cs/simpan_transaksi_hangus.php",
          dataType : "JSON",
          data : {id_layanan:id_layanan, nik:nik, id_user_cs:id_user_cs, id_loket:id_loket, no_antrian:no_antrian, id_nomor:id_nomor, ket:ket},
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

