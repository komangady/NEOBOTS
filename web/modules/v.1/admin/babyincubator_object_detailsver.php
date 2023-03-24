<?php
	function babyincubator_object_detailsver ()
	{
		$id_babyincubator = MyDecrypt($_GET["var"]);
		$tb_db = MyDecrypt($_GET["tb"]);
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		
		$sql = "SELECT a.*, b.babyincubator_name FROM tb_".$tb_db." a 
				INNER JOIN tb_babyincubator b ON a.id_babyincubator = b.id_babyincubator
				WHERE a.id_babyincubator = '".$id_babyincubator."' AND a.input_time BETWEEN '".$start_date."' AND '".$end_date." 23:59:59.999'
				ORDER BY a.input_time DESC";
		$result = customQuery($sql);
		if(mysql_num_rows($result) > 0)
		{
			$dt = '';
			$dt_graph = '';
			$no = 1;
			while($row = mysql_fetch_assoc($result))
			{
				$dt .= '
					<tr>
						<td>'.$no.'</td>
						<td>
							'.$row["id_babyincubator"].' <br>
							'.$row["babyincubator_name"].'							
						</td>
						<td>'.$row[$tb_db."_value"].'</td>
						<td>'.$row["input_time"].'</td>
						<td>
							<button class="btn btn-danger delete_'.$tb_db.'" dataid="'. MyEncrypt($row['id_'.$tb_db]."//".$tb_db) .'"><i class="fa fa-trash-o"></i> Delete</button>
						</td>
					</tr>
				';
				$no++;
				$dt_graph .= '
					["'.$row["input_time"].'", '.$row[$tb_db."_value"].'],
				';
			}
			
			$data_tabel = '
				<div class="table-responsive">
					<span id="result_'.$tb_db.'"></span>
					<table id="tabel-'.$tb_db.'data" class="display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Incubator</th>
								<th>Value '.strtoupper($tb_db).'</th>
								<th>Time</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Incubator</th>
								<th>Value '.strtoupper($tb_db).'</th>
								<th>Time</th>
								<th>Aksi</th>
							</tr>
						</tfoot>
						<tbody>
							'.$dt.'
						</tbody>
					</table>
				</div>
				
				<hr>
				
				<div id="chart_'.$tb_db.'" style="height: 400px"></div>
				
				<script type="text/javascript" src="' . PATH_JS . 'bootbox/bootbox.min.js"></script>				
								
				<script>
					$("#tabel-'.$tb_db.'data").DataTable({
						dom: "Bfrtip",
						buttons: [
							"copy", "csv", "excel", "pdf", "print"
						]
					});
					
					$(".delete_'.$tb_db.'").click(function() {
						var i = $(this).attr("dataid");			
						bootbox.dialog({
							message: "Are you sure you want to delete this data?",
							title: "Delete Temperature Data",
							buttons: {
								danger: {
									label: "Ya",
									className: "btn-danger",
									callback: function() {
										var alamat = "?rt='. $_SESSION['tipe'] .'&ctl=ctlmaster&prog=babyincubator_object_detaildelete&id=" + i;
										$.ajax({
											url: alamat,
											success: function(result) {
												$("#result_'.$tb_db.'").html(result);
											}
										});
									}
								},
								success: {
									label: "Tidak",
									className: "btn-primary"
								}
							}
						});
					});
				</script>
				
				<script type="text/javascript">
					google.charts.load("current", {"packages":["corechart"]});
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {
						var data = google.visualization.arrayToDataTable([
						  ["Date", "Value"],
						  '.$dt_graph.'
						 
						]);

						var options = {
						  title: "Graph '.strtoupper($tb_db).' : '.$start_date.' - '.$end_date.'",
						  curveType: "function",
						  legend: { position: "bottom" }
						};

						var chart = new google.visualization.LineChart(document.getElementById("chart_'.$tb_db.'"));

						chart.draw(data, options);
					}
				</script>
			';
			
			echo $data_tabel;
		}
		else 
		{
			echo "Not Found Value!".$sql;
		}
	}
?>