<?php
function biodatapersonal() {
    $data = array();

	$id = $_SESSION['user'];
    if (!empty($id)) {
        $url = '?rt='.$_SESSION["tipe"].'&ctl=ctlbiodata&prog=biodataver&aksi=edit&id=' . MyEncrypt($id);

		$sql = "SELECT * FROM tb_operator WHERE id_operator ='". $id ."'";
		$result = customQuery($sql);
		$row = mysql_fetch_array($result);

		$id_operator = $row['id_operator'] .'" disabled="disabled"';
		
		$operator_name = $row['operator_name'];
		$operator_handphone	= $row['operator_handphone'];
		$operator_address = $row['operator_address'];	
		$operator_image = $row['operator_image'];		
		
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
					
					
		$data['menu']='2';
		$data['sitemap'] = '
			<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal">Biodata</a></li>			
			<li class="active">Data Personal</li>
		';	
		$data['title']='Data Personal';
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
                $("#hasil").text("Harap tunggu...");
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