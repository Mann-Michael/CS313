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
		case 'viewManageUser':
			/*
			this page presents a form allows the user to add events to themselves, or adjust their user information
			*/
			include '../view/swim-manageuser.php';
			break;
		case 'procAddEvent':
			/*
			this function processes the user add events to themselves and sends them back to a refreshed manage user page
			*/
			include '../view/swim-manageuser.php';
			break;			
		case 'viewLogin':
			/*
			this page presents a form that allows the user to enter user name and password, then sends it to procLogin
			*/
			include '../view/swim-login.php';
			break;
		case 'viewNewUser':
			/*
			this page presents a form that allows the user to enter user information and send it to proc new user
			*/
			include '../view/swim-newuser.php';
			break;
		case 'procLogin':
			/*
			this function checks the users login credentials
			if they are good, they are taken to viewManageUser
			if they are bad, they are taken to viewLogin
			*/
			include '../view/swim-login.php';
			include '../view/swim-manageuser.php';
			break;			
		case 'procNewUser':
			/*
			this function creates a new user as long as it doesnt exist yet
			if it exists it sends the user back to viewLogin
			if it doesnt exist, it sends them to viewManageUser
			*/
			include '../view/swim-login.php';
			include '../view/swim-manageuser.php';
			break;			
		case 'viewEvents':
			include '../view/swim-events.php';
			break;
		case 'viewSwimmerList':
		default:
		    include '../view/swim-home.php';
    }
?>