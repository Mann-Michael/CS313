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
			
			$swimmers= $db->query('SELECT name FROM swimmers');
			$swimmerList = $statement->fetchAll(PDO::FETCH_ASSOC);

		

		
            include '../view/swim-home.php';
    }
?>
