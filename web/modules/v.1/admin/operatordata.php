<?php
function operatordata() {
    $data = array();
    
    $sql = "SELECT * FROM tb_operator ORDER BY input_time DESC";
    $result = customQuery($sql);
    
    $dt = '';
    $no = 1;
    while ($row = mysql_fetch_array($result)) {
        $dt .= '
            <tr>
                <td>'. $no .'.</td>
                <td>'. $row['id_operator'] .'</td>            
                <td>'. $row['id_babyincubator'] .'</td>            
                <td>'. $row['operator_name'] .'</td>
                <td>'. $row['operator_handphone'] .'</td>     
                <td>'. $row['operator_address'] .'</td>     
                <td>'. ($row['operator_status'] == "1" ? "<strong class='text-success'>Active</strong>" : "<strong class='text-danger'>Non Active</strong>") .'</td>     
                <td>
                    <button class="btn btn-primary edit" dataid="'. MyEncrypt($row['id_operator']) .'"><i class="fa fa-pencil"></i></button>                    
					<button class="btn btn-danger hapus" dataid="'. MyEncrypt($row['id_operator']) .'"><i class="fa fa-trash-o"></i></button>
                    
                </td>
            </tr>
        ';
        $no++;
    }
    
    $data['isi'] = '
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Data Operator</div>
			<div class="panel-body">
				<div class="table-responsive">
					<span id="result"></span>
					<table id="tabel-pegawaidata" class="display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>ID/Username</th>
								<th>Incubator</th>
								<th>Name</th>
								<th>Handphone</th>
								<th>Address</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th>
								<th>ID/Username</th>
								<th>Incubator</th>
								<th>Name</th>
								<th>Handphone</th>
								<th>Address</th>
								<th>Status</th>
								<th>Action</th>
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
				location = "?rt='. $_SESSION['tipe'] .'&ctl=ctloperator&prog=operator&var=" + i;
			});
			
	    
			$(".hapus").click(function() {
			var i = $(this).attr("dataid");			
					bootbox.dialog({
						message: "Are you sure want to delete this data?",
						title: "Delete Operator User",
						buttons: {
							danger: {
								label: "Ya",
								className: "btn-danger",
								callback: function() {
									var alamat = "?rt='. $_SESSION['tipe'] .'&ctl=ctloperator&prog=operatordelete&id=" + i;
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
    
	$data['menu']='3';
	$data['sitemap'] = '
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctloperator&prog=operator_data">Operator</a></li>
		<li class="active">Data</li>
	';	
	$data['title']='Data Operator'; 	
    return _display('main.php', $content = $data);
}
?>