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

    case 'product':
        if (!array_key_exists('ID', $_GET) || empty($_GET['ID'])) {
            header('Location: index.php');
        } 
        require_once PROTECTED_DIR.'normal/product/product.php';
    break;

    case 'forgottenPassword':
        require_once USER_DIR.'forgottenPsw.php';
    break;

    case 'cart':
        require_once USER_DIR.'cart.php';
    break;

    case 'removeFromCart':
        if(!array_key_exists('ID', $_GET) || empty($_GET['ID'])) {
            header('Location: index.php?P=cart');
        }
        else {
            removeFromCart($_GET['ID']);
            header('Location: index.php?P=cart');
        }
    break;

    case 'listProducts':
        require_once PRODUCT_DIR.'listProducts.php';
    break;

    case 'profile':
        if (isUserLoggedIn()) {
            require_once USER_DIR.'profile.php';
        }
        else {
            header('Location: index.php');
        }
    break;

    case 'addProduct': 
        if (isUserLoggedIn()) {
            require_once PRODUCT_DIR.'addProduct.php';
        }
        else {
            header('Location: index.php');
        }
        
    break;

    case 'modifyProduct':
        if (isUserLoggedIn()) {
            require_once PRODUCT_DIR.'modifyProduct.php';
        }
        else {
            header('Location: index.php');
        }
    break;

    case 'search':
        require_once PRODUCT_DIR.'search.php';
    break;

}

?>