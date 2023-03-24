<?php
function combokabupaten()
{
	$dataarray['kabupaten']=array();
	if(isset($_GET['parent']))
	{
		$where = "WHERE id_provinsi='".$_GET['parent']."'";
	}
	else
	{
		$where = "";
	}
	
	$sqlkabupaten="SELECT id_kabupaten, nama_kabupaten as nama FROM lok_kabupaten ".$where;
	$customkabupaten = customQuery($sqlkabupaten);
	while($reckabupaten = mysql_fetch_row($customkabupaten)){
		$dataarray['kabupaten']=array_merge($dataarray['kabupaten'],$reckabupaten);
	}
	
	$dataarray['kabupaten']=array_chunk($dataarray['kabupaten'],2);
	$data['combo'] = make_dropdown($dataarray['kabupaten'],$_GET['nilai'],"combokabupaten","form-control","--Pilih Kabupaten--");
	$data['addscript']  = "
	<script>
			 $('#combokabupaten').change(function(){
					$('#divkecamatan').load('?rt=umum&ctl=ctlumum&prog=combokecamatan&parent='+$('#combokabupaten').val());
			   });
	</script>
	";
	return _display('umum.php',$content=$data);
}
?>