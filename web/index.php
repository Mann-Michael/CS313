<?php

//this is the MICHAELMANN.TECH controller

// Get the functions library
require_once 'library/functions.php';

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'viewAbout':
		include 'view/about.php';
        break;
    default:
        include 'view/home.php';
}



foreach ($db->query('SELECT name FROM swimmer') as $row)
{
  echo 'name: ' . $row['name'];
  echo '<br/>';
}
?>
