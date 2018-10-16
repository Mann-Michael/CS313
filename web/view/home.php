<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Michael Mann .tech</title>
		<?php include ("common/head.php"); ?>
    </head>
    <body>
        <header>
        </header>
        <nav>
			<?php include ("common/nav.php"); ?>
			<h1 id="title">CS 313 Assignments</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<ul>
					<li><a href="/team/3/teamActivity.php">Team Assignment Week 3</a></li>
					<li><a href="/cart/index.php">Shopping Cart</a></li>
					<li><a href="#">Link 3</a></li>
					<li><a href="#">Link 4</a></li>
				</ul>
				
				<?php
				
				foreach ($db->query('SELECT name FROM swimmer') as $row){
					echo 'name: ' . $row['name'];
					echo '<br/>';
				};

				?>
            </div>
		</main>
    </body>
</html>