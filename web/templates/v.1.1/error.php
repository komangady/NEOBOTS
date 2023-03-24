<?php
	$no =0;
	$scriptjs = '<script type="text/javascript">
	$(document).ready(function(){';
	foreach($data['namefield'] as $namafield){
		if(!$data['statusfield'][$no]){ //jika salah validatsinya
			$scriptjs .= "$('#msg_".$namafield."').html('".$data['msg'][$no]."').css({'color':'red','font-size':'11px'});";
			
		}else{
			$scriptjs .= "$('#msg_".$namafield."').empty();";
			
		}
		$no++;
	};
	$scriptjs .= '
	});
	</script>';
	echo $scriptjs;
	echo $data['addjs'];	 
	
?>
