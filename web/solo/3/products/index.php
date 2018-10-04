<?php
    //this is the PRODUCTS controller

    // Create or access a Session
    session_start();
    
    // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/acme-model.php';
    // Get the products model
    require_once '../model/products-model.php';
    // Get the reviews model
    require_once '../model/reviews-model.php';
    // Get the accounts model
    require_once '../model/accounts-model.php';
    // Get the functions library
    require_once '../library/functions.php';

    // Get the array of categories
    $categories = getCategories();
    //Display the navigation list
    $navList = getNavList($categories);
      
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
        case 'newCat':
            // Filter and store the data
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
            // Check for missing data
            if(empty($categoryName)){
                $message = "<p class='notify'>Please provide information for all empty form fields.</p>";
                include '../view/new-cat.php';
                exit; 
            }
            // Send the data to the model
            $catOutcome = addCategory($categoryName);
            // Check and report the result
            if($catOutcome === 1){
            header('Location: ../products/index.php');
               exit;
            } 
            else {
                $message = "<p class='notify'>Sorry, but the new category insert failed. Please try again.</p>";
            include '../view/new-cat.php';
                exit;
            }
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
            
        case 'mod':
            $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $prodInfo = getProductInfo($invId);
            if(count($prodInfo)<1){
                $message = "<p class='notify'>Sorry, no product information could be found.</p>";
            }
            include '../view/prod-update.php';
            exit;
            break;
        case 'del':
            $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $prodInfo = getProductInfo($invId);
            if (count($prodInfo) < 1) {
                $message = "<p class='notify'>Sorry, no product information could be found.</p>";
            }
            include '../view/prod-delete.php';
            exit;
            break;
        case 'deleteProd':
            // Filter and store the data
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);

            $deleteResult = deleteProduct($invId);
            if ($deleteResult) {
                //$message = "Congratulations, $invName was successfully deleted.";
                //$_SESSION['message'] = $message;
                header("location: ../products/index.php?message=".urlencode("Congratulations, $invName was successfully deleted."));
                exit;
            } else {
                //$message = "<p class='notify'>Error: $invName was not deleted.</p>";
                //$_SESSION['message'] = $message;
                header("location: ../products/index.php?message=".urlencode("Error: $invName was not deleted."));
                exit;
            }
            break;         
        case 'updateProd':
            // Filter and store the data
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
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
            if(empty($invId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)){
                $message = "<p class='notify'>Please provide information for all empty form fields</p>";
                include '../view/prod-update.php';
                exit; 
            }
            // Send the data to the model
            $updateResult = updateProduct($invId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
            // Check and report the result
            if ($updateResult) {
                //$message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
                //$_SESSION['message'] = $message;
                header("location: ../products/index.php?message=".urlencode("Congratulations, $invName was successfully updated."));
                exit;
            }
            else {
                $message = "<p class='notify'>Sorry, but the update inventory item failed. Please try again.</p>";
                include '../view/prod-update.php';
                exit;
            }
            break;
        case 'category':
            $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
            $products = getProductsByCategory($type);
            if(!count($products)){
                $message = "<p class='notify'>Sorry, no $type products could be found.</p>";
            } else {
                $prodDisplay = buildProductsDisplay($products);
            }
            // this is test code
            //echo $prodDisplay;
            //exit;
            include '../view/category.php';
            break;
        case 'prodSpec':
            $item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING);
            //Fill out $products[] with product information
            $product = getProductInfo($item);
            if(!count($product)){
                $message = "<p class='notify'>Sorry, no details could be found.</p>";
            } else {
                $prodSpecDisplay = buildProdSpecDisplay($product);
            }
            // If logged in, then display review form   
            if (isset($_SESSION['loggedin'])) {
                if($_SESSION['loggedin'] === TRUE){
                    $displayReviewForm = buildReviewForm ($_SESSION['clientData']['clientId'], $item);
                }
            } else {
                    $message="<p class='notify'>You must be logged in to review this product. Click <a href='../accounts/index.php?action=viewLogin'>here</a> to log in.</p>";
                }
            //Fill out $reviews[] with review information by invId
            $reviews = getReviewsByInvId($item);
            //Fill out $displayReviewsById[] based on reviews for the item id                
            $displayReviewsById = displayReview($reviews);
            include '../view/prod-spec.php';
            break;
        default:
            $products = getProductBasics();
            if(count($products) > 0){
                $prodList = '<table>';
                $prodList .= '<thead>';
                $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
                $prodList .= '</thead>';
                $prodList .= '<tbody>';
                foreach ($products as $product) {
                 $prodList .= "<tr><td>$product[invName]</td>";
                 $prodList .= "<td><a href='/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                 $prodList .= "<td><a href='/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
                }
                 $prodList .= '</tbody></table>';
                } else {
                 $message = "<p class='notify'>Sorry, no products were returned.</p>";
                }
            
            include '../view/prod-mgmt.php';
    }
?>
