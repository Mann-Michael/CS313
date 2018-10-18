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
			<h1 id="title">Swimmer Profile</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<?php 
				
				$swimmerId = test_input($_GET['id']);
				
				//SQL statements, these would usually be in a model, but I can't get that to work
				$stmt = $db->prepare('SELECT * FROM swimmer WHERE id=:swimmerId');
				$stmt->execute();
				$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				print_r($swimmers);
				//Build the swimmer list
				$swimmerProfile = buildSwimmerProfile($swimmerId);
				
				//display swimmer list
				echo $swimmerProfile;
				
				?>
            </div>
		</main>
    </body>
</html>