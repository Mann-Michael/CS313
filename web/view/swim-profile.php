<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Michael Mann .tech</title>
		<?php include ("../common/head.php"); ?>
		<?php
			//This stuff would normally go in the CONTROLLER
			$swimmerId = test_input($_GET['id']);
			
			//SQL statements, these would usually be in a MODEL, but I can't get that to work
			//Get swimmer info by swimmer id
			$stmt = $db->prepare('SELECT * FROM swimmer WHERE id=:swimmerId');
			$stmt->bindValue(':swimmerId', $swimmerId, PDO::PARAM_INT);
			$stmt->execute();
			$swimmerInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			//Get events by swimmer ID
			$stmt = $db->prepare('
			SELECT stroke.stroketype, distance.distance, time, location, date FROM event INNER JOIN stroke ON stroke.id = event.strokeid INNER JOIN distance ON distance.id = event.distanceid WHERE swimmerid = :swimmerId');
			$stmt->bindValue(':swimmerId', $swimmerId, PDO::PARAM_INT);
			$stmt->execute();
			$eventInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			//Build the swimmer profile
			$swimmerProfile = buildSwimmerProfile($swimmerInfo, $eventInfo);
		?>
    </head>
    <body>
        <header>
        </header>
        <nav>
			<?php include ("../common/nav.php"); ?>
			<h1 id="title">Swimmer Profile</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<?php 
					//If user is logged in and this is their profile, then build add event and edit profile
					if(($_SESSION['loggedin'] == TRUE) && ($_SESSION['id'] = $swimmerId)) {
						echo '<p><a href="index.php?action=viewEditSwimmer">Edit Swimmer</a><span>||</span><a href="index.php?action=viewAddEvent">Add Event</a></p>';
					}
					
					//display swimmer profile
					echo $swimmerProfile;
				?>
            </div>
		</main>
    </body>
</html>



