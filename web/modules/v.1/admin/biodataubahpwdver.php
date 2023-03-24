<?php 
	function biodataubahpwdver() {
    $data = array();

    $data['namefield'][] = 'password';
    if (empty($_POST['password'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Password cannot be empty!';
    } else {
        $sqlp = "SELECT * FROM user WHERE Id_User='" . $_SESSION['user'] . "'";
        $result = customQuery($sqlp);
        $hasil = mysql_fetch_array($result);

        if (md5($_POST['password']) == $hasil['Password']) {
            $data['statusfield'][] = true;
            $data['msg'][] = '';
        } else {
            $data['statusfield'][] = false;
            $data['msg'][] = 'Password yang diinputkan salah';
        }
    }

    $data['namefield'][] = 'passwordbaru';
    if (empty($_POST['passwordbaru'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Password cannot be empty';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $passbaru = TagDecode($_POST['passwordbaru']);
    }

    $data['namefield'][] = 'repasswordbaru';
    if (empty($_POST['repasswordbaru'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Password cannot be empty';
    } else {
        if ($passbaru == $_POST['repasswordbaru']) {
            $data['statusfield'][] = true;
            $data['msg'][] = '';
            $password = TagEncode($_POST['repasswordbaru']);
        } else {
            $data['statusfield'][] = false;
            $data['msg'][] = 'The password entered is not the same';
        }
    }

    if (in_array(false, $data['statusfield'])) {
        return _display('error.php', $data);
    } else {
                $sql = "UPDATE user SET Password='" . md5($password) . "' WHERE Id_User='" . $_SESSION['user'] . "'";
				$result = customQuery($sql);

        if ($result) {
            echo '
				<div class="alert alert-block alert-success fade in">
					<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
						<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data saved successfully</p>
				</div>
				<script>setTimeout(function(){location.href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal";}, 2000);</script>
				';
        } else {
            echo '
				<div class="alert alert-block alert-danger fade in">
					<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
						<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data failed to save</p>
				</div>
				';
        }
    }
}
?>