<?php
    //this is the CART controller

    // Get the functions library
    require_once '../library/functions.php';

	//get general information - UNUSED 
	
	//Get $action, if $action is null then set it to default
    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'viewCartBrowse':
			include '../view/cart-browse.php';
			break;
		case 'viewCartReview':
			include '../view/cart-review.php';
			break;
        case 'viewCartCheckout':
			include '../view/cart-checkout.php';
			break;
		case 'viewCartConfirm':
			include '../view/cart-confirm.php';		
			break;
        default:         
            include '../view/cart-browse.php';
    }
?>
