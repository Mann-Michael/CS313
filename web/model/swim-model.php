<?php

/* 
 * This is the model for SWIMTRACKER
 */

/* 
 * This will handle site registrations
 */

function getSwimmers() {
    $db = dbConnect();
    $sql = 'SELECT name FROM swimmer';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $swimmers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $swimmers;
}
?>