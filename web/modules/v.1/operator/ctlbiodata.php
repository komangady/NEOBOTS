<?php  
	switch ($_GET['prog']) {
    case 'biodatapersonal' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
        }
    case 'biodataver' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
        }
    case 'biodataubahpwd' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
        }
    case 'biodataubahpwdver' : {
            require_once PATH_MODULES . $_GET['rt'] . '/' . $_GET['prog'] . '.php';
            break;
        }
	}
?>