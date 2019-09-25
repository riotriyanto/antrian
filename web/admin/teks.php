<?php include 'header.php'; ?>
<div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <div class="alert alert-success" id="alert-success" role="alert">
                  
                </div>
                <div class="alert alert-danger" id="alert-danger" role="alert">
                  
                </div>
                <h1>Manajemen
                    <small>Teks Berjalan</small>
                </h1>
            </div>
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th width="30%;">TEKS</th>
                        <th width="">TGL MULAI</th>
                        <th width="">TGL BERAKHIR</th>
                        <th width="30%">DEFAULT</th>
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
                            <label class="col-md-2 col-form-label">Teks</label>
                            <div class="col-md-10">
                                <input type="hidden" name="id_teks" id="id_teks">
                              <textarea class="form-control" name="teks1" id="teks1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Tanggal Mulai</label>
                            <div class="col-md-10">
                              <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Tanggal Berakhir</label>
                            <div class="col-md-10">
                              <input type="date" name="tgl_berakhir" id="tgl_berakhir" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Default</label>
                            <div class="col-md-10">
                              <textarea class="form-control" name="teks2" id="teks2"></textarea>
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
    				url : "<?php echo $url ?>admin/teks_read.php",
    				dataType : "JSON",
    				data : {},
    				success : function(data){
    					var html = '';
                        html += '<tr>'+
                                '<td>'+data.teks+'</td>'+
                                '<td>'+data.mulai+'</td>'+
                                '<td>'+data.akhir+'</td>'+
                                '<td>'+data.standar+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data="'+data.teks+'" data2="'+data.mulai+'" data3="'+data.akhir+'" data4="'+data.standar+'">Edit</a>'+' '+
                                '</td>'+
                                '</tr>';
                    $('#show_data').html(html);
    				}
    			})
    		}
             //
             //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var teks=$(this).attr('data');
                var mulai=$(this).attr('data2');
                var akhir=$(this).attr('data3');
                var de=$(this).attr('data4');
                $('#ModalaEdit').modal('show');
                $('#teks1').html(teks);
                $('[name="tgl_mulai"]').val(mulai);
                $('[name="tgl_berakhir"]').val(akhir);
                $('#teks2').html(de);
            });
            //update
            $('#btn-update').on('click', function(){
                var teks = $('#teks1').val();
                var mulai = $('#tgl_mulai').val();
                var akhir = $('#tgl_berakhir').val();
                var de = $('#teks2').val();
                $.ajax({
                    url : "<?php echo $url ?>admin/teks_update.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {teks:teks, mulai:mulai, akhir:akhir, de:de},
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