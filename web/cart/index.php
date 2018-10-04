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
        case 'viewCat':
            include '../view/new-cat.php';
            break;
        case 'viewProd':
            include '../view/new-prod.php';        
            break;
        case 'newProd':
            // Filter and store the data
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
            
            // Check for missing data
            if(empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)){
                $message = "<p class='notify'>Please provide information for all empty form fields</p>";
                include '../view/new-prod.php';
                exit; 
            }
            // Send the data to the model
            $invOutcome = addInventory($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
            // Check and report the result
            if($invOutcome === 1){
               $message = "<p class='notify'>Congratulations! You have inserted the new inventory item $invName. You are an excellent inventorian.</p>";
               include '../view/new-prod.php';
               exit;
            } 
            else {
                $message = "<p class='notify'>Sorry, but the new inventory insert failed. Please try again.</p>";
                include '../view/new-prod.php';
                exit;
            }
            break;
            

        default:         
            include '../view/cart-browse.php';
    }
?>
