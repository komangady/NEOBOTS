<?php 
	function biodataubahpwd() {
    $data = array();

    $data['isi'] = '
	<div class="col-md-12">
		<div class="panel panel-danger">
			<div class="panel-heading">Change Password</div>
			<div class="panel-body">
				<div class="media">					
					<div class="media-body">
						<div id="hasil"></div>
							<div id="hasil"></div>
							<form action="?rt='. $_SESSION['tipe'] .'&ctl=ctlbiodata&prog=biodataubahpwdver" method="POST" id="frmPassword" data-toggle="validator">
								<div class="form-group">
									<label class="col-sm-2 control-label">Old Passowrd</label>
									<div class="col-sm-5">
										<input type="password" name="pw" id="pw" class="form-control"> <font id="msg_pw"></font>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">New Password</label>
									<div class="col-sm-5">
										<input type="password" name="password" class="form-control"> <font id="msg_password"></font>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Repeat New Password</label>
									<div class="col-sm-5">
										<input type="password" name="repassword" class="form-control"> <font id="msg_repassword"></font>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-2"></div>
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Action</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	';
    $data['css'] = '';
    $data['js'] = '
        <script type="text/javascript">
         
            $("#frmPassword").submit(function() {
                $("#hasil").text("Please Wait...");
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
	$data['menu']='2';
	$data['sitemap'] = '
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal">Biodata</a></li>			
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodataubahpwd">Password</a></li>			
		<li class="active">Change Password</li>
		';	
	$data['title']='Change Password';

    return _display('main.php', $content = $data);
}
?>