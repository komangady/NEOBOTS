 <!--<div class="box border green">
    <div class="box-title">
        <h4><i class="fa fa-bars"></i> Hasil Pencarian</h4>
    </div>
    <div class="box-body" style="min-height:350px;">
        <div id="rsts"></div>
        <form action="" method="POST" id="frmKRS" class="form-horizontal">
            <?php
            for ($i = 0; $i < $data['jumlah']; $i++) {
                ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">NIS</label>
                    <div class="col-sm-3">
                        <input type="text" name="nis<?php echo $i ?>" disabled="disabled" class="form-control" value="<?php echo $data['nim' . $i]; ?>">
                    </div>
                    <input type="hidden" name="avt[]" value="<?php echo MyEncrypt($data['nim' . $i]) ?>">
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-3">
                        <input type="text" name="nis<?php echo $i ?>" disabled="disabled" class="form-control" value="<?php echo $data['nama' . $i]; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Aktifkan KRS</label>
                    <div class="col-sm-3">
                        <label class="radio-inline"><input type="checkbox" name="aktif<?php echo $i ?>" class="uniform" value="Y">&nbsp;Ya</label>
                    </div>
                </div>
                <div class="separator"></div>
                <?php
            }
            ?>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div> -->

<script type="text/javascript">
/*     $("#frmKRS").submit(function() {
        $("#rsts").text("Harap Tunggu");
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function(msg) {
                $("#rsts").html(msg);
				//$("#rsts").html('<div class="alert alert-block alert-info fade in"><p><h4><i class="fa fa-check-square-o"></i> Sukses</h4> data Siswa berhasil diubah</p</div>');
				//console.log(msg);
            }
        });
        return false;
    }); */
</script>


<div class="box border green">
    <div class="box-title">
        <h4><i class="fa fa-bars"></i> Hasil Pencarian</h4>
    </div>
    <div class="box-body" style="min-height:350px;">
        <span id="rsts"></span>
       <div class="form-horizontal"> 
            <?php
            for ($i = 0; $i < $data['jumlah']; $i++) {
                ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">NIS</label>
                    <div class="col-sm-3">
                        <input type="text"  id="nis<?php echo $i ?>" name="nis<?php echo $i ?>" disabled="disabled" class="form-control" value="<?php echo $data['nim' . $i]; ?>">
                    </div>
                    <input type="hidden" name="avt[]" value="<?php echo MyEncrypt($data['nim' . $i]) ?>">
					<input type="hidden" id="avtt" name="avtt" value="<?php echo $data['nim' . $i]; ?>">
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-3">
                        <input type="text" name="nis<?php echo $i ?>" disabled="disabled" class="form-control" value="<?php echo $data['nama' . $i]; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Aktifkan KRS</label>
                    <div class="col-sm-3">
                        <label class="radio-inline"><input type="checkbox" id="aktif" name="aktif" class="uniform" value="Y">&nbsp;Ya</label>
                    </div>
                </div>
                <div class="separator"></div>
                <?php
            }
            ?>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <button type="submit" onclick="krs_ubah()" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
      </div> 
    </div>
</div>



<script>
	function krs_ubah()
	{
		$("#rsts").text("Harap Tunggu");
		var checkedValue=$("#aktif").is(":checked");
		var formData = {avtt:$("#avtt").val(), aktif:checkedValue}		
		$.ajax({ 
		  type: 'POST',  
		  url: "templates/v.1.1/siswakrs/siswakrspro.php?action=simpan",
		  data:formData,
		  //terima data	  
		  success: function(){ 
			document.getElementById('rsts').innerHTML='<div class="alert alert-block alert-info fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <p><h4><i class="fa fa-check-square-o"></i> Sukses</h4> data Siswa berhasil diubah</p> </div>';
		  }
		}); 
		return false;
	}
</script>
<?php
if($_GET['action'] == "simpan")
{
	$servername = "localhost";
	$username = "smknbali_ak";
	$password = "Admin Cakep 123*";
	$dbname = "smknbali_ak";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$s = "SELECT CONCAT(RIGHT(Tahun_aktif, 2), Semester_Aktif) as smthaktif FROM settingprogram";
	$result = $conn->query($s);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$th = $row["smthaktif"];
		}
	}
	
	$nm = $_POST["avtt"];
	$aktif = ($_POST['aktif'] == 'true') ? '1' : '2';

	$sql= "UPDATE krs SET `Id_StatusKRS` = '".$aktif."' WHERE `Id_KRS`='".$nm.$th."'";	
	$conn->query($sql);
		
}

?>
