<?php 
	function biodata_edit(){
	$sql = "SELECT * FROM admin WHERE id_admin='". $_SESSION['user'] ."'";
	$result = customQuery($sql);
	$hasil = mysql_fetch_array($result);

	$data = array();
	$data['isi']='
	<div class="col-md-12">
		<div class="panel panel-warning">
			<div class="panel-heading">Personal Edit</div>
			<div class="panel-body">
				<div class="media">					
					<div class="media-body">
						<form data-toggle="validator" id="admindata" name="admindata" method="POST" action="?rt='. $_SESSION['tipe'] .'&ctl=ctlbiodata&prog=biodataver" method="post">
							<div class="form-group">
								<div class="col-sm-12">
									<font id="msg_errorsdata"></font>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Id Admin</label>
								<div class="col-sm-5">
									<input class="form-control" id="disabledInput" placeholder="'.$hasil['id_admin'].'" disabled="" type="text" max="100">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Name</label>
								<div class="col-sm-5">
									<input class="form-control" id="namalengkap" name="namalengkap" placeholder="Nama Lengkap" type="text" max="50" value="'.$hasil['nama'].'"><font id="msg_namalengkap"></font>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
								<div class="col-sm-5">
									<input class="form-control" id="email" name="email" placeholder="pengguna@email.com" type="text" max="100" value="'.$hasil['email'].'"><font id="msg_email"></font>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Phone</label>
								<div class="col-sm-5">
									<input class="form-control" id="telepon" name="telepon" placeholder="081234567890" type="text" max="20" value="'.$hasil['telepon'].'"><font id="msg_telepon"></font>
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label"></label>
								<div class="col-sm-3">
									<button class="btn btn-primary" type="submit">Save</button>
									<button class="btn btn-danger" type="reset">Reset Data</button>
								</div>
							</div>
						</form>	
						
					</div>
				</div>
			</div>
		</div>
	</div>
	';
	
	$data['css']='';
	$data['js']='
		<script type="text/javascript">
			$(document).ready(function(){
				 $("#admindata").submit(function() {
					$(\'html, body\').animate({ scrollTop : 0}, \'slow\');
					$.ajax({
						type: "POST",
						url: $(this).attr("action"),
						data: $(this).serialize(),
						success: function(msg) {
							$("#msg_errorsdata").html(msg);
						}
					});
					return false;
				});
			});
		</script>	
	';
	$data['menu']='2';
	$data['sitemap'] = '
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal">Biodata</a></li>
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal">Data Personal</a></li>
		<li class="active">Edit Personal</li>
	';		
	
	$data['title']='Biodata'; 	
    return _display('main.php',$content=$data);
}
?>