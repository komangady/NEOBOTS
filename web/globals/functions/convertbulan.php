<?php

function convertbulan($date) {
    $bulan = array ('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $date = explode("-", $date);
    $datenew = $date[2] . ' ' . $bulan[(int) $date[1]] . ' ' . $date[0];
    
    return $datenew;
}