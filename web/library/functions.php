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
		$rd .= '<a href="/cart/index.php?action=viewCartReview&prodDelete=' . $product . '">     Delete     </a><br>';
	}
    return $rd;
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
    $cd = '<label for="' . $_SESSION["clientFirstName"] . '">' . $_SESSION["clientFirstName"] . '</label>';
	$cd .= '<label for="' . $_SESSION["clientLastName"] . '">' . $_SESSION["clientLastName"] . '</label><br>';
	$cd .= '<p>' . $_SESSION["clientAddress"] . '</p>';
	$cd .= '<p>' . $_SESSION["clientCity"] . ', ' . $_SESSION["clientState"] . '   ' . $_SESSION["clientZip"] . '</p>';
	$cd .= '<p>' . $_SESSION["clientAddress"] . '</p>';
	//Build Products
    foreach ($_SESSION["productsReviewed"] as $product) {
		$cd .= '<label for="' . $product . '">' . $product . '</label>';
    }
    $cd .= '</ul>';
	
    return $cd;
}

?>