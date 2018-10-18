<?php
    //This is the SWIM controller
	
	// Create or access a Session
	session_start();

    //Get the functions library
    require_once '../library/functions.php';
    //Get the connections library (when ready)
    //require_once '../library/connections.php';
	//Get the swim model (when ready)
    //require_once '../model/swim-model.php';

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
	
	//Get all swimmers (make a function later)
		$stmtSwimmers = $db->prepare('SELECT * FROM swimmer');
		$stmtSwimmers->execute();
		$swimmers = $stmtSwimmers->fetchAll(PDO::FETCH_ASSOC);
		
	//Get single swimmer profile(make a function later)
		$stmtProfile = $db->prepare('SELECT * FROM swimmer WHERE id= ;id');
		$stmtProfile->execute();
		$profile = $stmtProfile->fetchAll(PDO::FETCH_ASSOC);

	
	//Get top 3 swim times per event (make a function later)
		$stmtTop3 = $db->prepare('SELECT * FROM swimmer');
		$stmtTop3->execute();
		$top3 = $stmtTop3->fetchAll(PDO::FETCH_ASSOC);
	
	//Get $action, if $action is null then set it to default
    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
		case 'viewProfile':
			include '../view/swim-profile.php';
			break;
		case 'viewTop3':
			include '../view/swim-top3.php';
			break;
		case 'viewSwimmerList':
		default:
		
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
		
            include '../view/swim-home.php';
    }
?>
