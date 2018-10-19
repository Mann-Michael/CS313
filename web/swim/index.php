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
		case 'viewEvents':
			include '../view/swim-events.php';
			break;
		case 'viewSwimmerList':
		default:
		    include '../view/swim-home.php';
    }
?>