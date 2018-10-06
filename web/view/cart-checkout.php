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
				    <div class="field-wrapper">
                        <label>First Name: </label><br>
                        <input type="text" name="clientFirstName" id="clientFirstName" <?php if(isset($clientFirstName)){echo "value='$clientFirstName'";} ?> required ><br>
						
                        <label>Last Name: </label><br>
                        <input type="text" name="clientLastName" id="clientLastName" <?php if(isset($clientLastName)){echo "value='$clientLastName'";} ?> required ><br>
                    </div>
				    <div class="field-wrapper">

                    </div>
				    <div class="field-wrapper">
                        <label>Street Address: </label><br>
                        <input type="text" name="clientAddress" id="clientAddress" <?php if(isset($clientAddress)){echo "value='$clientAddress'";} ?> required ><br>
                    </div>
				    <div class="field-wrapper">
                        <label>City: </label><br>
                        <input type="text" name="clientCity" id="clientCity" <?php if(isset($clientCity)){echo "value='$clientCity'";} ?> required ><br>
                    </div>
				    <div class="field-wrapper">
                        <label>State: </label><br>
                        <input type="text" name="clientState" id="clientState" <?php if(isset($clientState)){echo "value='$clientState'";} ?> required ><br>
                    </div>
				    <div class="field-wrapper">
                        <label>Zip Code: </label><br>
                        <input type="text" name="clientZip" id="clientZip" <?php if(isset($clientZip)){echo "value='$clientZip'";} ?> required ><br>
                    </div>					
				<a href="/cart/index.php?action=viewCartReview"> Back to Review <a>
				<input type="submit" name="btnConfirm" value="Confirm">
				<input type="hidden" name="action" value="viewCartConfirm">
            </div>
		</main>
    </body>
</html>