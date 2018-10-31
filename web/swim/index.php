<?php
    //This is the SWIM controller
	
	// Create or access a Session
	session_start();

    //Get the functions library
    require_once '../library/functions.php';
    //Get the connections library (when ready)
    require_once '../library/connections.php';
	//Get the swim model (when ready)
    //require_once '../model/swim-model.php';
	
	//Get $action, if $action is null then set it to default
    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
		case 'viewError':
			include = '../view/swim-error.php';
			break;
		case 'viewProfile':
			include '../view/swim-profile.php';
			break;
		case 'viewAddEvent':
			/*
			this page presents a form allows the user to add events to themselves, or adjust their user information
			*/
			include '../view/swim-addevent.php';
			break;
		case 'viewEditSwimmer':
			/*
			this page presents a form allows the user to add events to themselves, or adjust their user information
			NEED TO DO THIS!!!
			*/
			include '../view/swim-editswimmer.php';
			break;
		case 'procAddEvent':
			/*
			this function processes the user add events to themselves and sends them back to a refreshed manage user page
			*/
			//Get variables from hidden post
			$swimmerId = $_SESSION['id'];
			$strokeId = filter_input(INPUT_POST, 'strokeId', FILTER_SANITIZE_NUMBER_INT);
			$distanceId = filter_input(INPUT_POST, 'distanceId', FILTER_SANITIZE_NUMBER_INT);
			$eventTime = filter_input(INPUT_POST, 'eventTime', FILTER_SANITIZE_NUMBER_INT);
			$eventLocation = filter_input(INPUT_POST, 'eventLocation', FILTER_SANITIZE_STRING);
			//Prepare statement
			$stmt = $db->prepare('INSERT INTO event (swimmerid, strokeid, distanceid, time, location, date)
			VALUES (:swimmerId, :strokeId, :distanceId, :eventTime, :eventLocation, CURRENT_DATE)');
			$stmt->bindValue(':swimmerId', $swimmerId, PDO::PARAM_INT);
			$stmt->bindValue(':strokeId', $strokeId, PDO::PARAM_INT);
			$stmt->bindValue(':distanceId', $distanceId, PDO::PARAM_INT);
			$stmt->bindValue(':eventTime', $eventTime, PDO::PARAM_INT);
			$stmt->bindValue(':eventLocation', $eventLocation, PDO::PARAM_STR);
			$stmt->execute();
			//send to view
			header("location: ../swim/index.php?action=viewProfile&id=".urlencode($_SESSION['id']));
			break;
		case 'procEditSwimmer':
			/*
			this function processes the edit swimmer for themselves and sends them back to a refreshed manage user page
			NEED TO DO THIS!!
			*/
			//Get variables from hidden post
			$swimmerId = $_SESSION['id'];
			$swimmerName = filter_input(INPUT_POST, 'swimmerName', FILTER_SANITIZE_STRING);
			$swimmerAge = filter_input(INPUT_POST, 'swimmerAge', FILTER_SANITIZE_NUMBER_INT);
			$swimmerGender = filter_input(INPUT_POST, 'swimmerGender', FILTER_SANITIZE_NUMBER_INT);
			$swimmerTeam = filter_input(INPUT_POST, 'swimmerTeam', FILTER_SANITIZE_STRING);
			$swimmerEmail = filter_input(INPUT_POST, 'swimmerEmail', FILTER_SANITIZE_STRING);
			
			//UPDATE swimmer 
			//SET name = 'Avery', age = 9, gender = FALSE, team = 'Longhorns', email = 'avery@avery.com'
			//WHERE id = 1;
			//Prepare statement
			$stmt = $db->prepare('UPDATE swimmer
			SET name = :swimmerName, age = :swimmerAge, gender = :swimmerGender, team = :swimmerTeam, email = :swimmerEmail
			WHERE id = :swimmerId');
			$stmt->bindValue(':swimmerId', $swimmerId, PDO::PARAM_INT);
			$stmt->bindValue(':swimmerName', $swimmerName, PDO::PARAM_STR);
			$stmt->bindValue(':swimmerAge', $swimmerAge, PDO::PARAM_INT);
			$stmt->bindValue(':swimmerGender', $swimmerGender, PDO::PARAM_BOOL);
			$stmt->bindValue(':swimmerTeam', $swimmerTeam, PDO::PARAM_STR);
			$stmt->bindValue(':swimmerEmail', $swimmerEmail, PDO::PARAM_STR);
			$stmt->execute();
			//send to view
			header("location: ../swim/index.php?action=viewProfile&id=".urlencode($_SESSION['id']));
			break;			
		case 'viewLogin':
			//This page presents a form that allows the user to enter user name and password, then sends it to procLogin
			include '../view/swim-login.php';
			break;
		case 'viewNewSwimmer':
			/*
			this page presents a form that allows the user to enter user information and send it to proc new user
			*/
			include '../view/swim-newswimmer.php';
			break;
		case 'procLogout':
			//Destroy the session and send them back to home page
			session_destroy();
			header("location: ../swim/index.php");
			break;	
		case 'procLogin':
			//Search for swimmer with this email and fill out session array
			//compare password to the password for the email
			//if the check is true, then include swim-profile with swimmerId
			//if the check is false, then include the login screen and say it failed
			//NEED TO DO THIS
			
			//load variables from the form
			$swimmerEmail = filter_input(INPUT_POST, 'swimmerEmail', FILTER_SANITIZE_STRING);
            $swimmerPassword = filter_input(INPUT_POST, 'swimmerPassword', FILTER_SANITIZE_STRING);
			
			//using the email, find the account info
			$stmt = $db->prepare('SELECT * FROM swimmer WHERE email = :swimmerEmail');
			$stmt->bindValue(':swimmerEmail', $swimmerEmail, PDO::PARAM_STR);
			$stmt->execute();
			$swimmerInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			//see if there is an email and return a warning INCOMPLETE
			
			//if there is an existing email, then match the password
			$hashCheck = password_verify($swimmerPassword, $swimmerInfo[0]['password']);
			//if the hased PWs don't match, then print an error
            //and return to the login view
            if (!$hashCheck) {
				$_SESSION['error'] = "<p>Incorrect password, please try again.</p>";
				$errorRedirect = "viewLogin";
				header("location: ../swim/index.php?action=viewError&errorRedirect=".urlencode($errorRedirect));
				exit;
            }
			
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
			$_SESSION['id'] = $swimmerInfo[0]['id'];
			//use the session array to get the swimmer id
			header("location: ../swim/index.php?action=viewProfile&id=".urlencode($_SESSION['id']));
			break;			
		case 'procNewSwimmer':
			//adds swimmer
			//Get variables from hidden post
			$swimmerName = filter_input(INPUT_POST, 'swimmerName', FILTER_SANITIZE_STRING);
			$swimmerAge = filter_input(INPUT_POST, 'swimmerAge', FILTER_SANITIZE_NUMBER_INT);
			$swimmerGender = filter_input(INPUT_POST, 'swimmerGender', FILTER_SANITIZE_NUMBER_INT);
			$swimmerTeam = filter_input(INPUT_POST, 'swimmerTeam', FILTER_SANITIZE_STRING);
			$swimmerEmail = filter_input(INPUT_POST, 'swimmerEmail', FILTER_SANITIZE_STRING);
			$swimmerPassword = filter_input(INPUT_POST, 'swimmerPassword', FILTER_SANITIZE_STRING);
			//Check to see if swimmer already exists
			//NO CODE HERE YET but if same swimmer exists, take them back to new swimmer page with message
			
			//hash the password
			$hashedPassword = password_hash($swimmerPassword, PASSWORD_DEFAULT);
			
			//Prepare statement
			$stmt = $db->prepare('INSERT INTO swimmer (name, age, gender, team, email, password)
			VALUES (:swimmerName, :swimmerAge, :swimmerGender, :swimmerTeam, :swimmerEmail, :swimmerPassword)');
			$stmt->bindValue(':swimmerName', $swimmerName, PDO::PARAM_STR);
			$stmt->bindValue(':swimmerAge', $swimmerAge, PDO::PARAM_INT);
			$stmt->bindValue(':swimmerGender', $swimmerGender, PDO::PARAM_BOOL);
			$stmt->bindValue(':swimmerTeam', $swimmerTeam, PDO::PARAM_STR);
			$stmt->bindValue(':swimmerEmail', $swimmerEmail, PDO::PARAM_STR);
			$stmt->bindValue(':swimmerPassword', $hashedPassword, PDO::PARAM_STR);
			$stmt->execute();
			//send to view
			header("location: ../swim/index.php");
			break;			
		case 'viewEvents':
			include '../view/swim-events.php';
			break;
		case 'viewSwimmerList':
		default:
		    include '../view/swim-home.php';
    }
?>

