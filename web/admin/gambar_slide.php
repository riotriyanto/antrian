<?php include 'header.php'; ?>
<div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
                <h1>Manajemen
                    <small>Gambar Slide</small>
                </h1>
            </div>
            <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Tambah"><span class="fa fa-plus"></span> Tambah</a></div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th width="">Gambar</th>
                        <th style="text-align: center;width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
            </table>
        </div>
    </div>
    <!-- tambah -->
    <form>
            <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-10">
                                
                                <!-- <input type="text" name="e_gambar" id="e_gambar" class="form-control"> -->
                                <div style="margin-left: 100px;">
                                    
                                    <form enctype="multipart/form-data" id="fupForm" >
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <input type="file" class="form-control" id="ifileSelect" name="ifileSelect" required />
                                        </div>
                                        <input type="button" name="submit" id="btn-t" class="btn btn-danger submitBtn" value="SAVE"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" type="submit" id="btn-update" class="btn btn-primary">Simpan</button> -->
                  </div>
                </div>
              </div>
            </div>
            </form>
    <!-- edn tambah -->
        <!-- MODAL update -->
            <form>
            <div class="modal fade" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-10">
                                
                                <!-- <input type="text" name="e_gambar" id="e_gambar" class="form-control"> -->
                                <div style="margin-left: 100px;">
                                    <img width="300px" src="" id="e_gambar" class="form-control" >
                                    
                                    <form enctype="multipart/form-data" id="fupForm" >
                                        <div class="form-group">
                                            <input type="hidden" name="id_gambar" id="id_gambar">
                                        </div>
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <input type="file" class="form-control" id="fileSelect" name="fileSelect" required />
                                        </div>
                                        <input type="button" name="submit" id="btn-s" class="btn btn-danger submitBtn" value="SAVE"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" type="submit" id="btn-update" class="btn btn-primary">Simpan</button> -->
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL update-->
        <div class="modal fade" id="Hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <img width="300px" src="" id="h_gambar" class="form-control" >
                        <form>
                            <input type="hidden" name="id_gambar_h" id="id_gambar_h">
                        </form>
                        <input style="float: right;" type="button" name="submit" id="btn-h" class="btn btn-danger submitBtn" value="Hapus"/>
                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" type="submit" id="btn-update" class="btn btn-primary">Simpan</button> -->
                  </div>
                </div>
              </div>
            </div>
        <!--  -->
        <form>
            <div class="modal fade" id="p" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="background-color: rgba(255, 255, 255, 0);border: 0px;">
                  <center><img src="../images/loading.gif" style="margin-top: 40%"></center>
                </div>
              </div>
            </div>
            </form>
<!--  -->

                </div>
            </div>
        </div>
    </div>
    <?php include '../api.php'; ?>
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
            $('#alert-success').hide();
            $('#alert-danger').hide();
    		show();
    		function show(){
    			$.ajax({
    				type : "POST",
    				url : "<?php echo $url ?>admin/gambar_slide_get.php",
    				dataType : "JSON",
    				data : {},
    				success : function(data){
                        console.log(data);
    					var html = '';
                        var i;
                    var n =1;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td><img width=100px; src='+data[i].gambar+'></td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit"  data="'+data[i].id_gambar+'" data2="'+data[i].gambar+'">Edit</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_hapus"   data="'+data[i].id_gambar+'" data2="'+data[i].gambar+'">Hapus</a>'+' '+
                                '</td>'+
                                '</tr>';
                                n++;

                    }
                    $('#show_data').html(html);
    				}
    			})
    		}
            //tambah
            $('#btn-t').on('click', function(){
                $('#alert-success').hide();
                $('#alert-danger').hide();
                tambah();
            })
            function tambah(){
                // $('#ModalaEdit').modal('hide');
                
                // Form Data
                // $('#p').modal('show');
                var formData = new FormData();

                var fileSelect = document.getElementById("ifileSelect");
                if(fileSelect.files && fileSelect.files.length == 1){
                 var file = fileSelect.files[0]
                 formData.set("file", file , file.name);
                }
                // Http Request  
                var request = new XMLHttpRequest();
                // var size = fileSelect.files[0].size;
                // if (size > 500000) {
                //     alert("File gambar terlalu besar");
                // }
                request.onreadystatechange = function() {
                    if (request.readyState === 4) {
                      var res = JSON.parse(request.response);
                      console.log(res);
                      if (res.status){
                        $('#alert-success').show();
                        $('#alert-success').html(res.pesan);
                      }else{
                        $('#alert-danger').show();
                        $('#alert-danger').html(res.pesan);
                      }
                      show();
                      $('#p').modal('hide');
                      $('#Tambah').modal('hide');
                        
                    }
                  }
                request.open('POST', "http://103.100.27.19/api_antrian/admin/gambar_slider_t.php");
                request.send(formData);
                // console.log(request.responseText);
              }
            //endtambah
             //
             //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var id_gambar=$(this).attr('data');
                var gambar=$(this).attr('data2');
                $('#ModalaEdit').modal('show');
                $('[name="id_gambar"]').val(id_gambar);
                // $('[name="e_gambar"]').val(gambar);
                $('#e_gambar').attr('src',gambar);
            });
            $('#btn-s').on('click', function(){
                $('#alert-success').hide();
                $('#alert-danger').hide();
                doSubmit();
            })
            function doSubmit(){
                // $('#ModalaEdit').modal('hide');
                
                // Form Data
                // $('#p').modal('show');
                var formData = new FormData();

                var fileSelect = document.getElementById("fileSelect");
                if(fileSelect.files && fileSelect.files.length == 1){
                 var file = fileSelect.files[0]
                 formData.set("file", file , file.name);
                }

                var id_gambar = document.getElementById("id_gambar");
                formData.set("id_gambar", id_gambar.value)
                // Http Request  
                var request = new XMLHttpRequest();
                // var size = fileSelect.files[0].size;
                // if (size > 500000) {
                //     alert("File gambar terlalu besar");
                // }
                request.onreadystatechange = function() {
                    if (request.readyState === 4) {
                      var res = JSON.parse(request.response);
                      console.log(res);
                      if (res.status){
                        $('#alert-success').show();
                        $('#alert-success').html(res.pesan);
                      }else{
                        $('#alert-danger').show();
                        $('#alert-danger').html(res.pesan);
                      }
                      show();
                      $('#p').modal('hide');
                      $('#ModalaEdit').modal('hide');
                        
                    }
                  }
                request.open('POST', "http://103.100.27.19/api_antrian/admin/upload_gambar_slide.php");
                request.send(formData);
                // console.log(request.responseText);
              }
              $('#show_data').on('click','.item_hapus',function(){
                var id_gambar=$(this).attr('data');
                var gambar=$(this).attr('data2');
                $('#Hapus').modal('show');
                $('[name="id_gambar_h"]').val(id_gambar);
                $('#h_gambar').attr('src',gambar);
              })
              $('#btn-h').on('click', function(){
                $('#alert-success').hide();
                $('#alert-danger').hide();
                var id_gambar = $('#id_gambar_h').val();
                $.ajax({
                    url :"http://103.100.27.19/api_antrian/admin/gambar_slider_h.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_gambar:id_gambar},
                    success : function(data){
                        console.log(data);
                        if (data.status){
                            $('#alert-success').show();
                            $('#alert-success').html(data.pesan);
                          }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html(data.pesan);
                          }
                          show();
                          $('#p').modal('hide');
                          $('#Hapus').modal('hide');
                    }              
                })
              })

    	})
    </script>
</body>
</html>