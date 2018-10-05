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
			<form method="post" action="index.php">
				<?php if (isset($displayProd)){echo $displayProd;}?>
				<input type="submit" name="btnReview" value="Review Checkout">
				<input type="hidden" name="action" value="viewCartReview">
			</form>
	
            </div>
		</main>
    </body>
</html>