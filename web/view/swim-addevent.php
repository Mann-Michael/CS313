<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Michael Mann .tech</title>
		<?php include ("../common/head.php"); ?>
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
    </head>
    <body>
        <header>
        </header>
        <nav>
			<?php include ("../common/nav.php"); ?>
			<h1 id="title">Add Event</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<form method="post" action="index.php">
					<div class="field-wrapper">
						<label>Swimmer Name</label>
						<input type="text" name=swimmerName">
					</div>
					<div class="field-wrapper">
						<label>Age</label>
						<input type="text" name=swimmerAge">
					</div>
					<div class="field-wrapper">
						<label>Gender</label>
						<input type="text" name=swimmerGender">
					</div>
					<div class="field-wrapper">
						<label>Team</label>
						<input type="text" name=swimmerTeam">
					</div>
					<div class="field-wrapper">
						<label>Email</label>
						<input type="text" name=swimmerEmail">
					</div>
					<div class="field-wrapper">
						<label>Password</label>
						<input type="text" name=swimmerPassword">
					</div>
					<div class="field-wrapper">
						<input type="submit" name="btnNewSwimmer"></input>
						<input type="hidden" name="action" value="procNewSwimmer">
					</div>			
				</form>					
            </div>
		</main>
    </body>
</html>