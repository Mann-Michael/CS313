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
			<h1 id="title">Swim Tracker</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<?php 
				//SQL statements, these would usually be in a model, but I can't get that to work
				//get all swimmers
				$stmt = $db->prepare('SELECT * FROM swimmer');
				$stmt->execute();
				$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
				//get all strokes
				$stmt = $db->prepare('SELECT * FROM stroke');
				$stmt->execute();
				$strokes = $stmt->fetchAll(PDO::FETCH_ASSOC);
				//get all distances
				$stmt = $db->prepare('SELECT * FROM distance');
				$stmt->execute();
				$distances = $stmt->fetchAll(PDO::FETCH_ASSOC);

				//Build the swimmer list
				$swimmerList = buildSwimmerList($swimmers);
				
				//display swimmer list
				echo $swimmerList;
				?>
				<select name="distance" id="distanceID">
					<option selected="selected">Select Distance</option>
				<?php 
					foreach ($distances as $distance){?>
						<option value="<?= $distance['distanceId'] ?>"><?= $distance['distance'] ?></option>
					<?php}
				
				//Build the event options list
				//$eventOptions = buildEventOptions($strokes, $distances);
				
				//display event options list
				//echo $eventOptions;
				
				?>
            </div>
		</main>
    </body>
</html>