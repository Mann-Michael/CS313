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
			<h1 id="title">Checkout</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<form method="post" action="index.php">
					<label>First Name: </label><br>
					<input type="text" name="clientFirstName" id="clientFirstName" <?php if(isset($_SESSION["clientFirstName"])){echo "value='" . $_SESSION["clientFirstName"] . "'";} ?> required ><br>
					<label>Last Name: </label><br>
					<input type="text" name="clientLastName" id="clientLastName" <?php if(isset($_SESSION["clientLastName"])){echo "value='" . $_SESSION["clientLastName"] . "'";} ?> required ><br>
					<label>Street Address: </label><br>
					<input type="text" name="clientAddress" id="clientAddress" <?php if(isset($_SESSION["clientAddress"])){echo "value='" . $_SESSION["clientAddress"] . "'";} ?> required ><br>
					<label>City: </label><br>
					<input type="text" name="clientCity" id="clientCity" <?php if(isset($_SESSION["clientCity"])){echo "value='" . $_SESSION["clientCity"] . "'";} ?> required ><br>
					<label>State: </label><br>
					<input type="text" name="clientState" id="clientState" <?php if(isset($_SESSION["clientState"])){echo "value='" . $_SESSION["clientState"] . "'";} ?> required ><br>
					<label>Zip Code: </label><br>
					<input type="text" name="clientZip" id="clientZip" <?php if(isset($_SESSION["clientZip"])){echo "value='" . $_SESSION["clientZip"] . "'";} ?> required ><br>
					<a href="/cart/index.php?action=viewCartReview"> Back to Review <a>
					<input type="submit" name="btnConfirm" value="Confirm">
					<input type="hidden" name="action" value="viewCartConfirm">
				</form>
            </div>
		</main>
    </body>
</html>