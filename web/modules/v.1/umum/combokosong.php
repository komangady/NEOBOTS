<?php
function combokosong()
{
	$dataarray['kosong']=array();
	
	$data['combo'] = make_dropdown($dataarray['kosong'],"","","form-control","--Pilih--");
	return _display('umum.php',$content=$data);
}
?>