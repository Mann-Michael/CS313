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
		case 'viewProfile':
			include '../view/swim-profile.php';
			break;
		case 'viewManageSwimmer':
			/*
			this page presents a form allows the user to add events to themselves, or adjust their user information
			*/
			include '../view/swim-manageswimmer.php';
			break;
		case 'procAddEvent':
			/*
			this function processes the user add events to themselves and sends them back to a refreshed manage user page
			*/
			include '../view/swim-manageswimmer.php';
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
			$_SESSION['loggedin'] = TRUE;
			$temp_swimmerId = 1;
			//use the session array to get the swimmer id
			header("location: ../swim/index.php?action=viewProfile&id=".urlencode($temp_swimmerId));
			break;			
		case 'procNewSwimmer':
			/*
			this function creates a new user as long as it doesnt exist yet
			if it exists it sends the user back to viewLogin
			if it doesnt exist, it sends them to viewManageUser
			*/
			include '../view/swim-login.php';
			include '../view/swim-manageswimmer.php';
			break;			
		case 'viewEvents':
			include '../view/swim-events.php';
			break;
		case 'viewSwimmerList':
		default:
		    include '../view/swim-home.php';
    }
?>