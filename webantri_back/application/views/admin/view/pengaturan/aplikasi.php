<div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
<a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Tambah</a><br><br>
<table id="example" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th class="text-center" width="10">NO</th>
                <th class="text-center">Pengaturan</th>
                <th class="text-center">Value</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center" width="150">Aksi</th>
            </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
    </table>
        <!-- MODAL update -->
            <form>
            <div class="modal fade" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b><font id="pengaturan"></font></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <!--  <div class="form-group">
                            <label>Pengaturan</label>
                                <input type="hidden" name="id_setting" id="id_setting">
                                <font id="pengaturan" class="form-control"></font>
                        </div>   -->
                        <div class="form-group">
                            <label>Value</label>
                            <input type="hidden" id="id_setting" name="">
                            <input type="text" class="form-control" name="isi" id="isi">
                        </div>  
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan">
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#alert-success').hide();
            $('#alert-danger').hide();
            show();
            function show(){
                $.ajax({
                    type : "POST",
                    url : "<?=$api ?>admin/pengaturan_view.php",
                    dataType : "JSON",
                    data : {},
                    success : function(data){
                        var html = '';
                    var i;
                    var n =1;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+n+'</td>'+
                                '<td>'+data[i].pengaturan+'</td>'+
                                '<td>'+data[i].isi+'</td>'+
                                '<td>'+data[i].keterangan+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data="'+data[i].id_setting+'" data2="'+data[i].pengaturan+'" data3="'+data[i].isi+'" data4="'+data[i].keterangan+'">Edit</a>'+' '+
                                '</td>'+
                                '</tr>';
                                n++;

                    }
                    $('#show_data').html(html);
                    $('#example').DataTable();
                    }
                })
            }
            $('#show_data').on('click','.item_edit',function(){
                var id_setting=$(this).attr('data');
                var pengaturan=$(this).attr('data2');
                var isi=$(this).attr('data3');
                var keterangan=$(this).attr('data4');
                $('#ModalaEdit').modal('show');
                $('#pengaturan').html(pengaturan);
                $('#id_setting').val(id_setting);
                $('#isi').val(isi);
                $('#keterangan').val(keterangan);
                // $.ajax({
                //     url : "<?=$api ?>admin/layanan_read_by_id.php",
                //     type : "POST",
                //     dataType : "JSON",
                //     data : {id_layanan: id_layanan},
                //     success : function(data){
                //         $('#ModalaEdit').modal('show');
                //         $('[name="id_layanan"]').val(id_layanan);
                //         $('[name="u_kode_layanan"]').val(data[0].kode_layanan);
                //         $('[name="u_nama_layanan"]').val(data[0].jenis_layanan);
                //         CKEDITOR.instances.u_syarat.setData(data[0].desk_layanan);
                //     }
                // })
            });
            //update
            $('#btn-update').on('click', function(){
                $('#alert-success').hide();
                $('#alert-danger').hide();
                var id_setting = $('#id_setting').val();
                var isi = $('#isi').val();
                var keterangan = $('#keterangan').val();
                $.ajax({
                    url : "<?=$api ?>admin/pengaturan_update.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_setting:id_setting, isi:isi, keterangan:keterangan},
                    success : function(data){
                        $('#alert-success').hide();
                        $('#alert-danger').hide();
                        if (data.status) {
                            $('#alert-success').show();
                            $('#alert-success').html("Berhasil mengedit pengaturan");
                        }else{
                            $('#alert-danger').show();
                            $('#alert-danger').html("Gagal mengedit pengaturan");
                        }
                        show();
                        $('#ModalaEdit').modal('hide');

                    }
                })
            })
        })
    </script>