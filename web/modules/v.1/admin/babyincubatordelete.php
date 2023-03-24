<?php
	function babyincubatordelete() {
  
    $id = MyDecrypt($_GET['id']);

    $cek = "SELECT * FROM tb_babyincubator WHERE id_babyincubator='" . $id . "'";
    $resultcek = customQuery($cek);
    $hasil = mysql_num_rows($resultcek);

    if ($hasil > 0) {
        $sql = "DELETE FROM tb_babyincubator WHERE id_babyincubator ='" . $id . "'";
        $result = customQuery($sql);

        if ($result) {
			
            echo '
					<div class="alert alert-block alert-info fade in">
						<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
						<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data delete successfully</p>
					</div>
					<script>setTimeout(function() {location="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubatordata"}, 1500);</script>
					';
        } else {
            echo '
					<div class="alert alert-block alert-danger fade in">
						<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
						<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Data failed to delete!</p>
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