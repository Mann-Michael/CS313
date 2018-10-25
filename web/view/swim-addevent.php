<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Michael Mann .tech</title>
		<?php include ("../common/head.php"); ?>
		<?php
			//SQL statements, these would usually be in a model, but I can't get that to work
			//get all distances
			$stmt = $db->prepare('SELECT * FROM distance');
			$stmt->execute();
			$distances = $stmt->fetchAll(PDO::FETCH_ASSOC);
			//get all strokes
			$stmt = $db->prepare('SELECT * FROM stroke');
			$stmt->execute();
			$strokes = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
						<label>Distance/ Stroke</label>
						<?php
							$distanceOptions = buildDistanceOptions($distances);
							echo $distanceOptions;
						?>
					</div>
					<div class="field-wrapper">
						<label>Stroke</label>
						<?php 
							$strokeOptions = buildStrokeOptions($strokes);
							echo $strokeOptions;
						?>
					</div>
					<div class="field-wrapper">
						<label>Time</label>
						<input type="text" name="eventTime">
					</div>
					<div class="field-wrapper">
						<label>Location</label>
						<input type="text" name="eventLocation">
					<div class="field-wrapper">
						<input type="submit" name="btnAddEvent"></input>
						<input type="hidden" name="action" value="procAddEvent">
					</div>			
				</form>					
            </div>
		</main>
    </body>
</html>