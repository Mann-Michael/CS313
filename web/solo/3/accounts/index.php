<?php
    //this is the ACCOUNTS controller

    // Create or access a Session
    session_start();
    
    // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/acme-model.php';
    // Get the accounts model
    require_once '../model/accounts-model.php';
    // Get the reviews model
    require_once '../model/reviews-model.php';
    // Get the product model
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
        case 'viewLogin':
            include '../view/login.php';
            break;
        case 'viewReg':
            include '../view/registration.php';
            break;
        case 'procLogin':
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientEmail = checkEmail($clientEmail);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            $passwordCheck = checkPassword($clientPassword);
            // Run basic checks, return if errors
            if (empty($clientEmail) || empty($passwordCheck)) {
              $message = "<p class='notify'>Please provide a valid email address and password.</p>";
              include '../view/login.php';
              exit;
            }
            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
              $message = "<p class='notify'>Please check your password and try again.</p>";
              include '../view/login.php';
              exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Delete firstname cookie 
            setcookie("firstname", NULL, time()-3600, '/');
            // Send them to the admin view
            //include '../view/admin.php';
            header('location: ../accounts/');
            exit;
            break;
        case 'procReg':
            // Filter and store the data
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            // Check email and password against proper form constraints
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);
            $existingEmail = checkExistingEmail($clientEmail);
            // Check for existing email address in the table
            if($existingEmail){
              $message = "<p class='notify'>That email address already exists. Do you want to login instead?</p>";
              include '../view/login.php';
              exit;
            }
            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
                $message = "<p class='notify'>Please provide information for all empty form fields.</p>";
                include '../view/registration.php';
                exit; 
            }
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
            // Check and report the result
            if($regOutcome === 1){
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $message = "<p class='notify'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
               include '../view/login.php';
               exit;
            } 
            else {
                $message = "<p class='notify'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
            break;
        case 'procLogout':
            session_destroy();
            setcookie("firstname", NULL, time()-3600, '/');
            header('Location: ../index.php');
            break;
        case 'mod':
            $clientEmail = $_SESSION['clientData']['clientEmail'];
            $clientData = getClient($clientEmail);
            if(count($clientData)<1){
                $message = "<p class='notify'>Sorry, no client information could be found.</p>";
            }
            include '../view/client-update.php';
            exit;
            break;
        case 'updateClient':
            // Filter and store the data
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_STRING);

            //validate email form on server
            $clientEmail = checkEmail($clientEmail);
            
            if ($clientEmail !== $_SESSION['clientData']['clientEmail']) {
                // Check for existing email address in the table
                $existingEmail = checkExistingEmail($clientEmail);
                
                if($existingEmail){
                    $message = "<p class='notify'>That email address already exists. Do you want to login instead?</p>";
                    include '../view/login.php';
                    exit;
                }
            }
            // Check for missing data
            if(empty($clientId) || empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
                $message = "<p class='notify'>Please provide information for all empty form fields</p>";
                include '../view/client-update.php';
                exit; 
            }
            // Send the data to the model
            $updateResult = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail);
            // Check and report the result
            if ($updateResult) {
                //$message = "<p class='notify'>Congratulations, your account was successfully updated.</p>";
                //Reload the session with client info by id
                $clientData = getClientInfo($clientId);
                // Store the array into the session
                $_SESSION['clientData'] = $clientData;
                // Send them to the admin view
                //include '../view/admin.php';
                header("location: ../accounts/index.php?message=".urlencode("Congratulations, your account was successfully updated."));
                exit;
            }
            else {
                //$message = "<p class='notify'>Sorry, but the update account failed. Please try again.</p>";
                //include '../view/admin.php';
                header("location: ../accounts/index.php?message=".urlencode("Sorry, but the update account failed. Please try again."));
                exit;
            }
            break;
        case 'updatePW':
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            // Check password against proper form constraints
            $checkPassword = checkPassword($clientPassword);
            if(empty($checkPassword)){
                $message = "<p class='notify'>Please provide information for all empty form fields.</p>";
                include '../view/client-update.php';
                exit; 
            }
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            // Send the data to the model
            $updateResult = updatePW($clientId, $hashedPassword);
            // Check and report the result
            if ($updateResult) {
                //$message = "<p class='notify'>Congratulations, your password was successfully updated.</p>";
                //$_SESSION['message'] = $message;
                //Reload the session with client info by id
                $clientData = getClientInfo($clientId);
                // Store the array into the session
                $_SESSION['clientData'] = $clientData;
                // Send them to the admin view
                //include '../view/admin.php';
                header("location: ../accounts/index.php?message=".urlencode("Congratulations, your password was successfully updated."));
                exit;
            }
            else {
                //$message = "<p class='notify'>Sorry, but the update password failed. Please try again.</p>";
                //include '../view/admin.php';
                header("location: ../accounts/index.php?message=".urlencode("Sorry, but the update password failed. Please try again."));
                exit;
            }
            break;
        default:
            //get reviews by client id
            $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
            //if the reviews are not empty, then build a view
            if(count($reviews) > 0){
                $displayAdminReviewView = buildAdminReviewView($reviews);
            } else {
                $message = "<p class='notify'>Sorry, you have no reviews.</p>";
            }
            include '../view/admin.php';
            //header('location: ../accounts/');
    }
?>