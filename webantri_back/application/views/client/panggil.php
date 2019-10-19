<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <title id="title"></title>
    <style type="text/css">
      .it{
        /*padding-left: 13px;*/
        text-align: center;
        padding-top: 8px;
        color: #fff;
        font-weight: bold;
      }
    </style>
  </head>
  <body style="font-family: roboto">
    <div id="img" style="position: fixed;width: 100%">
      <img style="float: right;" src="<?php echo base_url() ?>assets/images/gambar_clinet.png" width="500px">
      <img style="float: right;position: fixed;margin-left: 92%;margin-top: 3%" src="<?php echo base_url() ?>assets/images/LOGO.png" width="50px">
    </div>
    <br>
    <div class="container" style="position: relative;">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div style="background-color: #05FE8F;width: 25px;border-radius: 50%;">&nbsp;</div>&nbsp; Antrian Terlayani&nbsp;&nbsp;&nbsp;
            <div style="background-color: #FA238C;width: 25px;border-radius: 50%;">&nbsp;</div>&nbsp; Antrian Belum Terlayani&nbsp;&nbsp;&nbsp;
            <div style="background-color: #2082E3;width: 25px;border-radius: 50%;">&nbsp;</div>&nbsp; Jumlah Antrian&nbsp;&nbsp;&nbsp;
            <div style="background-color: #FCBB00;width: 25px;border-radius: 50%;">&nbsp;</div>&nbsp; Antrian Dilayani Saat Ini&nbsp;&nbsp;&nbsp;
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 10%">
        <div class="col-md-8" style="margin-left: -20px">
          <h1 id="nama_app"></h1>
          <!-- <h1 id="nama_app">DINAS  KEPENDUDUKAN DAN CATATAN SIPIL KABUPATEN KLATEN</h1> -->
          <P style="font-size: 24px"></P>
        </div>
      </div>
      <div class="row" style="margin-top: 5%">
        <div class="col-md-12">
          <div class="row">
            <p>(*)SEMUA LAYANAN ADMINDUK GRATIS</p>
          </div>
          <div class="row">&nbsp;</div>
          <div >
             <div class="row" id="layanan">
              <!-- <div class="col-md-2" id="layanan">
                <div class="row">
                  <div style="background-color: #05FE8F;width: 40px;height: 40px ;border-radius: 50%;">p</div>
                  <div style="background-color: #FA238C;width: 40px;border-radius: 50%;margin-left: -5px;">p</div>
                  <div style="background-color: #2082E3;width: 40px;border-radius: 50%;margin-left: -5px;">p</div>
                  <div style="background-color: #FCBB00;width: 40px;border-radius: 50%;margin-left: -5px;">p</div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                  <h6>Akta Kelahiran</h6>
                </div>
              </div> -->

            </div>
            <!-- <div class="row">&nbsp;</div><div class="row">&nbsp;</div> -->

          </div>
        </div>
      </div>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <audio src="" class="speech" hidden></audio>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js"></script>
    <script type="text/javascript">
//       const ut = new SpeechSynthesisUtterance('No warning should arise');
// speechSynthesis.speak(ut);
      $(document).ready(function(){
        function namaApp() {
          $.ajax({
            url : "<?=$api?>admin/get_nama_aplikasi.php",
            dataType : 'json',
            data : {},
            type : "post",
            success : function(data){
              $('#title').html(data.ket);
              $('#nama_app').html(data.isi);
            }
          })
        }
        // alert();
        function refreshData(){
            // show_layanan();
            namaApp();
            update();
            ambil_narasi();
            setTimeout(refreshData, 15000);
        }
        refreshData();
        function update_narasi(id){
          var id_narator = id;
          $.ajax({
            type : 'POST',
            url : '<?=$api?>client/update_narasi.php',
            dataType : 'JSON',
            data : {id_narator:id_narator},
            success : function(data){
            }
          })
        }
        function update() {
          $.ajax({
            type   : 'POST',
            url    : "<?=$api?>get_layanan.php",
            dataType : "JSON",
            data : {},
            success : function(data){
              // alert();
              var i;
              for(i=0; i<data.length; i++){
                var antrian_terlayani = '#antrian_terlayani'+i;
                var antrian_belum_terlayani = '#antrian_belum_terlayani'+i;
                var jumlah_antrian = '#jumlah_antrian'+i;
                var antrian_saat = '#antrian_saat'+i;
                $(antrian_terlayani).html(data[i].antrian_terlayani);
                $(antrian_belum_terlayani).html(data[i].antrian_belum_terlayani);
                $(jumlah_antrian).html(data[i].jumlah_antrian);
                $(antrian_saat).html(data[i].antrian_saat);
                if (data[i].antrian_saat == null) {
                  $(antrian_saat).html('-');
                }
              }
            }
          })
        }
        function ambil_narasi(){
          $.ajax({
            type : 'POST',
            url : '<?=$api?>client/get_narasi.php',
            dataType : 'JSON',
            data : {},
            success : function(data){
              responsiveVoice.speak(data.narasi,'Indonesian Female');
              update_narasi(data.id_narator);
              var html = "Nomor Antrian <b>"+data.nomor_antrian+"</b>, silahkan menuju loket <b>"+data.loket+"</b>";
              if (data.nomor_antrian != null) {
                $('#informasi').html(html);
              }
            }
          })
        }
        show();
        function show(){
          var test;
          $.ajax({
            type   : 'POST',
            url    : "<?=$api?>get_layanan.php",
            dataType : "JSON",
            data : {test:test},
            success : function(data){
              console.log(data.length);
              var html_layanan = "<div></div>";
              var i;
              for(i=0; i<data.length; i++){
                var antrian_terlayani = 'antrian_terlayani'+i;
                var antrian_belum_terlayani = 'antrian_belum_terlayani'+i;
                var jumlah_antrian = 'jumlah_antrian'+i;
                var antrian_saat = 'antrian_saat'+i;
                html_layanan += '<div class="col-md-2" id="layanan">'+
                '<div class="row">'+
                  '<div class="it" id="'+antrian_terlayani+'" style="background-color: #05FE8F;width: 40px;height: 40px ;border-radius: 50%;">&nbsp;</div>'+
                  '<div class="it" id="'+antrian_belum_terlayani+'" style="background-color: #FA238C;width: 40px;border-radius: 50%;margin-left: -5px;">&nbsp;</div>'+
                  '<div class="it" id="'+jumlah_antrian+'" style="background-color: #2082E3;width: 40px;border-radius: 50%;margin-left: -5px;">&nbsp;</div>'+
                  '<div class="it" id="'+antrian_saat+'" style="background-color: #FCBB00;width: 40px;border-radius: 50%;margin-left: -5px;">&nbsp;</div>'+
                '</div>'+
                '<div class="row">&nbsp;</div>'+
                '<div class="row">'+
                  '<h6>'+data[i].jenis_layanan+'</h6>'+
                '</div>'+
              '</div>';


                
              }
               $('#layanan ').html(html_layanan);
            }
          })
        }
      })
    </script>
  </body>
</html>