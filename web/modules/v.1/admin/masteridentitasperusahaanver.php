<?php function masteridentitasperusahaanver() {
    $data = array();

    $data['idk_namaperusahaan'][] = 'idk_namaperusahaan';
    if (empty($_POST['idk_namaperusahaan'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Nama cannot be empty';
    } else {
		$data['statusfield'][] = true;
		$data['msg'][] = '';
		$idk_namaperusahaan = TagEncode($_POST['idk_namaperusahaan']);
    }

	$data['namefield'][] = 'idk_alamat';
    if (empty($_POST['idk_alamat'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Alamat cannot be empty';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $idk_alamat = TagEncode($_POST['idk_alamat']);
    }	
	
	$data['namefield'][] = 'idk_telepon';
    if (empty($_POST['idk_telepon'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Telepon cannot be empty';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $idk_telepon = TagEncode($_POST['idk_telepon']);
    }	
	
	$data['namefield'][] = 'idk_email';
    if (empty($_POST['idk_email'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Email cannot be empty';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $idk_email = TagEncode($_POST['idk_email']);
    }
	
	$data['namefield'][] = 'idk_website';
    if (empty($_POST['idk_website'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Website cannot be empty';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $idk_website = TagEncode($_POST['idk_website']);
    }		
   
	$idk_logogambar = $_FILES['idk_logogambar'];
	$filetype = $_FILES["idk_logogambar"]["type"];
	if($filetype != "image/png")
	{
		if($idk_logogambar["error"] != 4) {
			$data['namefield'][] = 'idk_logogambarrespon';		
			$data['statusfield'][] = false;
			$data['msg'][] = "File Type must png"; 
		}				
	}
		
	
    if (in_array(false, $data['statusfield'])) {
        return _display('error.php', $data);
    } else {
        if ($_GET['aksi'] == 'edit') {
            $id = MyDecrypt($_GET['id']);
            $sql = "SELECT * FROM master_identitasperusahaan WHERE id='" . $id . "'";
            $result = customQuery($sql);
			$baris = mysql_fetch_assoc($result);
            $hasil = mysql_num_rows($result);

            if (!empty($id) && $hasil > 0 ) {
				if($_FILES["idk_logogambar"]["error"] != 4 and $_FILES["idk_logotext"]["error"] != 4) {
					$foto = $_FILES['idk_logogambar'];
					unlink("picperusahan/".$baris['idk_logogambar']);		
					move_uploaded_file($foto['tmp_name'],"picperusahan/".$id."_logogambar".$foto['name']);			
					resize_image('500' , $id."_logogambar".$foto['name'], $id."_logogambar".$foto['name']);
					$idk_logogambar = $id."_logogambar".$foto['name'];
										
					$query_tambah = "
						,
						idk_logogambar = '".$idk_logogambar."',
						idk_logotext = ''
					";
				}
				else if($_FILES["idk_logogambar"]["error"] != 4)
				{
					$foto = $_FILES['idk_logogambar'];
					unlink("picperusahan/".$baris['idk_logogambar']);		
					move_uploaded_file($foto['tmp_name'],"picperusahan/".$id."_logogambar".$foto['name']);			
					resize_image('500' , $id."_logogambar".$foto['name'], $id."_logogambar".$foto['name']);
					$idk_logogambar = $id."_logogambar".$foto['name'];
					
					$query_tambah = "
						,
						idk_logogambar = '".$idk_logogambar."'
					";
				}
				else
				{
					$query_tambah = "";
				}					
				
				$sql = "UPDATE master_identitasperusahaan SET           
					idk_namaperusahaan = '".$idk_namaperusahaan."',
					idk_alamat  = '".$idk_alamat."', 
					idk_telepon  = '".$idk_telepon."', 
					idk_email  = '".$idk_email."', 
					idk_website  = '".$idk_website."'
					".$query_tambah."
				WHERE id='" . $id . "'
				";
				$result = customQuery($sql);

				if ($result) {					
					echo '
						<div class="alert alert-block alert-primary fade in">
							<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
							<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data saved successfully</p>
						</div>
						<script>setTimeout(function(){location.reload();}, 2000);</script>
						';
				} else {
					echo '
						<div class="alert alert-block alert-danger fade in">
							<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
							<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data failed to save</p>
						</div>
						';
				}
            } elseif ($hasil <= 0) {
                echo '
                <div class="alert alert-block alert-danger fade in">
                    <span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
                    <p><h4><i class="fa fa-warning"></i> ERROR</h4> <b>Error 0x00001 UNKNOWN_ID</b></p>
                </div>
                ';
            } else {
                echo '
                <div class="alert alert-block alert-danger fade in">
                    <span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>

                    <p><h4><i class="fa fa-warning"></i> ERROR</h4> <b>Error 0x00002 UNKNOWN_ID</b></p>
                </div>
                ';
            }
        } else {
            echo '
                <div class="alert alert-block alert-danger fade in">
                    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                    <p><h4><i class="fa fa-warning"></i> ERROR</h4> <b>Error 0x00003 EDITED_URL</b></p>
                </div>
                ';
        }
    }
} ?>