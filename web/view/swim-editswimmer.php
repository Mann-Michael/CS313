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
			
			print_r($swimmer);
			
			$swimmerName = $swimmer[0]['name'];
			$swimmerAge = $swimmer[0]['age'];
			$swimmerGender = $swimmer[0]['gender'];
			$swimmerTeam = $swimmer[0]['team'];
			$swimmerEmail = $swimmer[0]['email'];
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
						<input type="radio" name="swimmerGender" value="0" <?php if(isset($swimmerGender) && ($swimmerGender == 0)){ echo 'checked="checked"'; }?>>Female</input>
						<input type="radio" name="swimmerGender" value="1" <?php if(isset($swimmerGender) && ($swimmerGender == 1)){ echo 'checked="checked"'; }?>>Male</input>
						
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