<?php include 'header.php'; ?>
<div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
                <h1>Manajemen
                    <small>Maksimal Antrian</small>
                </h1>
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th width="">Maksimal Antrian</th>
                        <th width="">Keterangan</th>
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
                            <label class="col-md-2 col-form-label">Maksimal Antrian</label>
                            <div class="col-md-10">
                                <input type="hidden" name="id_setting" id="id_setting">
                                <input type="teks" name="u_isi" id="u_isi" class="form-control">
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
    				url : "<?php echo $url ?>admin/antrian_max_read.php",
    				dataType : "JSON",
    				data : {},
    				success : function(data){
    					var html = '';
                        html += '<tr>'+
                                '<td>'+data.isi+'</td>'+
                                '<td>'+data.ket+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data="'+data.id_setting+'" data2="'+data.isi+'" >Edit</a>'+' '+
                                '</td>'+
                                '</tr>';
                    $('#show_data').html(html);
    				}
    			})
    		}
             //
             //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var id_setting=$(this).attr('data');
                var isi=$(this).attr('data2');
                $('#ModalaEdit').modal('show');
                $('[name="id_setting"]').val(id_setting);
                $('[name="u_isi"]').val(isi);
            });
            //update
            $('#btn-update').on('click', function(){
                var id_setting = $('#id_setting').val();
                var isi = $('#u_isi').val();
                $.ajax({
                    url : "<?php echo $url ?>admin/antrian_max_update.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_setting:id_setting, isi:isi},
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

    	})
    </script>
</body>
</html>