<?php function babyincubatorver() {
    $data = array();

   if ($_GET['aksi'] == 'simpan') {
        $data['namefield'][] = 'id_babyincubator';
        if (empty($_POST['id_babyincubator'])) {
            $data['statusfield'][] = false;
            $data['msg'][] = 'ID Incubator Empty!';
        } else {
            $id_babyincubator = $_POST["id_babyincubator"];
			$sql = "SELECT * FROM tb_babyincubator WHERE id_babyincubator = '".$id_babyincubator."'";
			$result = customQuery($sql);
			if(mysql_num_rows($result) > 0)
			{
				$data['statusfield'][] = false;
				$data['msg'][] = 'ID Incubator is Already!';
			}
			else 
			{
				$data['statusfield'][] = true;
				$data['msg'][] = '';
				$id_babyincubator = $_POST['id_babyincubator'];
			}
        }
    }

    $data['namefield'][] = 'babyincubator_name';
    if (empty($_POST['babyincubator_name'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Name Empty!';
    } else {
        if (strlen($_POST['babyincubator_name']) <= 100) {
            $data['statusfield'][] = true;
            $data['msg'][] = '';
            $babyincubator_name = TagEncode($_POST['babyincubator_name']);
        } else {
            $data['statusfield'][] = false;
            $data['msg'][] = 'Name must less < 100!';
        }
    }
	
    if (in_array(false, $data['statusfield'])) {
        return _display('error.php', $data);
    } else {
        if ($_GET['aksi'] == 'simpan') {
            $DATENOW = date("Y-m-d H:i:s");
            $sql = "INSERT INTO tb_babyincubator
                   (
				   id_babyincubator, 
				   babyincubator_name,
				   input_time)
                   VALUES
                   (
				   '" . $id_babyincubator . "', 
				   '" . $babyincubator_name . "',
				   '" . $DATENOW . "')";
            $result = customQuery($sql);

            if ($result) {
               echo '
				<div class="alert alert-block alert-info fade in">
					<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
					<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data save successfully</p>
				</div>
				<script>setTimeout(function(){location.href = "?rt='.$_SESSION["tipe"].'&ctl=ctlmaster&prog=babyincubator";}, 2000);</script>
				';
            } else {
                echo '
					<div class="alert alert-block alert-danger fade in">
						<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
						<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data delete failed!</p>
					</div>
					';
            }
        } elseif ($_GET['aksi'] == 'edit') {
            $id = MyDecrypt($_GET['id']);
            $sql = "SELECT * FROM tb_babyincubator WHERE id_babyincubator='" . $id . "'";
            $result = customQuery($sql);
			$baris = mysql_fetch_assoc($result);
            $hasil = mysql_num_rows($result);

            if (!empty($id) or $hasil > 0) {				
				$sql = "UPDATE tb_babyincubator SET                       
					babyincubator_name='" . $babyincubator_name . "'
				WHERE id_babyincubator='" . $id . "'
				";				
				$result = customQuery($sql);

				if ($result) {					
					echo '
						<div class="alert alert-block alert-success fade in">
							<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
							<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data update successfully</p>
						</div>
						<script>setTimeout(function(){location.reload();}, 2000);</script>
						';
				} else {
					echo '
						<div class="alert alert-block alert-danger fade in">
							<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
							<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data update failed</p>
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