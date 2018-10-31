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
			<h1 id="title">Oh No!</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<div>
					<h2>Error</h2>
					<?php				
						//display error
						if(isset($_SESSION['error']))
							{
								echo $_SESSION['error'];
							}
												
						$errorRedirect = filter_input(INPUT_GET, 'errorRedirect', FILTER_SANITIZE_STRING);
						$errorButton = '<form method="post" action="index.php"><br><input type="submit" name="btnError"></input>';
						$errorButton .= '<input type="hidden" name="action" value="' . $errorRedirect . '"></form>';
						echo($errorButton);
						
						//unset variables
						//unset($_SESSION['error']);
						//unset($errorRedirect);
						
					?>
				</div>
            </div>
		</main>
    </body>
</html>