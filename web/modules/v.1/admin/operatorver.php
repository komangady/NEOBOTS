<?php function operatorver() {
    $data = array();
	
   if ($_GET['aksi'] == 'save') {
        $data['namefield'][] = 'id_operator';
        if (empty($_POST['id_operator'])) {
            $data['statusfield'][] = false;
            $data['msg'][] = 'ID Operator Empty! ';
        } else {
			$sql = "SELECT * FROM tb_operator WHERE id_operator = '".$id_operator."'";
			$result = customQuery($sql);
			if(mysql_num_rows($result) > 0)
			{
				$data['statusfield'][] = false;
				$data['msg'][] = 'ID Operator is Already!';
			}
			else 
			{
				$data['statusfield'][] = true;
				$data['msg'][] = '';
				$id_operator = $_POST['id_operator'];
			}
        }
    }

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
	
	$data['namefield'][] = 'operator_status';
    if (empty($_POST['operator_status'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Choose One Status!';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $operator_status = $_POST['operator_status'];
		if($operator_status == '2')
		{
			$operator_status = '0';
		}
    }
	
	$id_babyincubator = '';
	if(!empty($_POST['id_babyincubator'])) {    
        foreach($_POST['id_babyincubator'] as $value){
			$id_babyincubator .= $value."//";
        }
    }

	if($_GET['aksi'] == 'save')
	{
		$foto = $_FILES['foto'];
		$filetype = $_FILES["foto"]["type"];
		if($foto["error"] != 4)
		{
			if($filetype != "image/jpeg" && $filetype != "image/jpg")
			{
				$data['namefield'][] = 'foto';		
				$data['statusfield'][] = false;
				$data['msg'][] = "Filetype must jpeg or jpg"; 
			}else{
				chdir("picpegawai");			
				move_uploaded_file($foto['tmp_name'],$id_operator."_".$foto['name']);			
				resize_image('500' , $id_operator."_".$foto['name'], $id_operator."_".$foto['name']);
				$foto_name = $id_operator."_".$foto['name'];
			}
		}
		else{
			$foto_name = "no foto.png";
		}
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
        if ($_GET['aksi'] == 'save') {
            $DATENOW = date("Y-m-d H:i:s");
            $sql = "INSERT INTO tb_operator
                   (
				   id_operator, 
				   id_babyincubator, 
				   operator_name,
				   operator_handphone, 
				   operator_address, 
				   operator_image, 
				   operator_status, 
				   input_time)
                   VALUES
                   (
				   '" . $id_operator . "', 
				   '" . $id_babyincubator . "', 
				   '" . $operator_name . "', 
				   '" . $operator_handphone . "', 
				   '" . $operator_address . "', 
				   '" . $operator_image . "', 
				   '" . $operator_status . "', 
				   '" . $DATENOW . "')";
            $result = customQuery($sql);

            if ($result) {
                $password = md5("123456");
                $sqlu = "INSERT INTO user (Id_User, Password, Identitas, JenisUser, Username) VALUE "
                        . "('" . $id_operator . "', '" . $password . "', '" . $operator_name . "', 'operator', '" . $id_operator . "')";
                $result = customQuery($sqlu);
                if ($result) {
                    echo '
            		<div class="alert alert-block alert-info fade in">
                                <span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
                                <p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data save successfully</p>
            		</div>
					<script>setTimeout(function(){location.reload();}, 2000);</script>
            		';
                } else {
                    echo '
                    <div class="alert alert-block alert-danger fade in">
                        <span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
                        <p><h4><i class="fa fa-check-square-o"></i> Failed</h4> User operator save failed</p>
                    </div>
                    ';
                }
            } else {
                echo '
					<div class="alert alert-block alert-danger fade in">
						<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
						<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data save failed</p>
					</div>
					';
            }
        } elseif ($_GET['aksi'] == 'edit') {
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
							   id_babyincubator = '".$id_babyincubator."',
							   operator_name = '".$operator_name."',
							   operator_handphone = '".$operator_handphone."', 
							   operator_address = '".$operator_address."', 
							   operator_image = '".$foto_name."', 
							   operator_status = '".$operator_status."'
							WHERE id_operator='" . $id_operator . "'
					";
						
				}
				else{
					$sql = "UPDATE tb_operator SET                       
							   id_babyincubator = '".$id_babyincubator."',
							   operator_name = '".$operator_name."',
							   operator_handphone = '".$operator_handphone."', 
							   operator_address = '".$operator_address."', 
							   operator_status = '".$operator_status."'
							WHERE id_operator='" . $id_operator . "'
					";
				}
				$result = customQuery($sql);

				if ($result) {					
					echo '
						<div class="alert alert-block alert-success fade in">
							<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
							<p><h4><i class="fa fa-check-square-o"></i> success</h4> Data Operator Update : <strong>'.$id_operator.'</strong></p>
						</div>
						<script>setTimeout(function(){location.reload();}, 2000);</script>
						';
				} else {
					echo '
						<div class="alert alert-block alert-danger fade in">
							<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
							<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data Operator Update Failed</p>
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