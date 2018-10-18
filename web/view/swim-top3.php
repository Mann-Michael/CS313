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
			<h1 id="title">Top 3 Times</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<?php 
				//SQL statements, these would usually be in a model, but I can't get that to work
				$stmt = $db->prepare('SELECT * FROM swimmer');
				$stmt->execute();
				$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				//Build the swimmer list
				$swimmerList = buildSwimmerList($swimmers);
				
				//display swimmer list
				echo $swimmerList;
				
				
				
				
				
				
				?>
            </div>
		</main>
    </body>
</html>