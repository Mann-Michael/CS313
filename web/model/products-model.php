<?php

/* 
 * this is the PRODUCTS model
 */

 function getProducts() {
    //This function acts like a model, but instead of querying, it just stores the products
		$products['card1'] = 100;
		$products['card2'] = 200;
		$products['card3'] = 300;
		$products['card4'] = 400;
		$products['card5'] = 500;
    return $products;
}

?>