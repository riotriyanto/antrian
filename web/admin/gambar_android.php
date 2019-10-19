<?php include 'header.php'; ?>
<!-- <div style="height:100%;width:100%;position:absolute;top:0;left:0;background-color:#000000;display:none;">
     <div id="divOperationMessage" style="background-color: White; border: 2px solid black;
        display: block;  width: 350px; z-index: 1001; top: 60px; left: 240px; position: fixed; 
        padding-left: 10px;margin:auto;">

------------------Whatever content inside-----------------------------

     </div>
</div> -->
<div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
                <h1>Manajemen
                    <small>Gambar Android</small>
                </h1>
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th width="">Gambar</th>
                        <th width="">Deskripsi</th>
                        <th style="text-align: center;width: 5%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
            </table>
        </div>
    </div>
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
                                            <label for="name">Deskripsi</label>
                                            <input type="hidden" name="id_gambar" id="id_gambar">
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Enter name" required />
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
    				url : "<?php echo $url ?>android_get_gambar.php",
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
                                '<td>'+data[i].deskripsi+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit"  data="'+data[i].id_gambar+'" data2="'+data[i].gambar+'" data3="'+data[i].deskripsi+'">Edit</a>'+' '+
                                '</td>'+
                                '</tr>';
                                n++;

                    }
                    $('#show_data').html(html);
    				}
    			})
    		}
             //
             //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var id_gambar=$(this).attr('data');
                var deskripsi=$(this).attr('data3');
                var gambar=$(this).attr('data2');
                $('#ModalaEdit').modal('show');
                $('[name="id_gambar"]').val(id_gambar);
                $('[name="deskripsi"]').val(deskripsi);
                // $('[name="e_gambar"]').val(gambar);
                $('#e_gambar').attr('src',gambar);
            });
            $('#btn-s').on('click', function(){
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

                var deskripsi = document.getElementById("deskripsi");
                formData.set("deskripsi", deskripsi.value)

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
                request.open('POST', "http://103.100.27.19/api_antrian/admin/upload_gambar_android.php");
                request.send(formData);
                // console.log(request.responseText);
              }

    	})
    </script>
</body>
</html>