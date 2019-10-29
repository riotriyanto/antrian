<html lang="en">
  <head>
    <!-- keyboardmaster -->
    <link href="<?php echo base_url() ?>assets/css/key/jquery.accent-keyboard.css" rel="stylesheet">

<script src="<?php echo base_url() ?>assets/css/j32.js">
</script>
<script src="<?php echo base_url() ?>assets/css/key/jquery.accent-keyboard.js"></script>
<script type="text/javascript">
  $('.ak-input').accentKeyboard();
</script>
    <!-- end keyboard master -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/virtual_key/jqbtk.min.css">

    <!-- Bootstrap CSS -->
  <!--   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap4.0.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Isi Data</title>
  </head>
  <body>
    <br>
    <div style="width: 100%">
      <img id="gambar" src="<?php echo base_url() ?>assets/images/daftar_antri.png" width="800px;" style="float: right;margin-top: 70px;position: relative;">
      <p style="position: relative; float: right;margin-top: 70px; background-color:#F9F9F9 " class="col-md-7" id="isi_syarat"></p>
    </div>
    <!-- <div style="position: relative;width: 100%" id="t_syarat">
      <p style="float: right;margin-top: 80px; background-color:#F9F9F9 " class="col-md-7" id="isi_syarat"></p>
    </div> -->
    <div class="row" style="position: relative;">
      <div class="col-md-5" style="padding-left: 5%;position: fixed;">
        <font>Anda memilih layanan</font>
        <h3><?php echo $this->session->userdata('nama_layanan') ?></h3><br><br><br><br>
        <!-- <form action="ambil_antrian.php" method="POST"> -->
          <?php echo form_open('welcome/ambilAntrian') ?>
          <div class="form-group">
            <input type="hidden" name="id_layanan" value="<?php echo $this->session->userdata('id_layanan') ?>">
            <input style="border-left:none;border-top:none;border-right:none;" type="text" maxlength="16" name="NIK" id="NIK" placeholder="NIK" class="form-control" required>
            <font id="p_nik" style="color: red; font-weight: bold;font-size: 10px;">NIK harus 16 digit &nbsp;&nbsp;&nbsp; <font id="c"></font>/16</font>
          </div><br>
          <div class="form-group">
            <input style="border-left:none;border-top:none;border-right:none;" type="text" name="nama" id="nama" placeholder="Nama" class="form-control ak-input" required>
          </div><br>
          <div class="form-group">
            <input style="border-left:none;border-top:none;border-right:none;" type="text" name="no_telp" id="no_telp" placeholder="No. Telepon" class="form-control">
          </div><br>
          <button type="submit" name="btn" class="btn btn-primary" style="background-color: #01FBCE;border: none">Ambil Antrian</button>&nbsp;&nbsp;&nbsp;
        <a href="index.php" style="color: #01FBCE">Kembali</a>
        </form>
      </div>
      <div class="col-md-7" style="padding-right: 10%;float: right;">
        <div class="row" style="float: right;position: fixed;margin-left: 87%;">
          <button type="button" id="syarat" class="btn btn-info" style="background-color: #01FBCE;border: none;width: 130px;float: right;">Syarat</button>
          <button type="button" id="syarat2" class="btn btn-info" style="background-color: #01FBCE;border: none;width: 130px;float: right;">Syarat</button>
        </div>

      </div>
    </div>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url() ?>assets/css/j3.js"></script>
    <!-- <script src="jquery.min.js"></script> -->
    <!-- <script src="<?php echo base_url() ?>assets/css/popper.js" ></script> -->
    <script src="<?php echo base_url() ?>assets/css/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?php echo base_url() ?>assets/css/virtual_key/jqbtk.min.js"></script>
    
    <script type="text/javascript">
      // $('#NIK').keyboard({type:'tel'});
    // $('#nama').keyboard({initCaps:true});
    // $('#no_telp').keyboard({type:'tel'});

      $(document).ready(function(){
        $('#syarat2').css("display","none");
        $('#isi_syarat').css("display","none");
        $('#syarat').on("click", function(){
          $('#gambar').css("display", "none");
          $('#isi_syarat').css("display", "inline");
          $('#syarat2').css("display","inline");
          $('#syarat').css("display","none");
        })
        $('#syarat2').on("click", function(){
          $('#gambar').css("display", "inline");
          $('#isi_syarat').css("display", "none");
          $('#syarat2').css("display","none");
          $('#syarat').css("display","inline");
        })

        syarat();
        function syarat(){
          var id_layanan = "<?php echo $this->session->userdata('id_layanan') ?>";
          $.ajax({
            type   : 'POST',
            url    : '<?=$api ?>get_layanan_by_id.php',
            dataType : "JSON",
            data : {id_layanan:id_layanan},
            success : function(data){
              // console.log(data[0].syarat);
              $('#isi_syarat ').html(data[0].syarat);
            }
          })
        }
        // 
        function checknik (){
          $("#p_nik").css("display","inline");
          var nik = $('#NIK').val();
          $("#c").html(nik.length);
          if (nik.length != 16) {
            $("#NIK").css("background-color", "pink");
          }else{
            $("#NIK").css("background-color", "#fff");
            $("#p_nik").css("display","none");
          }
        $.ajax({
          url : "<?=$api ?>get_penduduk.php",
          type : "POST",
          dataType : "JSON",
          data : {nik:nik},
          success : function(data){
            console.log(data);
            if (data.length > 0) {
              $("#nama").val(data[0].nama);
              $("#no_telp").val(data[0].no_telp);
            }else{
              $("#nama").val("");
              $("#no_telp").val("");
            }
          }
        })
      }

      $("#p_nik").css("display","none");
        $("#NIK").on("keypress keyup blur", function(event){
          $(this).val($(this).val().replace(/[^\d].+/, ""));
          if ((event.which < 48 || event.which > 57)) {
                  event.preventDefault();
              }
              checknik();
              
        })
        $("#NIK").on('click', checknik);
      })
    </script>
  </body>
</html>
<!DOCTYPE html>
<html>
<head>
  <title>t</title>
  <link href="<?php echo base_url() ?>assets/css/key/jquery.accent-keyboard.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.2.1.min.js">
</script>
<script src="<?php echo base_url() ?>assets/css/key/jquery.accent-keyboard.js"></script>

</head>
<body>
<script type="text/javascript">
  $('.ak-input').accentKeyboard({active_caps:true,active_shift: false,layout:'es_ES'
});
  $('#NIK').accentKeyboard({active_caps:false,active_shift: false,layout:'es_ES'
});
  $('#no_telp').accentKeyboard({active_caps:false,active_shift: false,layout:'es_ES'
});
</script>
</body>
</html>