<?php
function masteridentitasperusahaan() {
    $data = array();

	$sql = "SELECT * FROM master_identitasperusahaan";
	$result = customQuery($sql);
	$hasil = mysql_fetch_array($result);

	$sqlw = "SELECT * FROM lok_kecamatan INNER JOIN lok_kabupaten USING (Id_Kabupaten) INNER JOIN lok_provinsi USING (Id_Provinsi) WHERE Id_Kecamatan='". $hasil['Id_Kecamatan'] ."'";
	$resultw = customQuery($sqlw);
	$wil = mysql_fetch_array($resultw);
	
	$url       			 = '?rt='.$_SESSION["tipe"].'&ctl=ctlmaster&prog=masteridentitasperusahaanver&aksi=edit&id=' . MyEncrypt($hasil["id"]);
	$idk_namaperusahaan	 = $hasil["idk_namaperusahaan"];		
	$idk_alamat	 		 = $hasil["idk_alamat"];
	$idk_telepon		 = $hasil["idk_telepon"];	
	$idk_email  		 = $hasil["idk_email"];		
	$idk_website	     = $hasil["idk_website"];
	$idk_logogambar	     = $hasil["idk_logogambar"];	
	
	$data['menu']='5';
	$data['sitemap'] = '
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=masteridentitasperusahaan">Master</a></li>			
		<li class="active">Data System Information</li>
	';	
	$data['title']='System Information';
  

    $data['isi'] = '
	<div class="col-md-12">
		<div class="panel panel-warning">
			<div class="panel-heading">Data System Information</div>
			<div class="panel-body">
				<div class="media">					
					<div class="media-body">
						<div id="hasil"></div>
						<form data-toggle="validator" id="frmIdentitasperusahaan" name="frmIdentitasperusahaan" method="POST" action="'. $url .'" method="post">
												
							<div class="form-group">
								<label class="col-sm-2 control-label">System Name</label>
								<div class="col-sm-10">
									<input type="text" name="idk_namaperusahaan" class="form-control"  value="'. $idk_namaperusahaan .'"> <font id="msg_idk_namaperusahaan"></font>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Phone</label>
								<div class="col-sm-5">
									<input type="text" name="idk_telepon" id="idk_telepon"  class="form-control" value="'. $idk_telepon .'"><font id="msg_idk_telepon"></font>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Email </label>
								<div class="col-sm-5">
									<input type="email" name="idk_email" class="form-control"  value="'. $idk_email .'"> <font id="msg_ang_pekerjaan"></font>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Website </label>
								<div class="col-sm-10">
									<input type="text" name="idk_website" class="form-control"  value="'. $idk_website .'"> <font id="msg_idk_website"></font>
								</div>
							</div>							

							<div class="form-group">
								<label class="col-sm-2 control-label">Address </label>
								<div class="col-sm-10">
									<input type="text" name="idk_alamat" class="form-control"  value="'. $idk_alamat .'"> <font id="msg_idk_alamat"></font>
								</div>
							</div>
														
							<div class="form-group">
								<label class="col-sm-10 control-label">Logo</label>
								<label class="col-sm-10 text-info">*PNG Format</label>	
								<div class="col-sm-10">
									<input type="file" name="idk_logogambar" class="form-control" > <font id="msg_idk_logogambarrespon"></font>
									<img src="picperusahan/'.$idk_logogambar.'" class="img-rounded" alt="Cinque Terre" width="200">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
									<button type="submit" class="btn btn-primary">Save</button>								
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	';
	$data['css'] = '
		<link rel="stylesheet" href="js/trumbowyg/ui/trumbowyg.min.css">
	';
    $data['js'] = '
		<script src="js/trumbowyg/trumbowyg.min.js"></script>

        <script type="text/javascript">
			$("#idk_deskripsi").trumbowyg();
			$("#idk_adart").trumbowyg();
		
			$("#frmIdentitasperusahaan").submit(function() {
                $(\'html, body\').animate({ scrollTop : 0}, \'slow\');
                $("#hasil").text("Harap tunggu...");
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
                    success: function(msg) {
                        $("#hasil").html(msg);
						
                    }
                });
                return false;
            });
        </script>
    ';

  
    return _display('main.php', $content = $data);
}

?>