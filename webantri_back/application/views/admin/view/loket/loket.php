<a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Tambah</a><br><br>
<table id="example" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th width="5%" class="text-center" width="10">NO</th>
                <th width="10%" class="text-center">ID Loket</th>
                <th width="10%" class="text-center">Nama Loket</th>
                <th  class="">Status</th>
                <th width="30%" class="text-center" width="150">Aksi</th>
            </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
    </table>
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
                            <label class="col-md-2 col-form-label">Nama loket</label>
                            <div class="col-md-10">
                              <input type="text" name="i_nomor_loket" id="i_nomor_loket" class="form-control" placeholder="Nomor loket">
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
        <!--MODAL reset-->
        <div class="modal fade" id="ModalaReset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="r_kode" id="r_kode" value="">
                            <div class="alert alert-warning"><p>Reset loket <b id="r_nomor_loket"></b>?</p></div>
                                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" id="btn_reset" class="btn btn-danger">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL reset-->
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
                            <label class="col-md-2 col-form-label">Nama loket</label>
                            <div class="col-md-10">
                                <input type="hidden" name="id_loket" id="id_loket">
                              <input type="text" name="u_kode_loket" id="u_kode_loket" class="form-control" placeholder="Kode loket">
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
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau memhapus loket <b id="d_jenis_loket"></b>?</p></div>
                                         
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
    <script type="text/javascript">
    	$(document).ready(function(){
            $('#alert-success').hide();
            $('#alert-danger').hide();
    		show();
    		function show(){
    			$.ajax({
    				type : "POST",
    				url : "<?=$api ?>admin/loket_read.php",
    				dataType : "JSON",
    				data : {},
    				success : function(data){
    					var html = '';
                    var i;
                    var n =1;
                    for(i=0; i<data.length; i++){
                        if (data[i].status == 'aktif') {
                            var btn = 'btn-primary';
                            var item = 'item_reset';
                        }else{
                            var btn = 'btn-light';
                            var item = '';
                        }
                        html += '<tr>'+
                        		'<td>'+n+'</td>'+
                                '<td>'+data[i].id_loket+'</td>'+
                                '<td>'+data[i].nomor_loket+'</td>'+
                                '<td>'+data[i].status+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn '+btn+' '+item+' btn-sm " data="'+data[i].id_loket+'" data2="'+data[i].nomor_loket+'">Reset</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data="'+data[i].id_loket+'" >Edit</a>'+' '+
                                    '<a style="display:none" href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data="'+data[i].id_loket+'" data2="'+data[i].nomor_loket+'">Hapus</a>'+' '+
                                '</td>'+
                                '</tr>';
                                n++;

                    }
                    $('#show_data').html(html);
                    $('#example').DataTable();
    				}
    			})
    		}
            $('#btn_save').on('click',function(){
                var nomor_loket = $('#i_nomor_loket').val();
                $.ajax({
                    url : "<?=$api ?>admin/loket_create.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {nomor_loket:nomor_loket},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil menambah loket <b>"+nomor_loket+"</b>");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html(data.pesan);
                        }
                        show();
                        $('#Modal_Add').modal('hide');
                    }
                })
            })
             //
             $('#show_data').on('click','.item_reset',function(){
                var id_loket=$(this).attr('data');
                var nomor_loket = $(this).attr('data2');
                $.ajax({
                    url : "<?=$api ?>admin/loket_read_by_id.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_loket: id_loket},
                    success : function(data){
                        $('#ModalaReset').modal('show');
                        $('[name="r_kode"]').val(id_loket);
                        $('#r_nomor_loket').html(nomor_loket);
                        $('[name="u_kode_loket"]').val(data[0].nomor_loket);
                    }
                })
            });
             $('#btn_reset').on('click',function(){
                var id_loket=$('#r_kode').val();

                $.ajax({
                    url : "<?=$api ?>admin/loket_reset_id.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_loket: id_loket},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil reset loket");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html(data.pesan);
                        }
                        show();
                        $('#ModalaReset').modal('hide');
                    }
                })
                //
            });
             //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var id_loket=$(this).attr('data');
                $.ajax({
                    url : "<?=$api ?>admin/loket_read_by_id.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_loket: id_loket},
                    success : function(data){
                        $('#ModalaEdit').modal('show');
                        $('[name="id_loket"]').val(id_loket);
                        $('[name="u_kode_loket"]').val(data[0].nomor_loket);
                    }
                })
            });
            //update
            $('#btn-update').on('click', function(){
                var id_loket = $('#id_loket').val();
                var nomor_loket = $('#u_kode_loket').val();
                $.ajax({
                    url : "<?=$api ?>admin/loket_update.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_loket:id_loket, nomor_loket:nomor_loket},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil mengedit loket");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html(data.pesan);
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
                $('#d_jenis_loket').html(jenis);
            });
             $('#btn_hapus').on('click',function(){
                var id_loket=$('#d_kode').val();
                $.ajax({
                    url : "<?=$api ?>admin/loket_delete.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_loket: id_loket},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil menghapus loket");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html(data.pesan);
                        }
                        show();
                        $('#ModalHapus').modal('hide');
                    }
                })
                //
            });
    	})
    </script>