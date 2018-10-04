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
			<h1 id="title">Browse</h1>
        </nav>
        <main>            
            <div class="floatpage" id="default" >
				<?php
                //if (isset($displayProd)) {
                    //echo $displayProd;
					
				            $majors =
                array(
                    "test1",
                    "test2",
                    "test3",
                    "test4"
                );

            foreach($majors as $major) {
                echo "<input type='radio' name='major' value='$major'>$major<br>";
            }
					
				echo "test2";
				?>
            </div>
		</main>
    </body>
</html>