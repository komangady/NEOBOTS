<?php
function voperatorpwd() {
    $data = array();

    $data['namefield'][] = 'id_operator';
    if (empty($_POST['id_operator'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'ID Empty!';
    } else {
        $idp = explode(" -- ", $_POST['id_operator']);
        $idp = trim($idp[0]);
        
        $sql = "SELECT * FROM tb_operator WHERE id_operator='" . $idp . "'";
        $result = customQuery($sql);

        if (mysql_num_rows($result) <= 0) {
            $data['statusfield'][] = false;
            $data['msg'][] = 'ID not available!';
        } else {
            $data['statusfield'][] = true;
            $data['msg'][] = '';
            $id_operator = TagEncode($_POST['id_operator']);
			$idp = explode(" -- ", $_POST['id_operator']);
			$idp = trim($idp[0]);
        }
    }

    $data['namefield'][] = 'password';
    if (empty($_POST['password'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Password Empty!';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $password = $_POST['password'];
    }

    $data['namefield'][] = 'repassword';
    if (empty($_POST['repassword'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Re-Password Empty!';
    } else {
        if ($password == $_POST['repassword']) {
            $data['statusfield'][] = true;
            $data['msg'][] = '';
            $repassword = TagEncode($_POST['repassword']);
        } else {
            $data['statusfield'][] = false;
            $data['msg'][] = 'Password you typed is not the same!';
        }
    }

    if (in_array(false, $data['statusfield'])) {
        return _display('error.php', $data);
    } else {
                $sql = "UPDATE user SET Password='" . md5($repassword) . "' WHERE Id_User='" . $idp . "' and JenisUser='operator'";
        $result = customQuery($sql);
        if ($result) {
            echo '
				<div class="alert alert-block alert-success fade in">
					<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
					<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data password update successfully!</p>
				</div>
				<script>
					setTimeout(function(){ location.reload(); }, 2000);
				</script>
		';
        } else {
            echo '
		<div class="alert alert-block alert-danger fade in">
                    <span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
                    <p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data update failed!</p>
		</div>
		';
        }
    }
}
?>