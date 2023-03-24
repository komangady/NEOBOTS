<?php function mp() {
    $data = array();
	
	$sql ="SELECT * FROM tb_operator WHERE id_operator = '".$_SESSION['user']."'";
	$result = customQuery($sql);
	$row = mysql_fetch_assoc($result);
	$id_babyincubator = $row["id_babyincubator"];
	$id_babyincubator = explode("//", $id_babyincubator);

	$dt = '';
	foreach($id_babyincubator as $value){
		if(!empty($value) and isset($value))
		{			
			$sql = "SELECT * FROM tb_babyincubator WHERE id_babyincubator = '".$value."' ORDER BY input_time DESC";
			$result = customQuery($sql);			
			while($row = mysql_fetch_assoc($result))
			{
				$dt .= '
					<div class="col-md-12 col-lg-3">
						<div class="white-box">
							<div class="user-bg"> 
								<div class="overlay-box">
									<div class="user-content">
										<a href="javascript:void(0)"></a>
										<a href="?rt='. $_SESSION['tipe'] .'&ctl=ctlmaster&prog=babyincubator_object&var='.MyEncrypt($row["id_babyincubator"]).'" target="_blank">
											<h2 class="text-white"><strong>'.$row["id_babyincubator"].'</strong></h2>
											<h4 class="text-white"><strong>'.strtoupper($row["babyincubator_name"]).'</strong></h4>
										</a>
										<hr style="height:1.5px;border:none;color:#fff;background-color:#fff;">
									</div>
								</div>
							</div>
							<div class="user-btm-box">
								<div class="row">
									<div class="col-md-6 col-sm-6 text-center">
										<p class="text-purple"><i class="fa fa-thermometer-half" aria-hidden="true"></i> Tmp.</p>
										<h1><span id="tmp_'.$row["id_babyincubator"].'"></span></h1>
										<h6><span id="tmp_time_'.$row["id_babyincubator"].'"></span></h6>
										<br>
										<br>
									</div>
									<div class="col-md-6 col-sm-6 text-center">
										<p class="text-blue"><i class="fa fa-sun-o" aria-hidden="true"></i> Humdt.</p>
										<h1><span id="humdt_'.$row["id_babyincubator"].'"></span></h1>
										<h6><span id="humdt_time_'.$row["id_babyincubator"].'"></span></h6>
										<br>
										<br>
									</div>
									<div class="col-md-4 col-sm-4 text-center">
										<p class="text-success"><i class="fa fa-heartbeat" aria-hidden="true"></i> HR.</p>
										<h1><span id="hr_'.$row["id_babyincubator"].'"></span></h1>
										<h6><span id="hr_time_'.$row["id_babyincubator"].'"></span></h6>
									</div>
									<div class="col-md-4 col-sm-4 text-center">
										<p class="text-danger"><i class="fa fa-cube" aria-hidden="true"></i> Weight</p>
										<h1><span id="weight_'.$row["id_babyincubator"].'"></span></h1>
										<h6><span id="weight_time_'.$row["id_babyincubator"].'"></span></h6>
									</div>
									<div class="col-md-4 col-sm-4 text-center">
										<p class="text-warning"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Light</p>
										<h1><span id="light_'.$row["id_babyincubator"].'"></span></h1>
										<h6><span id="light_time_'.$row["id_babyincubator"].'"></span></h6>
									</div>
									
									<div class="stats-row col-md-12 m-t-20 m-b-0 text-center">
										<hr style="height:2px;border:none;color:#333;background-color:#333;">
									</div>							
								</div>
							</div>
						</div>
					</div>
					
					<script>
						setInterval(
							function(){ 
								var FormData = {id_babyincubator: "'.$row["id_babyincubator"].'"}
								$.ajax({
									type: "POST",
									url: "?rt='.$_SESSION["tipe"].'&ctl=ctl&prog=mpver",
									data: FormData,
									success: function(msg) {
										var data = JSON.parse(msg);
										console.log(data)
										$("#tmp_'.$row["id_babyincubator"].'").html(data.tmp);
										$("#humdt_'.$row["id_babyincubator"].'").html(data.humdt);
										$("#hr_'.$row["id_babyincubator"].'").html(data.hr);	
										$("#weight_'.$row["id_babyincubator"].'").html(data.weight);
										$("#light_'.$row["id_babyincubator"].'").html(data.light);	

										$("#tmp_time_'.$row["id_babyincubator"].'").html(data.tmp_time);
										$("#humdt_time_'.$row["id_babyincubator"].'").html(data.humdt_time);
										$("#hr_time_'.$row["id_babyincubator"].'").html(data.hr_time);	
										$("#weight_time_'.$row["id_babyincubator"].'").html(data.weight_time);
										$("#light_time_'.$row["id_babyincubator"].'").html(data.light_time);
									}
								});
								return false;
							}, 4000);
					</script>	
				';
				
			}
		}
	}
	
	
    $data['isi'] = $dt;
    $data['css'] = ''; 
    $data['js'] = '';
    $data['menu'] = '1';
    $data['sitemap'] = '
		<li class="active"><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctl&prog=mp">Dashboard</a></li>
	';
    $data['title'] = 'Dashboard';     
    return _display('main.php', $content = $data);
}?>