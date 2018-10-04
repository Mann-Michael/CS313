<?php

/* 
 * this is the PRODUCTS model
 */

 function getProducts() {
    //This function acts like a model, but instead of querying, it just stores the products

	$products = array( 
			"card1"=>100, 
			"card2"=>200, 
			"card3"=>300, 
			"card4"=>400, 
			"card5"=>500
		);

    return $products;
}

?>