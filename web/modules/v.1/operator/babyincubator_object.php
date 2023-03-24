<?php function babyincubator_object() {
    $data = array();
	$id_babyincubator = MyDecrypt($_GET["var"]);
	$sql = "SELECT * FROM tb_babyincubator WHERE id_babyincubator = '".$id_babyincubator."'";
	$result = customQuery($sql);
	$row = mysql_fetch_assoc($result);	
	$babyincubator_name = $row["babyincubator_name"];
	
	if(empty($id_babyincubator) or !isset($id_babyincubator) or (mysql_num_rows($result) < 1))
	{
		header("location:./");
	}
	
	$dt_modal_object = '';
	$array_obj = array("temperature", "humidity", "heartbeat", "weight", "ldr");
	for($x = 0; $x < 5; $x++)
	{
		$dt_modal_object .= '
			<!-- =========================== START Modal Details  ======== -->
			<div class="modal fade" id="'.$array_obj[$x].'_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><strong>'.strtoupper($array_obj[$x]).'</strong></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form data-toggle="validator" id="form'.$array_obj[$x].'" name="form'.$array_obj[$x].'" method="POST" action="?rt='.$_SESSION["tipe"].'&ctl=ctlmaster&prog=babyincubator_object_detailsver&var='.MyEncrypt($id_babyincubator).'&tb='.MyEncrypt($array_obj[$x]).'" method="post">
							<div class="form-group">
								<label class="col-sm-12 control-label">Start Date</label>
								<div class="col-sm-12">
									<input type="text" name="start_date" class="form-control" id="'.$array_obj[$x].'_start_date" required> 
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-12 control-label">End Date</label>
								<div class="col-sm-12">
									<input type="text" name="end_date" class="form-control" id="'.$array_obj[$x].'_end_date" required> 
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-10">
									<button type="submit" name="submit" class="btn btn-primary">Search</button>									
								</div>
							</div>
						</form>
						
						<hr>
						
						<span id="result_details_'.$array_obj[$x].'"></span>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			  </div>
			</div>
			<!-- =========================== END Modal Details  ========== -->
			
			<script>
				$("#'.$array_obj[$x].'_start_date").datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: \'1934:2025\',
					dateFormat: \'yy-mm-dd\'
				});
				$("#'.$array_obj[$x].'_end_date").datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: \'1934:2025\',
					dateFormat: \'yy-mm-dd\'
				});
				

				$("#form'.$array_obj[$x].'").submit(function() {
					$(\'html, body\').animate({ scrollTop : 0}, \'slow\');
					$("#result_details_'.$array_obj[$x].'").text("Please wait...");
					$.ajax({
						type: "POST",
						url: $(this).attr("action"),
						data:  new FormData(this),
						contentType: false,
						cache: false,
						processData:false,
						success: function(msg) {
							$("#result_details_'.$array_obj[$x].'").html(msg);
						}
					});
					return false;
				});
			</script>
		';
	}

    $data['isi'] = '	
	<!------------------- START CONTROLING ------------------->		
	<div class="col-md-6">
		<div class="white-box text-center">
			<input id="lighting" data-plugin="knob" max-width="160 max" data-height="125" data-min="0" data-max="1024" data-fgColor="#fec107" data-displayPrevious=true data-angleOffset=-125 data-angleArc=250 value="0" />
			<h4 class="text-warning"><strong>LIGHTING CONTROL</strong></h4> 
			<hr>
			<div class="col-in row">
				<div class="col-md-6 col-sm-6 col-xs-6" style=" text-align: left;"> 
					<i data-icon="7" class="linea-icon linea-basic"></i>
					<h4 class="text-muted vb"><strong>Value</strong></h4>
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#ldr_modal" style="margin-bottom: 5px;">Details Data</button>					
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<h3 class="counter text-right m-t-15 text-warning"><span id="value_ldr"></span></h3>
					<h5 class="counter text-right m-t-15 text-warning" id="time_ldr"></h5>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="progress">
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"> <span class="sr-only">100% Complete (success)</span> </div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="col-md-6">
		<div class="white-box text-center">
			<input id="heating" data-plugin="knob" data-width="160" data-height="125" data-min="0" data-fgColor="#fb9678" data-displayPrevious=true data-angleOffset=-125 data-angleArc=250 value="56" />
			<h4 class="text-danger"><strong>HEATING CONTROL</strong></h4> 
		</div>	
		<div class="bg-theme-dark m-b-15">
			<div class="row weather p-20">
				<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-0">					
					<h1><span id="value_weight"></span><sup>Kg</sup></h1>
					<p class="text-white">WEIGHT</p>
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#weight_modal">Details Data</button>
				</div>
				<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"> <i class="wi wi-night-clear"></i>
					<br>
					<br>
					<b class="text-white"><span id="time_weight"></span></b>
				</div>
			</div>
		</div>
	</div>
	<!------------------- END CONTROLING ------------------->	
	
	
	
	<!------------------- START TEMPERATURE ------------------->	
	<div class="col-md-8">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>TEMPERATURE</strong></h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12">						
					<canvas id="temperature" width="400" height="150"></canvas>
				</div>
			</div>
		</div>		
	</div>
	
	<div class="col-md-4">
		<div class="bg-theme m-b-15">
			<div class="row weather p-20">
				<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
					<h3>&nbsp;</h3>
					<h1><span id="value_temperature"></span><sup>°C</sup></h1>
					<p class="text-white">Temperature</p>
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#temperature_modal">Details Data</button>
				</div>
				<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"> <i class="wi wi-thermometer"></i>
					<br>
					<br>
					<b class="text-white"><span id="time_temperature"></span></b>
				</div>
			</div>
		</div>
	</div>	
	<!------------------- END TEMPERATURE ------------------->
	

	
	<!------------------- START HUMIDITY ------------------->	
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>HUMIDITY</strong></h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12">						
					<canvas id="humidity" width="400" height="150"></canvas>
				</div>
			</div>
		</div>		
	</div>
	
	<div class="col-md-4">
		<div class="bg-theme-info m-b-15">
			<div class="row weather p-20">
				<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
					<h3>&nbsp;</h3>
					<h1><span id="value_humidity"></span><sup>%</sup></h1>
					<p class="text-white">Humidity</p>
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#humidity_modal">Details Data</button>
				</div>
				<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"> <i class="wi wi-humidity"></i>
					<br>
					<br>
					<b class="text-white"><span id="time_humidity"></span></b>
				</div>
			</div>
		</div>
	</div>	
	<!------------------- END HUMIDITY ------------------->
	
	
	
	<!------------------- START HEARTBEAT ------------------->	
	<div class="col-md-8">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>HEARBEAT</strong></h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12">						
					<canvas id="heartbeat" width="400" height="150"></canvas>
				</div>
			</div>
		</div>		
	</div>
	
	<div class="col-md-4">
		<div class="bg-theme-primary m-b-15">
			<div class="row weather p-20">
				<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
					<h3>&nbsp;</h3>
					<h1><span id="value_heartbeat"></span><sup>BPM</sup></h1>
					<p class="text-white">Heartbeat</p>
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#heartbeat_modal">Details Data</button>
				</div>
				<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"> <i class="wi wi-earthquake"></i>
					<br>
					<br>
					<b class="text-white"><span id="time_heartbeat"></span></b>
				</div>
			</div>
		</div>
	</div>	
	<!------------------- END HEATBEAT ------------------->
	
	'.$dt_modal_object.'
	';
	
    $data['css'] = '

	'; 
	
    $data['js'] = '		
		<script src="plugins/bower_components/knob/jquery.knob.js"></script>
		<script>
			$(function() {
				$("[data-plugin=knob]").knob();
			});
		</script>
		
		<script type="text/javascript" src="js/Chart.bundle.js"></script>
		<script type="text/javascript" src="js/ChartOK.js"></script>
		<script type="text/javascript" src="js/graph.js"></script> 
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script>
			setInterval(
				function(){ 
					var FormData = {id_babyincubator:"'.$id_babyincubator.'"}
					$.ajax({
						type: "POST",
						url: "?rt='.$_SESSION["tipe"].'&ctl=ctlmaster&prog=babyincubator_objectver",
						data : FormData,
						success: function(msg) {
							var data = JSON.parse(msg);
							console.log(data);
							value_temperature = data.tmp;
							value_humidity = data.humdt;
							value_heartbeat = data.hr;
							value_weight = data.weight;
							value_ldr = data.light;
							
							time_temperature = data.tmp_time;
							time_humidity = data.humdt_time;
							time_heartbeat = data.hr_time;
							time_weight = data.weight_time;
							time_ldr = data.light_time;
						}
					});
					return false;
				}, 4000);
		</script>	
		
		<script>
			$("#lighting").knob({              
                release : function (value) {                   
					console.log(value);
					sendmesg("/control/lighting",String(value));
                }
            })
			
			$("#heating").knob({              
                release : function (value) {                   
					console.log(value);
					sendmesg("/control/heating",String(value));
                }
            })
		</script>
		
		
	';
    $data['menu'] = '7';
    $data['sitemap'] = '
		<li class="active"><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubatordata"><span id="time_server"></span></a></li>
	';
    $data['title'] = strtoupper('Object : '.$babyincubator_name. ' - '.$id_babyincubator);     
    return _display('main.php', $content = $data);
	
}?>