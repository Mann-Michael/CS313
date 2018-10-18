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

	//Database Connection
	try{
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
	catch (PDOException $ex){
		echo 'Error!: ' . $ex->getMessage();
		die();
	}
	
	//Model Information
	/*INSERT INTO swimmer(name, age, gender,team,email,password)
	VALUES
	('Avery', 8, FALSE, 'Longhorns', 'avery@avery.com', 'password');*/
	//Get all swimmers
	function getSwimmers(){
		$stmt = $db->prepare('SELECT * FROM swimmer');
		$stmt->execute();
		$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $swimmers;
	}
	//Get single swimmer profile
	function getProfile(){
		$stmt = $db->prepare('SELECT * FROM swimmer');
		$stmt->execute();
		$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $profile;
	}
	
	//Get top 3 swim times per event
	function getTop3(){
		$stmt = $db->prepare('SELECT * FROM swimmer');
		$stmt->execute();
		$swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $top3;
	}
	
	//Get $action, if $action is null then set it to default
    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
		case 'viewSTUFF':
			break;
		default:
		
			
			

			$swimmers = getSwimmers();
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
					$swimmerList = "<p class='notify'>Sorry, no swimmers were returned.</p>";
                }
		
            include '../view/swim-home.php';
    }
?>
