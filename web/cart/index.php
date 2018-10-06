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
		
			$productsReceived = array($_POST['product1'], $_POST['product2'], $_POST['product3'], $_POST['product4'], $_POST['product5']);

			//debug code for pulling products out of the array	
			//print_r($productsReceived);
			//break;
			
			//Remove everything without a value of 1 then send to view!!!
			
			$productsReviewed = array();
			for ($i = 0; $i < count($productsReceived); $i++){
				echo $productsReceived;
				
				if ($productsReceived[$i] = 1) {
					$productsReviewed[] = matchProducts($i);
				}
			}
			
			//debug code for pulling products out of the array	
			print_r($productsReviewed);
			break;
			$displayReview = buildCartReviewDisplay($productsReviewed);
		
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
