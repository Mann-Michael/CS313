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
	foreach ($products as $product => $amount) {
		$rd .= '<label for="' . $product . '">' . $product . '</label>';
		$rd .= '<input type="checkbox" name="' . $product . '" value="0"><br>';
	}
    return $rd;
}

function buildCartConfirmDisplay($products){
//This area is for building the display of the Cart Confirm

/*    $cd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $cd .= '<li>';
        $cd .= "<a href='/products/index.php?action=prodSpec&item=$product[invId]'> <img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
        $cd .= '<hr>';
        $cd .= "<a href='/products/index.php?action=prodSpec&item=$product[invId]'> <h2>$product[invName]</h2></a>";
        $cd .= '</li>';
    }
    $cd .= '</ul>';
	*/
    return $cd;
}

?>