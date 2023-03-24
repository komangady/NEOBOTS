<?php
switch($_GET['prog']){
	case 'combonegara':{
		require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['prog'].'.php');
	break;		
	}	
	case 'comboprovinsi':{
		require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['prog'].'.php');
	break;		
	}	
	case 'combokabupaten':{
		require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['prog'].'.php');
	break;		
	}
	case 'combokecamatan':{
		require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['prog'].'.php');
	break;		
	}	
	case 'combokosong':{
		require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['prog'].'.php');
	break;		
	}	
}
?>