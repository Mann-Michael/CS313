<?php

/* 
 * this is the FUNCTIONS library
 */

function buildCartBrowseDisplay($products){
//This area is for building the display of the Cart Browse
	$bd = "";
	foreach ($products as $product) {
		$bd .= '<label for="' . $product . '">' . $product . '</label>';
		$bd .= '<input type="checkbox" name="' . $product . '" value="1"><br>';
	}
    return $bd;
}

function buildCartReviewDisplay($products){
//This area is for building the display of the Cart Review

	$rd = "";
	foreach ($products as $product) {
		$rd .= '<label for="' . $product . '">' . $product . '</label>';
		//$rd .= '<a href="/cart/index.php?action=viewCartReview&prodDelete=' . $product . '">     Delete     </a><br>';
		$rd .= '<a href="/cart/index.php?action=viewCartReview&prodDelete=' . $product . '">     Delete     </a><br>';
	}
    return $rd;
}

function getProductIndex($product) {
	$index = array_search($product, $_SESSION["productsReviewed"]);
	return $index;
}

function matchProducts($i){
	//Receives a number and finds the product 
	$products = getProducts();
	$product = $products[$i];
	return $product;
}

function buildCartConfirmDisplay(){
//This area is for building the display of the Cart Confirm

	//Build Address Area
    $cd = '<h2>Address Information</h2>'; 
	$cd .= '<label for="' . $_SESSION["clientFirstName"] . '">' . $_SESSION["clientFirstName"] . '</label> ';
	$cd .= '<label for="' . $_SESSION["clientLastName"] . '">' . $_SESSION["clientLastName"] . '</label><br>';
	$cd .= '<p style="marign:auto;">' . $_SESSION["clientAddress"] . '</p>';
	$cd .= '<p style="marign:auto;">' . $_SESSION["clientCity"] . ', ' . $_SESSION["clientState"] . '   ' . $_SESSION["clientZip"] . '</p>';
	//Build Products
    $cd .= '<h2>Products Ordered</h2>';
	$cd .= '<ul>';
	foreach ($_SESSION["productsReviewed"] as $product) {
		$cd .= '<li><label style="marign:auto;" for="' . $product . '">' . $product . '</label></li>';
    }
    $cd .= '</ul>';
	
    return $cd;
}

?>