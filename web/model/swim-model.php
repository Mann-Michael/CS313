<?php

/* 
 * This is the model for SWIMTRACKER
 */

/* 
 * This will handle site registrations
 */

function getSwimmers() {
$swimmers= $db->query('SELECT name FROM swimmers');
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
return $results;
}
?>