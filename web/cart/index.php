<?php
    //This is the CART controller
	
	// Create or access a Session
	session_start();

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
		case 'viewCartReview':
			/*
				get all info that is posted and add it to an array in the session
				Create a view that has each item in the array and add a delete option
				if the user delete the item, it removes it from the list and the array then refreshes the page as review
				if the user likes this, they continue and go to checkout 
				if they want to adjust the cart, they can return to it
			*/
		
		$product1 = $_POST['product1'];
		$product2 = $_POST['product2'];
		$product3 = $_POST['product3'];
		$product4 = $_POST['product4'];
		$product5 = $_POST['product5'];

		echo $product1;
		echo $product2;
		echo $product3;
		echo $product4;
		echo $product5;
		break;
		
		$displayReview = buildCartReviewDisplay($productReview);
		
			include '../view/cart-review.php';
			break;
        case 'viewCartCheckout':
			/*
				User inputs personal info and stores it in the session
			
			*/
			include '../view/cart-checkout.php';
			break;
		case 'viewCartConfirm':
			include '../view/cart-confirm.php';		
			break;
        case 'viewCartBrowse':
		default:
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
    }
?>
