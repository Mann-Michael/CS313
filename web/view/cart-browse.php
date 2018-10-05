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
					//$products = getProducts();
					//$displayProd = buildCartBrowseDisplay($products);
					
					if (isset($displayProd)){echo $displayProd;}
					echo "test3";
				?>
            </div>
		</main>
    </body>
</html>