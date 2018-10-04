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
                    "CS"=>"Computer Science",
                    "WDD" => "Web Design and Development",
                    "CIT" => "Computer Information Technology",
                    "CE"  => "Computer Engineering"
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