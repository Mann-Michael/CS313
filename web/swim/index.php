<?php
    //This is the SWIM controller
	
	// Create or access a Session
	session_start();

    //Get the functions library
    require_once '../library/functions.php';
    //Get the connections library
    require_once '../library/connections.php';
	//Get the swim model
    require_once '../model/swim-model.php';

	//Create general information - UNUSED 
	
	//Get $action, if $action is null then set it to default
    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
		case 'viewSTUFF':
			break;
		default:
		
			try
			{
			  $dbUrl = getenv('DATABASE_URL');

			  $dbOpts = parse_url($dbUrl);

			  $dbHost = $dbOpts["host"];
			  $dbPort = $dbOpts["port"];
			  $dbUser = $dbOpts["user"];
			  $dbPassword = $dbOpts["pass"];
			  $dbName = ltrim($dbOpts["path"],'/');

			  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

			  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (PDOException $ex)
			{
			  echo 'Error!: ' . $ex->getMessage();
			  die();
			}
			$stmt = $db->prepare('SELECT * FROM swimmer WHERE id=:id AND name=:name');
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			$swimmers = $rows;
            if(count($swimmers) > 0){
				echo "swimmers > 0 ";
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
					$count = count($swimmers);
					echo $count;
					$swimmerList = "<p class='notify'>Sorry, no swimmers were returned.</p>";
                }
		
            include '../view/swim-home.php';
    }
?>
