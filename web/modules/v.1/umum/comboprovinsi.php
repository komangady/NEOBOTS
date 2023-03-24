<?php

function comboprovinsi() {
    if (isset($_GET['parent'])) {
        $where = "WHERE lokasi_negara='" . $_GET['parent'] . "'";
    } else {
        $where = "WHERE lokasi_negara='100'";
    }
    $dataarray['provinsi'] = array();
    $sqlprovinsi = "SELECT id_provinsi, nama_provinsi as nama FROM lok_provinsi " . $where;
    $customprovinsi = customQuery($sqlprovinsi);
    while ($recprovinsi = mysql_fetch_row($customprovinsi)) {
        $dataarray['provinsi'] = array_merge($dataarray['provinsi'], $recprovinsi);
    }
    $dataarray['provinsi'] = array_chunk($dataarray['provinsi'], 2);
    $data['combo'] = make_dropdown($dataarray['provinsi'], $_GET['nilai'], "comboprovinsi", "form-control", "--Pilih--");

    $data['addscript'] = "
	<script>
			 $('#comboprovinsi').change(function(){
					$('#divkabupaten').load('?rt=umum&ctl=ctlumum&prog=combokabupaten&parent='+$('#comboprovinsi').val());
					$('#divkecamatan').load('?rt=umum&ctl=ctlumum&prog=combokosong');
			   });
	</script>
	";
    return _display('umum.php', $content = $data, '');
}

?>