<?php

function cmbBox($what, $tbname, $cur_vals, $limiter, $cmbname, $blankname) {

    $data['keluaran'] = array();
    $sql = "SELECT ". $what ." FROM " . $tbname;
    $cusomsql = customQuery($sql);

    while ($recdata = mysql_fetch_row($cusomsql)) {
        $data['keluaran'] = array_merge($data['keluaran'], $recdata);
    }

    $data['keluaran'] = array_chunk($data['keluaran'], $limiter);
    $dt['combo'] = make_dropdown_encrypt($data['keluaran'], $cur_vals, $cmbname, '', $blankname);

    return $dt['combo'];
}