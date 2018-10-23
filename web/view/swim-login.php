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
			<h1 id="title">User Login</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<form method="post" action="index.php">
					<div class="field-wrapper">
						<label>Email</label>
						<input type="text" name=swimmerEmail">
					</div>
					<div class="field-wrapper">
						<label>Password</label>
						<input type="text" name=swimmerPassword">
					</div>
					<input type="submit" name="btnLogin"></input>
					<input type="hidden" name="action" value="procLogin">
				</form>
			
				<?php
				//SQL statements, these would usually be in a model, but I can't get that to work
				//get all swimmers
				$stmt = $db->prepare('SELECT * FROM swimmer');
				$stmt->execute();
				$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
				//get all distances
				$stmt = $db->prepare('SELECT * FROM distance');
				$stmt->execute();
				$distances = $stmt->fetchAll(PDO::FETCH_ASSOC);
				//get all strokes
				$stmt = $db->prepare('SELECT * FROM stroke');
				$stmt->execute();
				$strokes = $stmt->fetchAll(PDO::FETCH_ASSOC);

				//Build the swimmer list
				$swimmerList = buildSwimmerList($swimmers);
				
				//Build the event options list
				$eventOptions = buildEventOptions($distances, $strokes);				
				?>
				
				</div>				
				
            </div>
		</main>
    </body>
</html>