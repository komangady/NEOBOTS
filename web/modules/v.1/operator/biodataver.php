<?php function biodataver() {
    $data = array();
	
    $data['namefield'][] = 'operator_name';
    if (empty($_POST['operator_name'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Name Empty!';
    } else {
		$data['statusfield'][] = true;
		$data['msg'][] = '';
		$operator_name = $_POST['operator_name'];
    }
	
    $data['namefield'][] = 'operator_handphone';
    if (empty($_POST['operator_handphone'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Handphone Empty!';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $operator_handphone = $_POST['operator_handphone'];
    } 
		
	$data['namefield'][] = 'operator_address';
    if (empty($_POST['operator_address'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Address Empty!';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $operator_address = $_POST['operator_address'];
    }
	
	if($_GET['aksi'] == 'edit'){
		$foto = $_FILES['foto'];
		$filetype = $_FILES["foto"]["type"];
		if($filetype != "image/jpeg" && $filetype != "image/jpg")
		{
			if($foto["error"] != 4) {
				$data['namefield'][] = 'foto';		
				$data['statusfield'][] = false;
				$data['msg'][] = "File Type harus jpeg atau jpg"; 
			}				
		}
	}
	
    if (in_array(false, $data['statusfield'])) {
        return _display('error.php', $data);
    } else {
        if ($_GET['aksi'] == 'edit') {
            $id_operator = MyDecrypt($_GET['id']);
            $sql = "SELECT * FROM tb_operator WHERE id_operator='" . $id_operator . "'";
            $result = customQuery($sql);
			$row = mysql_fetch_assoc($result);

            if (!empty($id_operator) and (mysql_num_rows($result) > 0)) {
				if($_FILES["foto"]["error"] != 4) {
					$foto = $_FILES['foto'];
					unlink("picpegawai/".$baris['foto']);
					
					chdir("picpegawai/");			
					move_uploaded_file($foto['tmp_name'],$id_operator."_".$foto['name']);			
					resize_image('500' , $id_operator."_".$foto['name'], $id_operator."_".$foto['name']);
					$foto_name = $id_operator."_".$foto['name'];
					
					$sql = "UPDATE tb_operator SET  
							   operator_name = '".$operator_name."',
							   operator_handphone = '".$operator_handphone."', 
							   operator_address = '".$operator_address."', 
							   operator_image = '".$foto_name."'
							WHERE id_operator='" . $id_operator . "'
					";
						
				}
				else{
					$sql = "UPDATE tb_operator SET                       
							   operator_name = '".$operator_name."',
							   operator_handphone = '".$operator_handphone."', 
							   operator_address = '".$operator_address."'
							WHERE id_operator='" . $id_operator . "'
					";
				}
				$result = customQuery($sql);

				if ($result) {					
					echo '
						<div class="alert alert-block alert-success fade in">
							<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
							<p><h4><i class="fa fa-check-square-o"></i> success</h4> Data Biodata Update : <strong>'.$id_operator.'</strong></p>
						</div>
						<script>setTimeout(function(){location.reload();}, 2000);</script>
						';
				} else {
					echo '
						<div class="alert alert-block alert-danger fade in">
							<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
							<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data Biodata Update Failed</p>
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