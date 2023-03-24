<?php

function combokecamatan() {
    $dataarray['kecamatan'] = array();
    if (isset($_GET['parent'])) {
        $where = "WHERE id_kabupaten='" . $_GET['parent'] . "'";
    } else {
        $where = "";
    }
    $sqlkecamatan = "SELECT id_kecamatan, nama_kecamatan as nama FROM lok_kecamatan " . $where;
    $customkecamatan = customQuery($sqlkecamatan);
    while ($reckecamatan = mysql_fetch_row($customkecamatan)) {
        $dataarray['kecamatan'] = array_merge($dataarray['kecamatan'], $reckecamatan);
    }

    $dataarray['kecamatan'] = array_chunk($dataarray['kecamatan'], 2);
    $data['combo'] = make_dropdown($dataarray['kecamatan'], $_GET['nilai'], "combokecamatan", "form-control", "--Pilih Kecamatan--");
    return _display('umum.php', $content = $data);
}

?>