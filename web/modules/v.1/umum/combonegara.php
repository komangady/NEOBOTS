<?php
function combonegara()
{
	$dataarray['negara']=array();
	$sqlnegara = "SELECT lokasi_negara, country_name FROM lok_negara ";
	$customnegara = customQuery($sqlnegara);
	while($recnegara = mysql_fetch_row($customnegara)){
		$dataarray['negara']=array_merge($dataarray['negara'],$recnegara);
	}
	$dataarray['negara']=array_chunk($dataarray['negara'],2);
	$data['combo']=make_dropdown($dataarray['negara'],$_GET['nilai'],"combonegara","form-control","--Pilih Negara--");
	
	$data['addscript']  = "
	<script>
			 $('#combonegara').change(function(){
					$('#divprovinsi').load('?rt=umum&ctl=ctlumum&prog=comboprovinsi&parent='+$('#combonegara').val());
					$('#divkabupaten').load('?rt=umum&ctl=ctlumum&prog=combokosong');
					$('#divkecamatan').load('?rt=umum&ctl=ctlumum&prog=combokosong');
			   });
	</script>
	";
	return _display('umum.php',$content=$data,'');
}
?>