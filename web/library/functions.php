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
	$cd .= '<p>' . $_SESSION["clientAddress"] . '</p>';
	$cd .= '<p>' . $_SESSION["clientCity"] . ', ' . $_SESSION["clientState"] . '   ' . $_SESSION["clientZip"] . '</p>';
	//Build Products
    $cd .= '<h2>Products Ordered</h2>';
	$cd .= '<ul>';
	foreach ($_SESSION["productsReviewed"] as $product) {
		$cd .= '<li><label for="' . $product . '">' . $product . '</label></li>';
    }
    $cd .= '</ul>';
	
    return $cd;
}


function buildSwimmerList($swimmers){
		if(count($swimmers) > 0){
		$sl = '<table>';
		$sl .= '<thead>';
		$sl .= '<tr><th>Swimmer</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
		$sl .= '</thead>';
		$sl .= '<tbody>';
		foreach ($swimmers as $swimmer) {
			$sl .= "<tr><td>$swimmer[name]</td>";
		}
		$sl .= '</tbody></table>';
	} else {
		$sl = "<p class='notify'>Sorry, no swimmers were returned.</p>";
	}
	return $sl;
}

function buildSwimmerProfile(){
	$sp;
	return $sp;
}


function buildTop3(){
	$t3;
	return $t3;
}
?>