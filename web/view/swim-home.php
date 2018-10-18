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
				
				$stmt = $db->prepare('SELECT * FROM swimmer');
				$stmt->execute();
				$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$swimmerList = buildSwimmerList($swimmers);
				
				echo $swimmerList;
				
				?>
            </div>
		</main>
    </body>
</html>