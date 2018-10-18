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
	function dbConnect(){
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
			return $db;
		}
		catch (PDOException $ex){
			echo 'Error!: ' . $ex->getMessage();
			die();
		}
	}
	dbConnect();
	
	//Model Information
	
	//Get all swimmers
	$db = dbConnect();
	$stmt = $db->prepare('SELECT * FROM swimmer');
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	//Get single swimmer profile
	/*$stmt = $db->prepare('SELECT * FROM swimmer');
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	//Get top 3 swim times per event
	$stmt = $db->prepare('SELECT * FROM swimmer');
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);	*/
	
	//Get $action, if $action is null then set it to default
    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
		case 'viewSTUFF':
			break;
		default:
		
			
			


            if(count($rows) > 0){
				echo "swimmers > 0 ";
                $swimmerList = '<table>';
                $swimmerList .= '<thead>';
                $swimmerList .= '<tr><th>Swimmer</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
                $swimmerList .= '</thead>';
                $swimmerList .= '<tbody>';
                foreach ($rows as $row) {
					$swimmerList .= "<tr><td>$row['name']</td>";
                }
					$swimmerList .= '</tbody></table>';
                } else {
					$swimmerList = "<p class='notify'>Sorry, no swimmers were returned.</p>";
                }
		
            include '../view/swim-home.php';
    }
?>
