<?php
switch ($_GET['prog']) { 	
	case 'babyincubatordata' : {
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