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
			
			//See if there is a products reviewed cart already
			if (isset($_SESSION["productsReviewed"])) {
				//check to see if an item is being deleted
				$prodDelete = $_GET['prodDelete'];
				echo $prodDelete;
				break;
				$_SESSION["productsReviewed"] = array_filter($_SESSION["productsReviewed"], 
			} else {
				// Fill an array with all products and values from POST
				$_SESSION["productsReceived"] = array($_POST['product1'], $_POST['product2'], $_POST['product3'], $_POST['product4'], $_POST['product5']);
				
				//Create new array and remove the items that should not be in the cart
				//1 = Added to cart, 0 = not. 
				$_SESSION["productsReviewed"] = array();
				for ($i = 0; $i < count($_SESSION["productsReceived"]); $i++){
					if ($_SESSION["productsReceived"][$i] == 1) {
						$_SESSION["productsReviewed"][] = matchProducts($i);
					}
				}
			}
			
			//Build the view
			$displayReview = buildCartReviewDisplay($_SESSION["productsReviewed"]);
		
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
