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
				$stmt = $db->prepare('SELECT * FROM events WHERE strokeId=:strokeId AND strokeId=:distanceId');
				$stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
				$stmt->execute();
				$eventInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				//Get events by swimmer ID
				$stmt = $db->prepare('
				SELECT stroke.stroketype, distance.distance, time, location, date FROM event INNER JOIN stroke ON stroke.id = event.strokeid INNER JOIN distance ON distance.id = event.distanceid WHERE swimmerid = :swimmerId');
				$stmt->bindValue(':swimmerId', $swimmerId, PDO::PARAM_INT);
				$stmt->execute();
				$eventInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				//Build the swimmer profile
				$swimmerProfile = buildSwimmerProfile($swimmerInfo, $eventInfo);
				
				//display swimmer profile
				echo $swimmerProfile;
				
				
				
				
				
				
				?>
            </div>
		</main>
    </body>
</html>