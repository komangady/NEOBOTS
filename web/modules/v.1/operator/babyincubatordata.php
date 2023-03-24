<?php
function babyincubatordata() {
    $data = array();
    
	$sql ="SELECT * FROM tb_operator WHERE id_operator = '".$_SESSION['user']."'";
	$result = customQuery($sql);
	$row = mysql_fetch_assoc($result);
	$id_babyincubator = $row["id_babyincubator"];
	$id_babyincubator = explode("//", $id_babyincubator);
	
	$dt = '';
	$no = 1;
	foreach($id_babyincubator as $value){
		if(!empty($value) and isset($value))
		{
			$sql = "SELECT * FROM tb_babyincubator WHERE id_babyincubator = '".$value."' ORDER BY input_time DESC";
			$result = customQuery($sql);
			while ($hasil = mysql_fetch_array($result)) {
				$dt .= '
					<tr>
						<td>'. $no .'</td>
						<td>
							<a href="?rt='. $_SESSION['tipe'] .'&ctl=ctlmaster&prog=babyincubator_object&var='.MyEncrypt($hasil["id_babyincubator"]).'" target="_blank"> <strong>'. $hasil['id_babyincubator'] .' </strong> </a></td>            
						<td>'. $hasil['babyincubator_name'] .'</td>
						<td>
							<small><i>
								Time Input : '. $hasil['input_time'] .' <br>
								Time Update : '. $hasil['update_time'] .' <br>
							</i></small>
						</td>
					</tr>
				';
				$no++;
			}
		}
	}
    
    
    $data['isi'] = '
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Baby Incubator Data</div>
			<div class="panel-body">
				<div class="table-responsive">
					<span id="result"></span>
					<table id="tabel-pegawaidata" class="display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>ID Incubator</th>
								<th>Baby Incubator Name</th>
								<th>Time</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
								<th>ID Incubator</th>
								<th>Baby Incubator Name</th>
								<th>Time</th>
							</tr>
						</tfoot>
						<tbody>
							'.$dt.'
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	';
    $data['css'] = '';
    $data['js'] = '
        <script type="text/javascript" src="' . PATH_JS . 'bootbox/bootbox.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#tblSekolah").dataTable();
            });
            
			$(".edit").click(function() {
				var i = $(this).attr("dataid");
				location = "?rt='. $_SESSION['tipe'] .'&ctl=ctlmaster&prog=babyincubator&var=" + i;
			});
			
			$(".delete").click(function() {
			var i = $(this).attr("dataid");			
					bootbox.dialog({
						message: "Are you sure you want to delete this data?",
						title: "Delete Incubator Data",
						buttons: {
							danger: {
								label: "Ya",
								className: "btn-danger",
								callback: function() {
									var alamat = "?rt='. $_SESSION['tipe'] .'&ctl=ctlmaster&prog=babyincubatordelete&id=" + i;
									$.ajax({
										url: alamat,
										success: function(result) {
											$("#result").html(result);
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
		
		<script>
			$("#tabel-pegawaidata").DataTable({
				dom: "Bfrtip",
				buttons: [
					"copy", "csv", "excel", "pdf", "print"
				]
			});
		</script>
    ';
    
	$data['menu']='7';
	$data['sitemap'] = '
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubatordata">Incubator</a></li>
		<li class="active">Data</li>
	';	
	$data['title']='Baby Incubator Data'; 	
    return _display('main.php', $content = $data);
}
?>