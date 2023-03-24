<?php
function operator() {
    $data = array();
	
	$id = MyDecrypt($_GET['var']);
    if (!empty($id)) {
        $url = '?rt='.$_SESSION["tipe"].'&ctl=ctloperator&prog=operatorver&aksi=edit&id=' . MyEncrypt($id);

		$sql = "SELECT * FROM tb_operator WHERE id_operator ='". $id ."'";
		$result = customQuery($sql);
		$row = mysql_fetch_array($result);

		$id_operator = $row['id_operator'] .'" disabled="disabled"';
		
		$id_babyincubator = $row['id_babyincubator'];
		$operator_name = $row['operator_name'];
		$operator_handphone	= $row['operator_handphone'];
		$operator_address = $row['operator_address'];	
		$operator_image = $row['operator_image'];
		$operator_status = $row['operator_status'];	
		$id_babyincubator = $row['id_babyincubator'];
		$id_babyincubator = explode("//", $id_babyincubator);
		
		$sql = "SELECT * FROM tb_babyincubator";
		$result = customQuery($sql);
		$dt_babyincubator = '';
		while($row = mysql_fetch_assoc($result))
		{
			$dt_babyincubator .= '				
				<div class="form-check">
					<label class="custom-control custom-checkbox">
						<input type="checkbox" name="id_babyincubator[]" class="custom-control-input" value="'.$row["id_babyincubator"].'" '.(in_array($row["id_babyincubator"], $id_babyincubator) ? "checked" : "").'>
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">'.$row["id_babyincubator"].' -- '.$row["babyincubator_name"].'</span>
					</label>
				</div>
			';
		}
		
		$foto_tampil = '
			<div class="col-md-4">
				<div class="row el-element-overlay m-b-40">				
					<!-- /.usercard -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">					
						<div class="white-box">
							<div class="el-card-item">
								<div class="el-card-avatar el-overlay-1">
									<img src="'.($operator_image!=null?"picpegawai/".$operator_image:"img/avatars/unknown.png").'" />
									<div class="el-overlay">
										<ul class="el-info">
											<li><a class="btn default btn-outline image-popup-vertical-fit" href="'.($operator_image!=null?"picpegawai/".$operator_image:"img/avatars/unknown.png").'"><i class="icon-magnifier"></i></a></li>
											<li><a class="btn default btn-outline" href="javascript:void(0);"><i class="icon-link"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="el-card-content">
									<h3 class="box-title">'.$operator_name.'</h3>
									<small>Pegawai</small>
									<br/>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</div>
			';
					
					
		$data['menu']='3';
		$data['sitemap'] = '
			<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctloperator&prog=operatordata">Operator</a></li>
			<li class="active">Edit</li>
		';	
		$data['title']='Edit Data Operator';
	}
	else
	{
		$url = '?rt='.$_SESSION["tipe"].'&ctl=ctloperator&prog=operatorver&aksi=save';
		$id_operator = "";		
		$id_babyincubator = "";
		$operator_name = "";
		$operator_handphone	= "";
		$operator_address = "";	
		$operator_image = "";
		$operator_status = "";	

		$foto_tampil = "";		
		
		$sql = "SELECT * FROM tb_babyincubator";
		$result = customQuery($sql);
		$dt_babyincubator = '';
		while($row = mysql_fetch_assoc($result))
		{
			$dt_babyincubator .= '				
				<div class="form-check">
					<label class="custom-control custom-checkbox">
						<input type="checkbox" name="id_babyincubator[]" class="custom-control-input" value="'.$row["id_babyincubator"].'">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">'.$row["id_babyincubator"].' -- '.$row["babyincubator_name"].'</span>
					</label>
				</div>
			';
		}
						
		$data['menu']='3';
		$data['sitemap'] = '
			<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctloperator&prog=operatordata">Operator</a></li>
			<li class="active">Add</li>
		';	
		$data['title']='Add Data Operator';
	}

    $data['isi'] = '

	'.$foto_tampil .'
	
	<div class="col-md-'.(!empty($id) ? '8' : '12').'">
		<div class="panel panel-warning">
			<div class="panel-heading">'.$data["title"].'</div>
			<div class="panel-body">
				<div class="media">					
					<div class="media-body">
						<div id="hasil"></div>
						<form data-toggle="validator" id="frmOperator" name="frmOperator" method="POST" action="'. $url .'" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">ID Operator</label>
								<div class="col-sm-9">
									<input type="text" name="id_operator" class="form-control"  value="'. $id_operator .'"> <font id="msg_id_operator"></font>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Name</label>
								<div class="col-sm-12">
									<input type="text" name="operator_name" class="form-control"  value="'. $operator_name .'"> <font id="msg_operator_name"></font>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Handphone</label>
								<div class="col-sm-5">
									<input type="text" name="operator_handphone" class="form-control"  value="'. $operator_handphone .'"> <font id="msg_operator_handphone"></font>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Address</label>
								<div class="col-sm-12">
									<input type="text" name="operator_address" class="form-control"  value="'. $operator_address .'"> <font id="msg_operator_address"></font>
								</div>
							</div>
														
							<div class="form-group">
								<label class="col-sm-2 control-label">Status</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input class="uniform" name="operator_status" id="operator_status" value="1" ' . ($operator_status == "1" ? 'checked="" ' : '') . 'type="radio"> 
									Active </label> 
									<label class="radio-inline"><input class="uniform" name="operator_status" id="operator_status" value="2" ' . ($operator_status == "0" ? 'checked="" ' : '') . 'type="radio"> 
									Non Active </label> 
									<font id="msg_operator_status"></font>
									</div>
							</div>
							
							<hr>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><strong>Access Incubator</strong></label>
								<div class="col-sm-12">
									'.$dt_babyincubator.'
								</div>
							</div>
														
							<hr>
						
							<div class="form-group">
								<label class="col-sm-2 control-label">Picture</label>
								<div class="col-sm-4">
									<input type="file" name="foto" id="foto" class="form-control"> <font id="msg_foto"></font>
								</div>
							</div>  
								
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
									<button type="submit" class="btn btn-primary">Submit Data</button>
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
			$("#frmOperator").submit(function() {
                $(\'html, body\').animate({ scrollTop : 0}, \'slow\');
                $("#hasil").text("Please wait...");
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
                    success: function(msg) {
                        $("#hasil").html(msg);
                    }
                });
                return false;
            });		
        </script>
    ';

  
    return _display('main.php', $content = $data);
}

?>