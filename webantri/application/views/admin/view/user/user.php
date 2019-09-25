<div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
<a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Tambah</a><br><br>
<table id="example" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th class="text-center" width="10">NO</th>
                <th class="text-center">Nik</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Level</th>
                <th class="text-center" width="150">Aksi</th>
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
                            <label class="col-md-2 col-form-label">NIK<font>*</font></label>
                            <div class="col-md-10">
                              <input type="text" name="i_nik" id="i_nik" class="form-control" placeholder="NIK" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama<font>*</font></label>
                            <div class="col-md-10">
                              <input type="text" name="i_nama" id="i_nama" class="form-control" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Password<font>*</font></label>
                            <div class="col-md-10">
                              <input type="password" name="i_password" id="i_password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nomor Telepon<font>*</font></label>
                            <div class="col-md-10">
                              <input type="text" name="i_no_telp" id="i_no_telp" class="form-control" placeholder="Nomor Telepon" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Level</label>
                            <div class="col-md-10">
                              <select name="i_level" id="i_level" class="form-control" required>
                                  <option value="admin">Admin</option>
                                  <option value="cs">CS</option>
                                  <option value="operator">Operator</option>
                              </select>
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
                            <label class="col-md-2 col-form-label">NIK<font>*</font></label>
                            <div class="col-md-10">
                                <input type="hidden" name="u_id_user" id="u_id_user">
                              <input type="text" name="u_nik" id="u_nik" class="form-control" placeholder="NIK" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama<font>*</font></label>
                            <div class="col-md-10">
                              <input type="text" name="u_nama" id="u_nama" class="form-control" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Password<font>*</font></label>
                            <div class="col-md-10">
                              <input type="password" name="u_password" id="u_password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nomor Telepon<font>*</font></label>
                            <div class="col-md-10">
                              <input type="text" name="u_no_telp" id="u_no_telp" class="form-control" placeholder="Nomor Telepon" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Level</label>
                            <div class="col-md-10">
                              <select name="u_level" id="u_level" class="form-control" required>
                                  <option value="admin">Admin</option>
                                  <option value="cs">CS</option>
                                  <option value="operator">Operator</option>
                              </select>
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
                                           
                            <input type="hidden" name="d_id_user" id="d_id_user" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau memhapus user <b id="d_nama"></b>?</p></div>
                                         
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
                    url : "<?=$api ?>admin/user_read.php",
                    dataType : "JSON",
                    data : {},
                    success : function(data){
                        var html = '';
                    var i;
                    var n =1;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+n+'</td>'+
                                '<td>'+data[i].nik+'</td>'+
                                '<td>'+data[i].nama+'</td>'+
                                '<td>'+data[i].akses+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data="'+data[i].id_user+'" >Edit</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data="'+data[i].id_user+'" data2="'+data[i].nama+'">Hapus</a>'+
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
                 $('#Modal_Add').modal('hide');
                var nik = $('#i_nik').val();
                var nama = $('#i_nama').val();
                var password = $('#i_password').val();
                var no_telp = $('#i_no_telp').val();
                var level = $('#i_level').val();
                $.ajax({
                    url : "<?=$api?>admin/user_create.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {nik:nik, nama:nama, password:password, no_telp:no_telp,level:level},
                    success : function(data){
                        $('#alert-success').hide();
                        console.log(data);
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil menambah user <b>"+nama+"</b>");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html(data.pesan);
                        }
                        show();
                        $('#Modal_Add').modal('hide');
                        $('#Modal_Add').modal('hide');
                    }
                })
            })
             //
             //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var id_user=$(this).attr('data');
                // alert(id_user);
                $.ajax({
                    url : "<?=$api?>admin/user_read_by_id.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_user: id_user},
                    success : function(data){
                        $('#ModalaEdit').modal('show');
                        $('[name="u_id_user"]').val(id_user);
                        $('[name="u_nik"]').val(data[0].nik);
                        $('[name="u_nama"]').val(data[0].nama);
                        $('[name="u_password"]').val();
                        $('[name="u_no_telp"]').val(data[0].no_telp);
                        $('[name="u_level"]').val(data[0].level);
                    }
                })
            });
            //update
            $('#btn-update').on('click', function(){
                var id_user = $('#u_id_user').val();
                var nik = $('#u_nik').val();
                var nama = $('#u_nama').val();
                var password = $('#u_password').val();
                var no_telp = $('#u_no_telp').val();
                var level = $('#u_level').val();
                $.ajax({
                    url : "<?=$api?>admin/user_update.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_user:id_user, nik:nik, nama:nama, password:password, no_telp:no_telp, level:level},
                    success : function(data){
                        console.log(data);
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html(data.pesan);
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
                var id_user=$(this).attr('data');
                var nama=$(this).attr('data2');
                $('#ModalHapus').modal('show');
                $('[name="d_id_user"]').val(id_user);
                $('#d_nama').html(nama);
            });
             $('#btn_hapus').on('click',function(){
                var id_user=$('#d_id_user').val();
                $.ajax({
                    url : "<?=$api?>admin/user_delete.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_user: id_user},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html(data.pesan);
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