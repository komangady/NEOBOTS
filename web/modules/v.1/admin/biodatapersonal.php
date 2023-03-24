<?php  
	function biodatapersonal(){

	$sql = "SELECT * FROM admin WHERE id_admin='". $_SESSION['user'] ."'";
	$result = customQuery($sql);
	$hasil = mysql_fetch_array($result);

	$data = array();
	$data['isi']='
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Peronal Bio</div>
			<div class="panel-body">
				<div class="media">					
					<div class="media-body">
						
						<table colspan="5" rowspan="5px" class="" cellpadding="5px">
							<tr>
								<td width="20%"><b>Id Admin</b></td>
								<td width="2%">:</td>
								<td width="78%">'. $hasil['id_admin'] .'</td>
							</tr>
							<tr>
								<td><b>Name</b></td>
								<td>:</td>
								<td>'. $hasil['nama'] .'</td>
							</tr>
							<tr>
								<td><b>Email</b></td>
								<td>:</td>
								<td>'.  $hasil['email'] .'</td>
							</tr>
							<tr>
								<td><b>Phone</b></td>
								<td>:</td>
								<td>'. $hasil['telepon'] .'</td>
							</tr>
							<tr>
								<td><b>Information</b></td>
								<td>:</td>
								<td>'. $hasil['keterangan'] .'</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="3"><button class="btn btn-success" onclick="location=\'?rt=admin&ctl=ctlbiodata&prog=biodata_edit\'">Edit</button></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	';
	
	$data['css']='';
	$data['js']='';
	$data['menu']='2';
	$data['sitemap'] = '
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal">Biodata</a></li>
		<li class="active">Personal</li>
	';														
	$data['title']='Biodata'; 	
return _display('main.php',$content=$data);
}
?>