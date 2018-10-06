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
			<h1 id="title">Review</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<form method="post" action="index.php">
					<?php if (isset($displayReview)){echo $displayReview;}?>
					<a href="/cart/index.php"> Back to Browse <a>
					<input type="submit" name="btnCheckout" value="Checkout">
					<input type="hidden" name="action" value="viewCartCheckout">
				</form>
            </div>
		</main>
    </body>
</html>