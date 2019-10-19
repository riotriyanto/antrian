<div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
<a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Tambah</a><br><br>
<table id="example" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th class="text-center" width="10">NO</th>
                <th class="text-center">Tanggal</th>
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
                            <label class="col-md-2 col-form-label">Tanggal</label>
                            <div class="col-md-10">
                              <input type="date" name="i_tgl" id="i_tgl" class="form-control" placeholder="Nomor waktu">
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
                            <label class="col-md-2 col-form-label">Tanggal</label>
                            <div class="col-md-10">
                                <input type="hidden" name="id_tgl" id="id_tgl">
                              <input type="date" name="u_tgl" id="u_tgl" class="form-control" placeholder="Kode waktu">
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
                                           
                            <input type="hidden" name="d_id_tgl" id="d_id_tgl" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau memhapus tanggal  <b id="d_tgl"></b>?</p></div>
                                         
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
                    url : "<?=$api?>admin/tgl_read.php",
                    dataType : "JSON",
                    data : {},
                    success : function(data){
                        var html = '';
                    var i;
                    var n =1;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+n+'</td>'+
                                '<td>'+data[i].tgl+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data="'+data[i].id_tgl+'" >Edit</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data="'+data[i].id_tgl+'" data2="'+data[i].tgl+'">Hapus</a>'+' '+
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
                var tgl = $('#i_tgl').val();
                $.ajax({
                    url : "<?=$api?>admin/tgl_create.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {tgl:tgl},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil menambah tanggal <b>"+tgl+"</b>");
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
             //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var id_tgl=$(this).attr('data');
                // alert(id_tgl);
                $.ajax({
                    url : "<?=$api?>admin/tgl_read_by_id.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_tgl: id_tgl},
                    success : function(data){
                        $('#ModalaEdit').modal('show');
                        $('[name="id_tgl"]').val(id_tgl);
                        $('[name="u_tgl"]').val(data[0].tgl);
                    }
                })
            });
            //update
            $('#btn-update').on('click', function(){
                var id_tgl = $('#id_tgl').val();
                var tgl = $('#u_tgl').val();
                $.ajax({
                    url : "<?=$api?>admin/tgl_update.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_tgl:id_tgl, tgl:tgl},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil mengedit tanggal");
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
                $('[name="d_id_tgl"]').val(id);
                $('#d_tgl').html(jenis);
            });
             $('#btn_hapus').on('click',function(){
                var id_tgl=$('#d_id_tgl').val();
                $.ajax({
                    url : "<?=$api?>admin/tgl_delete.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_tgl: id_tgl},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil menghapus tanggal");
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