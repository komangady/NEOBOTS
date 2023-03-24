<?php function logdata() {
    $data = array();	
	
	
    $data['isi'] = '
	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><strong>Log-Data</strong></h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">						
						<div id="ws" style="font-family: Courier New, Courier, monospace; font-size: 12px; font-weight: bold;"></div>
					</div>
				</div>
			</div>		
		</div>
	
	';
    $data['css'] = '

	'; 
    $data['js'] = '		

	';
    $data['menu'] = '4';
    $data['sitemap'] = '
		<li class="active"><a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=logdata">LogData</a></li>
	';
    $data['title'] = 'Log Data Broker';     
    return _display('main.php', $content = $data);
}?>