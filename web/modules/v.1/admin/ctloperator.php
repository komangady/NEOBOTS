<?php
switch ($_GET['prog']) {
    case 'operatordata' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
	case 'operator' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
    case 'operatorver' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
    }
    case 'operatordelete' : {
		require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
		break;
    }
	case 'operatorpwd' : {
		require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
		break;
    }
	case 'voperatorpwd' : {
		require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
		break;
    }

	
	
}
?>