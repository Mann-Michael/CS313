<?php

/* 
 * this is the PRODUCTS model
 */

 function getProducts() {
    //This function acts like a model, but instead of querying, it just stores the products

	$products = array("product 1", "product 2", "product 3", "product 4", "product 5",);

    return $products;
}

?>