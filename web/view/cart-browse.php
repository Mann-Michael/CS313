<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Michael Mann .tech</title>
		<?php include ("../common/head.php"); ?>
    </head>
    <body>
        <header>
        </header>
        <nav>
			<?php include ("../common/nav.php"); ?>
			<h1 id="title">Browse</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<?php
//                if (isset($displayProd)) {
//                    echo $displayProd;
//				}					

											$products = array(
							array("card1","100"), 
							array("card2","200"), 
							array("card3","300"), 
							array("card4","400"), 
							array("card5","500")	
						);
	

function buildCartBrowseDisplay($products){
//This area is for building the display of the Cart Browse
	$length = sizeof($products);
	$bd = '<ul>';
	for ($i = 0; $i < $length; $i++) {
		$bd .= '<li>';
		$bd .=	$products[$i][0];
		$bd .= ",";
		$bd .= $products[$i][1];
		$bd .=	'</li>';
	}
	$bd .= '</ul>';

    return $bd;
}
	$displayProd = buildCartBrowseDisplay($products);
	echo $displayProd;
/*						
							$length = sizeof($products);
							$bd = '<ul>';
							for ($i = 0; $i < $length; $i++) {
								$bd .= '<li>';
								$bd .=	$products[$i][0];
								$bd .= ",";
								$bd .= $products[$i][1];
								$bd .=	'</li>';
							}
							$bd .= '</ul>';
						echo $bd;
						
						$length = sizeof($products);
					
						for ($i = 0; $i < $length; $i++) {
							echo "<li>" . $products[$i][0]. "," . $products[$i][1] . "</li>";
						}
*/					
				echo "test2";
				?>
            </div>
		</main>
    </body>
</html>