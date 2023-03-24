<?php
	function babyincubator_objectver()
	{
		$id_babyincubator = $_POST["id_babyincubator"];
		
		$sql = "SELECT * FROM tb_heartbeat WHERE id_babyincubator = '".$id_babyincubator."' ORDER BY input_time DESC LIMIT 1";
		$result = customQuery($sql);
		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);
			$hr = $row["heartbeat_value"];
			$hr_time = $row["input_time"];
		}
		else 
		{
			$hr = 0;
			$hr_time = "0000-00-00 00:00:00";			
		}
		
		$sql = "SELECT * FROM tb_humidity WHERE id_babyincubator = '".$id_babyincubator."' ORDER BY input_time DESC LIMIT 1";
		$result = customQuery($sql);
		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);
			$humdt = $row["humidity_value"];
			$humdt_time = $row["input_time"];	
		}
		else 
		{
			$humdt = 0;
			$humdt_time = "0000-00-00 00:00:00";	
		}
		
		$sql = "SELECT * FROM tb_ldr WHERE id_babyincubator = '".$id_babyincubator."' ORDER BY input_time DESC LIMIT 1";
		$result = customQuery($sql);		
		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);
			$light = $row["ldr_value"];
			$light_time = $row["input_time"];
		}
		else 
		{
			$light = 0;
			$light_time = "0000-00-00 00:00:00";
		}		
		
		$sql = "SELECT * FROM tb_temperature WHERE id_babyincubator = '".$id_babyincubator."' ORDER BY input_time DESC LIMIT 1";
		$result = customQuery($sql);
		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);
			$tmp = $row["temperature_value"];
			$tmp_time = $row["input_time"];
		}
		else 
		{
			$tmp = 0;
			$tmp_time = "0000-00-00 00:00:00";
		}
		
		
		$sql = "SELECT * FROM tb_weight WHERE id_babyincubator = '".$id_babyincubator."' ORDER BY input_time DESC LIMIT 1";
		$result = customQuery($sql);
		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);
			$weight = $row["weight_value"];
			$weight_time = $row["input_time"];
		}
		else
		{
			$weight = 0;
			$weight_time = "0000-00-00 00:00:00";
		}
		
		
		$data = 
		array(
			'id_babyincubator' => $id_babyincubator
			,'hr'=> $hr
			,'humdt'=> $humdt
			,'light'=> $light
			,'tmp'=> $tmp
			,'weight'=> $weight
			,'hr_time'=> $hr_time
			,'humdt_time'=> $humdt_time
			,'light_time'=> $light_time
			,'tmp_time'=> $tmp_time
			,'weight_time'=> $weight_time
		);
		echo json_encode($data);
	}

?>