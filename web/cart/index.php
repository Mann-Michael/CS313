<?php
    //This is the CART controller
	
	// Create or access a Session
	//session_start();

    //Get the functions library
    require_once '../library/functions.php';
	//Get the products model
    require_once '../model/products-model.php';

	//Create general information - UNUSED 
	
	//Get $action, if $action is null then set it to default
    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'viewCartBrowse':
		
		/*
			Create a list of things to sell
			Loop over the list and create a form with the items in it. 
			Include item, id, cost, count
			
		
		*/
		//Get products list
		$products = getProducts();
		
		//Build the display info for the cart browse
		$displayProd = buildCartBrowseDisplay($products);
		
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
