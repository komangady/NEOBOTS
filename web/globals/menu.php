<?php

function menu($user, $menu, $submenu) {
  
    if ($user == 'admin') {
        $content = '
		<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">  
					<li> 
						<a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctl&prog=mp" class="waves-effect ' . aktif($menu, 1) . '"><i data-icon="Z" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Dashboard</span></a> 
					</li>
                    <li> 
						<a href="javascript:void(0)" class="waves-effect ' . aktif($menu, 2) . '"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Biodata <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal" >Personal Bio</a> </li>
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodataubahpwd">Password</a> </li>
                        </ul>
                    </li>
					<li> 
						<a href="javascript:void(0)" class="waves-effect ' . aktif($menu, 3) . '"> <i class="linea-icon linea-basic fa-fw" data-icon="u"></i> <span class="hide-menu"> Operator <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctloperator&prog=operatordata" >Operator Data</a> </li>
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctloperator&prog=operator">Add Operator</a> </li>
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctloperator&prog=operatorpwd">Operator Password</a> </li>
                        </ul>
                    </li>					
					<li> 
						<a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=masteridentitasperusahaan" class="waves-effect ' . aktif($menu, 5) . '"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">System Identity </span></a> 
					</li>	
					<li> 
						<a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=logdata" class="waves-effect ' . aktif($menu, 4) . '"><i data-icon="a" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Log Data </span></a> 
					</li>
					<li> 
						<a href="javascript:void(0)" class="waves-effect ' . aktif($menu, 7) . '"><i class="linea-icon linea-basic fa-fw" data-icon="E"></i> <span class="hide-menu"> Incubator <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubatordata" >Baby Incubator Data</a> </li>
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubator">Add Baby Incubator</a> </li>
                        </ul>
                    </li>						
                </ul>
            </div>
        </div>
		';
    } 
	else if ($user == 'operator') {
        $content = '
		<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">  
					<li> 
						<a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctl&prog=mp" class="waves-effect ' . aktif($menu, 1) . '"><i data-icon="U" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Dashboard</span></a> 
					</li>
                    <li> 
						<a href="javascript:void(0)" class="waves-effect ' . aktif($menu, 2) . '"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Biodata <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodatapersonal" >Data Personal</a> </li>
							<li> <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodataubahpwd">Ubah Password</a> </li>
                        </ul>
                    </li>
					<li> 
						<a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmaster&prog=babyincubatordata" class="waves-effect ' . aktif($menu, 7) . '"><i data-icon="E" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Incubator</span></a> 
					</li>				
                </ul>
            </div>
        </div>
		';
    }
		
    return $content;
}

function aktif($a, $b) {
    if ($a == $b) {
        return "active";
    } else {
        return "";
    }
}



?>