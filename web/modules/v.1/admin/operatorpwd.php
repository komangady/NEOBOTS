<?php
	function operatorpwd() {
    $data = array();
    
    $sql = "SELECT id_operator, operator_name FROM tb_operator";
    $result = customQuery($sql);
    $dt = '';
    while ($hasil = mysql_fetch_array($result)) {
        $dt .= "'" . $hasil['id_operator'] . ' -- ' . $hasil['operator_name'] . "',";
    }
    $dt = rtrim($dt, ",");

    $data['isi'] = '
		<div class="col-md-12">
			<div class="panel panel-danger">
				<div class="panel-heading">Password Operator</div>
				<div class="panel-body">
					<div class="media">					
						<div class="media-body">
							<div id="hasil"></div>
							<form data-toggle="validator" id="frmpassword" name="frmpassword" method="POST" action="?rt='.$_SESSION["tipe"].'&ctl=ctloperator&prog=voperatorpwd" method="post">
								<div class="form-group">
									<label class="col-sm-2 control-label">ID -- Name Operator</label>
									<div class="col-sm-8">
										<input type="text" name="id_operator" id="id_operator" class="form-control"> <font id="msg_id_operator"></font>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">New Password</label>
									<div class="col-sm-8">
										<input class="form-control" id="password" name="password" type="password" max="50"><font id="msg_password"></font>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Repeat New Password</label>
									<div class="col-sm-8">
										<input class="form-control" id="repassword" name="repassword" type="password" max="50"><font id="msg_repassword"></font>
									</div>
								</div>

								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label"></label>
									<div class="col-sm-8">
										<button class="btn btn-primary" type="submit">Submit</button>
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
            var id_operator = ['. $dt .'];
            $("#id_operator").autocomplete({
                source: id_operator
            });

            $("#frmpassword").submit(function() {
                $("#hasil").text("Please wait...");
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
	$data['menu']='3';
	$data['sitemap'] = '
		<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctloperator&prog=operatordata">Operator</a></li>
		<li class="active">Change Operator Password</li>
	';	
    $data['title'] = 'Change Operator Password';  
    return _display('main.php', $data);
}
?>