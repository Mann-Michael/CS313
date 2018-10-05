<?php

/* 
 * this is the PRODUCTS model
 */

 function getProducts() {
    //This function acts like a model, but instead of querying, it just stores the products

	$products = array("product1", "product2", "product3", "product4", "product5",);

    return $products;
}

?>