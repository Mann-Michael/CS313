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
			$swimmers = getSwimmers();
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
                 $message = "<p class='notify'>Sorry, no swimmers were returned.</p>";
                }
		
            include '../view/swim-home.php';
    }
?>
