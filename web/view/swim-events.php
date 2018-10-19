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