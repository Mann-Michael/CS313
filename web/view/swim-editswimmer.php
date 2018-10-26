<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Michael Mann .tech</title>
		<?php include ("../common/head.php"); ?>
		<?php
		
			$swimmerId = $_SESSION['id'];
			
			//SQL statements, these would usually be in a model, but I can't get that to work
			//get all swimmers
			$stmt = $db->prepare('SELECT * FROM swimmer WHERE id=:swimmerId');
			$stmt->bindValue(':swimmerId', $swimmerId, PDO::PARAM_INT);
			$stmt->execute();
			$swimmer = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
			$swimmerName = $swimmer['name'];
			$swimmerAge = $swimmer['age'];
			$swimmerGender = convertGender($swimmer['gender']);
			$swimmerTeam = $swimmer['team'];
			$swimmerEmail = $swimmer['email'];
		?>
    </head>
    <body>
        <header>
        </header>
        <nav>
			<?php include ("../common/nav.php"); ?>
			<h1 id="title">Edit Swimmer</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<form method="post" action="index.php">
					<div class="field-wrapper">
						<label>Swimmer Name</label>
						<input type="text" name=swimmerName" <?php if(isset($swimmerName)){ echo "value='$swimmerName'"; }?>>
					</div>
					<div class="field-wrapper">
						<label>Age</label>
						<input type="text" name=swimmerAge" <?php if(isset($swimmerAge)){ echo "value='$swimmerAge'"; }?>>
					</div>
					<div class="field-wrapper">
						<label>Gender</label>
						<input type="text" name=swimmerGender" <?php if(isset($swimmerGender)){ echo "value='$swimmerGender'"; }?>>
					</div>
					<div class="field-wrapper">
						<label>Team</label>
						<input type="text" name=swimmerTeam" <?php if(isset($swimmerTeam)){ echo "value='$swimmerTeam'"; }?>>
					</div>
					<div class="field-wrapper">
						<label>Email</label>
						<input type="text" name=swimmerEmail" <?php if(isset($swimmerEmail)){ echo "value='$swimmerEmail'"; }?>>
					</div>
					<div class="field-wrapper">
						<input type="submit" name="btnEditSwimmer"></input>
						<input type="hidden" name="action" value="procEditSwimmer">
					</div>			
				</form>	
            </div>
		</main>
    </body>
</html>