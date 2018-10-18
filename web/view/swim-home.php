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
				//require_once '../library/connections.php';
				
				$stmt = $db->prepare('SELECT * FROM swimmer');
				$stmt->execute();
				$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($swimmers) > 0){
					$swimmerList = '<table>';
					$swimmerList .= '<thead>';
					$swimmerList .= '<tr><th>Swimmer</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
					$swimmerList .= '</thead>';
					$swimmerList .= '<tbody>';
					foreach ($swimmers as $swimmer) {
						$swimmerList .= "<tr><td>$swimmer[name]</td>";
					}
					$swimmerList .= '</tbody></table>';
                } else {
					$swimmerList = "<p class='notify'>Sorry, no swimmers were returned.</p>";
                }
				
				echo $swimmerList;
				
				
				
				
				
				
				
				?>
            </div>
		</main>
    </body>
</html>