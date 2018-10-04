<?php

function buildCartBrowseDisplay($products){
//This area is for building the display of the Cart Browse
    $bd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $bd .= '<li>';
        $bd .= "$product[";
        $bd .= '<hr>';
        $bd .= "<a href='/products/index.php?action=prodSpec&item=$product[invId]'> <h2>$product[invName]</h2></a>";
        $bd .= '</li>';
    }
    $bd .= '</ul>';
    return $bd;
}

function buildCartReviewDisplay($products){
//This area is for building the display of the Cart Review

/*    $rd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $rd .= '<li>';
        $rd .= "<a href='/products/index.php?action=prodSpec&item=$product[invId]'> <img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
        $rd .= '<hr>';
        $rd .= "<a href='/products/index.php?action=prodSpec&item=$product[invId]'> <h2>$product[invName]</h2></a>";
        $rd .= '</li>';
    }
    $rd .= '</ul>';
	*/
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