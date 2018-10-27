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
			<h1 id="title">Swimmer Login</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<form method="post" action="index.php">
					<div class="field-wrapper">
						<label>Email</label>
						<input type="text" name="swimmerEmail">
					</div>
					<div class="field-wrapper">
						<label>Password</label>
						<input type="text" name="swimmerPassword">
					</div>
					<div class="field-wrapper">
						<input type="submit" name="btnLogin"></input>
						<input type="hidden" name="action" value="procLogin">
					</div>
				</form>				
            </div>
		</main>
    </body>
</html>