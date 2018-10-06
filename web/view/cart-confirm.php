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
			<h1 id="title">Confirm</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<?php if (isset($displayConfirm)){echo $displayConfirm;}?>
				<br>
				<a href="/cart/index.php?action=viewCartCheckout"> Back to Review <a>
            </div>
		</main>
    </body>
</html>