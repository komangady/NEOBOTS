<?php
	function babyincubator_object_detaildelete() {
  
    $id = MyDecrypt($_GET['id']);
	$id = explode("//", $id);

    $cek = "SELECT * FROM tb_".$id[1]." WHERE id_".$id[1]."='" . $id[0] . "'";
    $resultcek = customQuery($cek);
    $hasil = mysql_num_rows($resultcek);

    if ($hasil > 0) {
        $sql = "DELETE FROM tb_".$id[1]." WHERE id_".$id[1]." ='" . $id[0] . "'";
        $result = customQuery($sql);

        if ($result) {
			
            echo '
					<div class="alert alert-block alert-info fade in">
						<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
						<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Data delete successfully</p>
					</div>
					<script>setTimeout(function() {location.reload();}, 1500);</script>
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
                    <p><h4><i class="fa fa-warning"></i> ERROR</h4> <b>Error 0x00001 UNKNOWN_ID </b></p>
                </div>
                ';
    }
}
?>