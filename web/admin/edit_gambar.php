<?php include 'header.php'; ?>
<div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Manajemen
                    <small>Gambar Android</small>
                </h1>
            </div>
           <center>
               <img src="" id="gbr">
               <form >
                   <input type="text" name="">
                   <input type="submit" name="">
               </form>
           </center>
        </div>
    </div>
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
            show();
            function show(){
                $.ajax({
                    url : "<?php echo $url ?>admin/get_gambar_id.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {id_gambar:"<?php echo $_GET['id'] ?>"},
                    success : function(data){
                        console.log(data[0].gambar);
                        $('#gbr').attr('src', data[0].gambar);
                    }
                })
            }
        })
    </script>
</body>
</html>