<?php
function babyincubator() {
    $data = array();
	
	$id = MyDecrypt($_GET['var']);
    if (!empty($id)) {
        $url = '?rt='.$_SESSION["tipe"].'&ctl=ctlmaster&prog=babyincubatorver&aksi=edit&id=' . MyEncrypt($id);

		$sql = "SELECT * FROM tb_babyincubator WHERE id_babyincubator='". $id ."'";
		$result = customQuery($sql);
		$hasil = mysql_fetch_array($result);

		$id_babyincubator = $hasil['id_babyincubator'] .'" disabled="disabled"';
		$babyincubator_name = $hasil['babyincubator_name'];
		
		$data['menu']='7';
		$data['sitemap'] = '
			<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubatordata">Incubator Data</a></li>
			<li class="active">Update Baby Incubator</li>
		';	
		$data['title']='Edit Baby Incubator';
	}
	else 
	{
		$url = '?rt='.$_SESSION["tipe"].'&ctl=ctlmaster&prog=babyincubatorver&aksi=simpan';

		$id_babyincubator = "";
		$babyincubator_name	= "";
		
		$data['menu']='7';
		$data['sitemap'] = '
			<li><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubatordata">Incubator Data</a></li>
			<li class="active">Add Baby Incubator</li>
		';	
		$data['title']='Add Baby Incubator';
	}

    $data['isi'] = '
	<div class="col-md-12">
		<div class="panel panel-warning">
			<div class="panel-heading">'.$data["title"].'</div>
			<div class="panel-body">
				<div class="media">					
					<div class="media-body">
						<div id="result"></div>
						<form data-toggle="validator" id="frmPegawai" name="frmPegawai" method="POST" action="'. $url .'" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">ID Incubator</label>
								<div class="col-sm-5">
									<input type="text" name="id_babyincubator" class="form-control"  value="'. $id_babyincubator .'"> <font id="msg_id_babyincubator"></font>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Name Incubator</label>
								<div class="col-sm-10">
									<input type="text" name="babyincubator_name" class="form-control"  value="'. $babyincubator_name .'"> <font id="msg_babyincubator_name"></font>
								</div>
							</div>
								
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary">Action</button>
									<a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubatordata" type="button" class="btn btn-warning">Back</a>
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
			$("#frmPegawai").submit(function() {
                $(\'html, body\').animate({ scrollTop : 0}, \'slow\');
                $("#result").text("Harap tunggu...");
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
                    success: function(msg) {
                        $("#result").html(msg);
                    }
                });
                return false;
            });		
        </script>
    ';

  
    return _display('main.php', $content = $data);
}

?>