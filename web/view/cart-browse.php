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
                //if (isset($displayProd)) {
                    //echo $displayProd;
					
				$products = array(1,2,3,4,5,6,7);
				
				<ul>
				foreach ($products as $product) {
					echo "<li>$product</li><br>";
				</ul>
					
				echo "test2";
				?>
            </div>
		</main>
    </body>
</html>