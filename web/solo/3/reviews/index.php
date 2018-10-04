<?php
    //this is the REVIEWS controller

    // Create or access a Session
    session_start();
        
    // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/acme-model.php';
    // Get the reviews model
    require_once '../model/reviews-model.php';
    // Get the products model
    require_once '../model/products-model.php';
    // Get the functions library
    require_once '../library/functions.php';

    // Get the array of categories
    $categories = getCategories();
    //Display the navigation list
    $navList = getNavList($categories);

    $action = filter_input(INPUT_POST, 'action');

    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
    
    switch ($action){
        case 'procNewReview':
            //This case adds a new review

            // First we get and store invID,  reviewText
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            // See if any empty fields, if there are any, we exit
            if(empty($reviewText) || empty($invId)){
                //$message= "<p class='notify'>Please provide information for all empty form fields</p>";
                //header('location: ../products/index.php?action=prodSpec&item='.$invId);
                header("location: ../products/index.php?action=prodSpec&item=".$invId."&message=".urlencode("Please provide information for all empty form fields"));
                exit; 
            }
            
            // Send the data to the model and run addReview
            $updateResult = addReview($reviewText, $invId, $_SESSION['clientData']['clientId']);
            
            // Check and report the result
            if ($updateResult) {
                //$message= "<p class='notify'>Congratulations, your review of $invName is complete!</p>";
                //header('location: ../products/index.php?action=prodSpec&item='.$invId);
                header('location: ../products/index.php?action=prodSpec&item='.$invId . "&message=".urlencode("Congratulations, your review of $invName is complete!"));
                exit;
            }
            else {
                //$message= "<p class='notify'>Sorry, but the review failed. Please try again.</p>";
                //header('location: ../products/index.php?action=prodSpec&item='.$invId);
                header("location: ../products/index.php?action=prodSpec&item=".$invId . "&message=".urlencode("Sorry, but the review failed. Please try again."));
                exit;
            }
            break;
        case 'viewEditReview':
            //Deliver a view to edit a review.
            $reviewId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $displayAdminReviewEditView = buildAdminReviewEditView($reviewId);
            include '../view/review-update.php';
            break;
        case 'procEditReview':
            //Handle the review edit.
            
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            $updateResult = updateReviewById($reviewId, $reviewText);
            // Check and report the result
            if ($updateResult) {
                //$message = "<p class='notify'>Congratulations, your review was successfully updated.</p>";
                // Send them to the admin view
                header("location: ../accounts/index.php?message=".urlencode("Congratulations, your review was successfully updated."));
                exit;
            }
            else {
                //$message = "<p class='notify'>Sorry, but the review update failed. Please try again.</p>";
                // Send them to the admin view
                header("location: ../accounts/index.php?message=".urlencode("Sorry, but the review update failed. Please try again."));
                exit;
            }
            break;
        case 'viewConfirmDeleteReview':
            //Deliver a view to confirm deletion of a review.
            $reviewId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $displayAdminReviewDeleteView = buildAdminReviewDeleteView($reviewId);
            
            include '../view/review-delete.php';
            break;
        case 'procDeleteReview':
            //Handle the review deletion.
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            $updateResult = deleteReviewById($reviewId);
            // Check and report the result
            if ($updateResult) {
                //$message = "<p class='notify'>Congratulations, your review was successfully deleted.</p>";
                // Send them to the admin view
                //header('location: ../accounts/');
                header("location: ../accounts/index.php?message=".urlencode("Congratulations, your review was successfully deleted."));
                exit;
            }
            else {
                //$message = "<p class='notify'>Sorry, but the review delete failed. Please try again.</p>";
                // Send them to the admin view
                header("location: ../accounts/index.php?message=".urlencode("Sorry, but the review delete failed. Please try again."));
                exit;
            }
            break;
        default:
            //A default that will deliver the "admin" view if the client is logged in or the
            
            header('location: ../accounts/');

    }
?>