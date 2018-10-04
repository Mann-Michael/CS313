<?php

/* 
 * this is the PRODUCTS model
 */

 function getProducts() {
    //This function acts like a model, but instead of querying, it just stores the products

	$products = array(
		array("card1","100"), 
		array("card2","200"), 
		array("card3","300"), 
		array("card4","400"), 
		array("card5","500")	
	);

    return $products;
}

?>