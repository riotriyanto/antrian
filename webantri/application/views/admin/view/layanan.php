<div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
<a href="" class="btn btn-light" id="re"><span class="fa fa-undo"></span> Refresh</a>
<a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#Modal_Add" ><span class="fa fa-plus"></span> Tambah</a><br><br>
<table id="example" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th class="text-center" width="10">NO</th>
                <th class="text-center">Kode</th>
                <th class="text-center">Urut</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Syarat</th>
                <th class="text-center">Aktif</th>
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
                            <label class="col-md-2 col-form-label">Kode Layanan</label>
                            <div class="col-md-10">
                              <input type="text" name="i_kode_layanan" id="i_kode_layanan" class="form-control" placeholder="Kode Layanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Urut</label>
                            <div class="col-md-10">
                              <input type="text" name="i_urut" id="i_urut" class="form-control" placeholder="Urutan Layanan">
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
                            <label class="col-md-2 col-form-label">Urut</label>
                            <div class="col-md-10">
                              <input type="text" name="u_urut" id="u_urut" class="form-control" placeholder="">
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
    <script type="text/javascript">
        CKEDITOR.replace( 'i_syarat' );
        CKEDITOR.replace( 'u_syarat' );
        $(document).ready(function(){
            $("#re").on("click", function(event){
                // event.preventDefault();
                show();
            })
            $('#alert-success').hide();
            $('#alert-danger').hide();
            show();
            function show(){
                $.ajax({
                    type : "POST",
                    url : "<?=$api ?>admin/layanan_read.php",
                    dataType : "JSON",
                    data : {},
                    success : function(data){
                        var html = '';
                    var i;
                    var n =1;
                    for(i=0; i<data.length; i++){
                        if (data[i].aktif == "1") {
                            var btn = '<a href="javascript:void(0);" class="btn btn-success btn-sm item-reset" data1="menonaktifkan" data="'+data[i].id_layanan+'" >Non Aktifkan</a>'
                        }else{
                            var btn = '<a href="javascript:void(0);" class="btn btn-warning btn-sm item-reset" data1="mengaktifkan" data="'+data[i].id_layanan+'" >Aktifkan</a>'
                        }
                        html += '<tr>'+
                                '<td>'+n+'</td>'+
                                '<td>'+data[i].kode_layanan+'</td>'+
                                '<td>'+data[i].urut+'</td>'+
                                '<td>'+data[i].jenis_layanan+'</td>'+
                                '<td>'+data[i].desk_layanan+'....</td>'+
                                '<td>'+btn+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data="'+data[i].id_layanan+'" >Edit</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data="'+data[i].id_layanan+'" data2="'+data[i].jenis_layanan+'">Hapus</a>'+
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
                show();
                var kode_layanan = $('#i_kode_layanan').val();
                var jenis_layanan = $('#i_nama_layanan').val();
                var urut = $('#i_urut').val();
                var desk_layanan = CKEDITOR.instances.i_syarat.getData();
                $.ajax({
                    url : "<?=$api ?>admin/layanan_create.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {kode_layanan:kode_layanan, jenis_layanan:jenis_layanan, desk_layanan:desk_layanan, urut:urut},
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
                        show();
                    }
                })
            })
            //reset
            $('#show_data').on('click','.item-reset',function(){
                var id_layanan=$(this).attr('data');
                var aksi=$(this).attr('data1');
                $('#alert-success').hide();
                $.ajax({
                    url : "<?=$api?>admin/layanan_aktif_non.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_layanan:id_layanan, aksi:aksi},
                    success : function (data) {
                        if (aksi == "mengaktifkan") {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil mengaktifkan layanan</b>");
                            alert("Berhasil mengaktifkan layanan");
                            show();
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html("Berhasil menonaktifkan layanan");
                            alert("Berhasil menonaktifkan layanan");
                            show();
                        }
                        show();
                    }
                })
                show();
            });

            $('#show_data').on('click','.item_edit',function(){
                var id_layanan=$(this).attr('data');
                $.ajax({
                    url : "<?=$api ?>admin/layanan_read_by_id.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_layanan: id_layanan},
                    success : function(data){
                        $('#ModalaEdit').modal('show');
                        $('[name="id_layanan"]').val(id_layanan);
                        $('[name="u_kode_layanan"]').val(data[0].kode_layanan);
                        $('[name="u_nama_layanan"]').val(data[0].jenis_layanan);
                        $('[name="u_urut"]').val(data[0].urut);
                        CKEDITOR.instances.u_syarat.setData(data[0].desk_layanan);
                    }
                })
            });
            //update
            $('#btn-update').on('click', function(){
                show();
                var id_layanan = $('#id_layanan').val();
                var kode_layanan = $('#u_kode_layanan').val();
                var nama_layanan = $('#u_nama_layanan').val();
                var urut = $('#u_urut').val();
                var desk_layanan = CKEDITOR.instances.u_syarat.getData();
                $.ajax({
                    url : "<?=$api ?>admin/layanan_update.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_layanan:id_layanan, kode_layanan:kode_layanan, jenis_layanan:nama_layanan, desk_layanan:desk_layanan, urut:urut},
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
                    url : "<?=$api ?>admin/layanan_delete.php",
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
                    }
                })
                //
            });
        })
    </script>