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
			<h1 id="title">Events</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<?php 
				$strokeId = test_input($_POST['strokeId']);
				$distanceId = test_input($_POST['distanceId']);
				
				//SQL statements, these would usually be in a model, but I can't get that to work
				//Get swimmer info by event id
				$stmt = $db->prepare('SELECT
					swimmer.name,
					distance.distance, 
					stroke.stroketype, 
					time, 
					location, 
					date 
					FROM event 
					INNER JOIN stroke ON stroke.id = event.strokeid 
					INNER JOIN distance ON distance.id = event.distanceid 
					INNER JOIN swimmer ON swimmer.id = event.swimmerid
					WHERE strokeid=:strokeId 
					AND distanceid=:distanceId
					ORDER BY time ASC');
				$stmt->bindValue(':strokeId', $strokeId, PDO::PARAM_INT);
				$stmt->bindValue(':distanceId', $distanceId, PDO::PARAM_INT);
				$stmt->execute();
				$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				//Build the swimmer profile
				$eventInfo = buildEventInfo($events);
				
				//display swimmer profile
				echo $eventInfo;
				
				?>
            </div>
		</main>
    </body>
</html>