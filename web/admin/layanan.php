<?php include 'header.php'; ?>
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script> 
<div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
                <h1>Manajemen
                    <small>Layanan</small>
                    <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Tambah</a></div>
                </h1>
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th width="5%;">NO</th>
                        <th width="10%;">Kode Layanan</th>
                        <th width="20%">Nama Layanan</th>
                        <th width="50%" style="text-align: center;">Syarat</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                     
                </tbody>
            </table>
        </div>
    </div>
    <!-- MODAL ADD -->
            <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Kode Layanan</label>
                            <div class="col-md-10">
                              <input type="text" name="i_kode_layanan" id="i_kode_layanan" class="form-control" placeholder="Kode Layanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                              <input type="text" name="i_nama_layanan" id="i_nama_layanan" class="form-control" placeholder="Nama Layanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Syarat</label>
                            <div class="col-md-10">
                              <textarea name="i_syarat" id="i_syarat">Syarat untuk layanan</textarea>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->
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
                            <label class="col-md-2 col-form-label">Kode Layanan</label>
                            <div class="col-md-10">
                                <input type="hidden" name="id_layanan" id="id_layanan">
                              <input type="text" name="u_kode_layanan" id="u_kode_layanan" class="form-control" placeholder="Kode Layanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                              <input type="text" name="u_nama_layanan" id="u_nama_layanan" class="form-control" placeholder="Nama Layanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Syarat</label>
                            <div class="col-md-10">
                              <textarea name="u_syarat" id="u_syarat"><div id="u_syarat">g</div></textarea>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" type="submit" id="btn-update" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL update-->
        <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="d_kode" id="d_kode" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau memhapus Layanan <b id="d_jenis_layanan"></b>?</p></div>
                                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" id="btn_hapus" class="btn btn-danger">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL HAPUS-->
<!--  -->

                </div>
            </div>
        </div>
    </div>
    <?php include '../api.php'; ?>
    <script>
        CKEDITOR.replace( 'i_syarat' );
        CKEDITOR.replace( 'u_syarat' );
    </script>
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
    				url : "<?php echo $url ?>admin/layanan_read.php",
    				dataType : "JSON",
    				data : {},
    				success : function(data){
    					var html = '';
                    var i;
                    var n =1;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                        		'<td>'+n+'</td>'+
                                '<td>'+data[i].kode_layanan+'</td>'+
                                '<td>'+data[i].jenis_layanan+'</td>'+
                                '<td>'+data[i].desk_layanan+'....</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data="'+data[i].id_layanan+'" >Edit</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data="'+data[i].id_layanan+'" data2="'+data[i].jenis_layanan+'">Hapus</a>'+
                                '</td>'+
                                '</tr>';
                                n++;

                    }
                    $('#show_data').html(html);
    				}
    			})
    		}
    		 $('#btn_save').on('click',function(){
    		 	var kode_layanan = $('#i_kode_layanan').val();
    		 	var jenis_layanan = $('#i_nama_layanan').val();
    		 	var desk_layanan = CKEDITOR.instances.i_syarat.getData();
    			$.ajax({
                    url : "<?php echo $url ?>admin/layanan_create.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {kode_layanan:kode_layanan, jenis_layanan:jenis_layanan, desk_layanan:desk_layanan},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil menambah layanan <b>"+jenis_layanan+"</b>");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html("Gagal menambah layanan");
                        }
                        show();
                        $('#Modal_Add').modal('hide');
                    }
                })
    		})
             //
             //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var id_layanan=$(this).attr('data');
                $.ajax({
                    url : "<?php echo $url ?>admin/layanan_read_by_id.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_layanan: id_layanan},
                    success : function(data){
                        $('#ModalaEdit').modal('show');
                        $('[name="id_layanan"]').val(id_layanan);
                        $('[name="u_kode_layanan"]').val(data[0].kode_layanan);
                        $('[name="u_nama_layanan"]').val(data[0].jenis_layanan);
                        CKEDITOR.instances.u_syarat.setData(data[0].desk_layanan);
                    }
                })
            });
            //update
            $('#btn-update').on('click', function(){
                var id_layanan = $('#id_layanan').val();
                var kode_layanan = $('#u_kode_layanan').val();
                var nama_layanan = $('#u_nama_layanan').val();
                var desk_layanan = CKEDITOR.instances.u_syarat.getData();
                $.ajax({
                    url : "<?php echo $url ?>admin/layanan_update.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_layanan:id_layanan, kode_layanan:kode_layanan, jenis_layanan:nama_layanan, desk_layanan:desk_layanan},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil mengedit layanan");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html("Gagal mengedit layanan");
                        }
                        show();
                        $('#ModalaEdit').modal('hide');

                    }
                })
            })

             //GET HAPUS
            $('#show_data').on('click','.item_delete',function(){
                var id=$(this).attr('data');
                var jenis=$(this).attr('data2');
                $('#ModalHapus').modal('show');
                $('[name="d_kode"]').val(id);
                $('#d_jenis_layanan').html(jenis);
            });
             $('#btn_hapus').on('click',function(){
                var id_layanan=$('#d_kode').val();
                $.ajax({
                    url : "<?php echo $url ?>admin/layanan_delete.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_layanan: id_layanan},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil menghapus layanan");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html("Gagal menghapus layanan");
                        }
                        show();
                        $('#ModalHapus').modal('hide');
                        show();
                    }
                })
                //
            });
    	})
    </script>
</body>
</html>