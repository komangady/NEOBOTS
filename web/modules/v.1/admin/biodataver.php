<?php

function biodataver() {
    $data[] = array();

    $data['namefield'][] = 'namalengkap';
    if (empty($_POST['namalengkap'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Nama masih kosong';
    } else {
        $data['statusfield'][] = true;
        $data['msg'][] = '';
        $nama = $_POST['namalengkap'];
    }

    $data['namefield'][] = 'email';
    if (empty($_POST['email'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Email masih kosong';
    } else {
        if (preg_match('/[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $_POST['email'])) {
            $data['statusfield'][] = true;
            $data['msg'][] = '';
            $email = $_POST['email'];
        } else {
            $data['statusfield'][] = false;
            $data['msg'][] = 'Alamat emai tidak valid';
        }
    }

    $data['namefield'][] = 'telepon';
    if (empty($_POST['telepon'])) {
        $data['statusfield'][] = false;
        $data['msg'][] = 'Telepon masih kosong';
    } else {
        $data['statusfield'][] = true;
        $data['namefield'][] = '';
        $telepon = $_POST['telepon'];
    }

    if (in_array(false, $data['statusfield'])) {
        return _display('error.php', $data);
    } else {
        $sql = "UPDATE admin SET nama='" . TagEncode($nama) . "', email='" . TagEncode($email) . "', telepon='" . TagEncode($telepon) . "' WHERE id_admin='" . $_SESSION['user'] . "'";
        $result = customQuery($sql);
        if ($result) {
            echo '
                <div class="alert alert-block alert-success fade in">
					<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
					<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data saved successfully</p>
                </div>
                <script>setTimeout(function(){location.href="?rt='. $_SESSION['tipe'] .'&ctl=ctlbiodata&prog=biodatapersonal";}, 2000);</script>
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
