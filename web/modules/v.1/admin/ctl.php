<?php 
switch($_GET['prog']){
	case 'mp':{
		require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['prog'].'.php');
	break;		
	}
	case 'mpver':{
		require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['prog'].'.php');
	break;		
	}
	
}

?>