<?php
switch ($_GET['prog']) {  
	case 'masteridentitasperusahaan' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'masteridentitasperusahaanver' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'logdata' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'babyincubator' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'babyincubatordata' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'babyincubatorver' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'babyincubatordelete' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'babyincubator_object' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'babyincubator_objectver' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'babyincubator_object_detailsver' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'babyincubator_object_detaildelete' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
}
?>