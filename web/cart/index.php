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
				//Set variable for deleted item, if such an item exists
				$prodDelete = $_REQUEST['prodDelete'];
				//Check array to remove deleted item from the array, if it exists
				//this is buggy. If the array count gets less than the ID of the element it wants to delete, it doesnt find it. 
				for ($i = 0; $i <= count($_SESSION["productsReviewed"]); $i++){
					echo "for loop hit!<br/>";
					echo $i . " i<br/>";
					echo count($_SESSION["productsReviewed"]) . "count<br/>";
					echo $_SESSION["productsReviewed"][$i] . "<br/>";
					print_r($_SESSION["productsReviewed"]) . "<br/>";
					if ($_SESSION["productsReviewed"][$i] == $prodDelete) {
						unset($_SESSION["productsReviewed"][$i]);
						
						print_r($_SESSION["productsReviewed"]);
						break;
					}
				}
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
			/*
				Set address info from POST into the session
				Display Address info
				Display Products
				Button back
			*/
			$_SESSION["clientFirstName"] = htmlspecialchars($_POST['clientFirstName']);
			$_SESSION["clientLastName"] = htmlspecialchars($_POST['clientLastName']);
			$_SESSION["clientAddress"] = htmlspecialchars($_POST['clientAddress']);
			$_SESSION["clientCity"] = htmlspecialchars($_POST['clientCity']);
			$_SESSION["clientState"] = htmlspecialchars($_POST['clientState']);
			$_SESSION["clientZip"] = htmlspecialchars($_POST['clientZip']);

			$displayConfirm = buildCartConfirmDisplay();
			
			include '../view/cart-confirm.php';		
			break;
        case 'viewCartBrowse':
		default:
			/*
				Create a list of things to sell
				Loop over the list and create a form with the items in it. 
				Include item, id, cost, count
			*/
			//Clear Session variables
			unset($_SESSION["productsReviewed"]);
			unset($_SESSION["productsReceived"]);
			//Get products list
			$products = getProducts();
				
			//Build the display info for the cart browse		
			$displayProd = buildCartBrowseDisplay($products);
		
            include '../view/cart-browse.php';
    }
?>
