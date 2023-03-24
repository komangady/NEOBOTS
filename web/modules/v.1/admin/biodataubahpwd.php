<?php 
	function biodataubahpwd() {

    $data = array();
    $data['isi'] = '
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Password</div>
			<div class="panel-body">
				<div class="media">					
					<div class="media-body">
						<div id="hasil"></div>
						<form class="form-horizontal" role="form" id="frmpassword" name="frmpassword" method="POST" action="?rt='. $_SESSION['tipe'] .'&ctl=ctlbiodata&prog=biodataubahpwdver">
							
							<div class="form-group">
								<label class="col-sm-2">Password</label>
								<div class="col-sm-5">
									<input class="form-control" id="password" name="password" type="password" max="50"><font id="msg_password"></font>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2">New Password</label>
								<div class="col-sm-5">
									<input class="form-control" id="passwordbaru" name="passwordbaru" type="password" max="50"><font id="msg_passwordbaru"></font>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2">Confirm New Password</label>
								<div class="col-sm-5">
									<input class="form-control" id="repasswordbru" name="repasswordbaru" type="password" max="50"><font id="msg_repasswordbaru"></font>
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
    $data['css'] = '';
    $data['js'] = '
		<script type="text/javascript">
		    $("#frmpassword").submit(function() {
				$("#hasil").text("Tunggu..");
				$.ajax({
					type: "POST",
					url: $(this).attr("action"),
					data: $(this).serialize(),
					success: function(msg) {
						$("#hasil").html(msg);
					}
				});
				return false;
			});
		</script>
                ';
    $data['menu'] = '2';  
    $data['sitemap'] = '
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal">Biodata</a></li>
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal">Personal</a></li>
		<li class="active">Change the Password</li>
	';
    $data['title'] = 'Change the Password';
   

    return _display('main.php', $content = $data);
}
?>