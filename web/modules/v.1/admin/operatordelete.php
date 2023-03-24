<?php
	function operatordelete() {
  
    $id = MyDecrypt($_GET['id']);

    $cek = "SELECT * FROM tb_operator WHERE id_operator='" . $id . "'";
    $resultcek = customQuery($cek);
    $hasil = mysql_num_rows($resultcek);

    if ($hasil > 0) {
        $sql = "DELETE FROM tb_operator WHERE id_operator='" . $id . "'";
        $result = customQuery($sql);

        if ($result) {
			$sql_u = "DELETE FROM user WHERE Id_User='" . $id . "'";
			customQuery($sql_u);
            echo '
					<div class="alert alert-block alert-info fade in">
						<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
						<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data operator delete successfully</p>
					</div>
					<script>setTimeout(function() {location.reload();}, 1500);</script>
					';
        } else {
            echo '
					<div class="alert alert-block alert-danger fade in">
						<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
						<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data operator delete failed!</p>
					</div>
					';
        }
    } else {
        echo '
                <div class="alert alert-block alert-danger fade in">
                    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                    <p><h4><i class="fa fa-warning"></i> ERROR</h4> <b>Error 0x00001 UNKNOWN_ID</b></p>
                </div>
                ';
    }
}
?>