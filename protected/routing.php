<?php
if (!array_key_exists('P', $_GET) || empty($_GET['P'])) {
    $_GET['P'] = 'home';
}


switch ($_GET['P']) {
    case 'home':
        require_once PROTECTED_DIR.'normal/home.php';
    break;
    
    default:
        require_once PROTECTED_DIR.'normal/404.php';
    break;

    case 'register':
        require_once USER_DIR.'register.php';
    break;

    case 'login':
        require_once USER_DIR.'login.php';
    break;

    case 'logout':
        if(IsUserLoggedIn()) {
            userLogout();
        }
        header('Location: index.php');
    break;
        

}

?>