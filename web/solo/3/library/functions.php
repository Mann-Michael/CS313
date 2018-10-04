<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 */

function checkEmail($clientEmail){
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
  return preg_match($pattern, $clientPassword);
}

function getNavList($categories){
    $navList = '<ul>';
    $navList .= "<li><a href='/index.php' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {
        $navList .= "<li><a href='/products/?action=category&type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= '<li>';
        $pd .= "<a href='/products/index.php?action=prodSpec&item=$product[invId]'> <img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
        $pd .= '<hr>';
        $pd .= "<a href='/products/index.php?action=prodSpec&item=$product[invId]'> <h2>$product[invName]</h2></a>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function buildProdSpecDisplay($product){
    $psd = '<div id="prod-spec-img">';
    $psd .= "<img src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>";
    $psd .= '</div>';
    $psd .= '<div id="prod-spec-details">';
    $psd .= "<h1>$product[invName]</h1>";
    $psd .= "<p>Product ";
    $psd .= "<a href='#reviews'>reviews</a>";
    $psd .= " appear at the bottom of the page. </p>";
    $psd .= "<p>$product[invDescription]</p>";
    $psd .= '<ul>';
    $psd .= "<li>A $product[invVendor] Product</li>";
    $psd .= "<li>Primary Material: $product[invStyle]</li>";    
    $psd .= "<li>Product Weight: $product[invWeight] lbs.</li>";
    $psd .= "<li>Shipping Size: $product[invSize] inches (w x l x h)</li>";    
    $psd .= "<li>$product[invLocation]</li>";    
    $psd .= "<li>Number in Stock: $product[invStock]</li>";
    $psd .= "<li>$$product[invPrice]</li>";
    $psd .= '</ul>';
    $psd .= '</div>';
    return $psd;
}

function truncateUsername($clientId) {
    //this function truncates user name into 'FLastname' format
    $clientInfo = getClientInfo($clientId);
    $username = substr($clientInfo['clientFirstname'],0, 1);
    $username .= $clientInfo['clientLastname'];
    return $username;
}

function displayReview($reviews) {
    //takes reviews for an item and builds a view for each
    $r = "<div class='review-div'>";
    foreach ($reviews as $review){
        $userName = truncateUsername($review['clientId']);
        $date = date("F d, Y", strtotime($review['reviewDate']));
        
        $r .= "<div class='review-spec'>";
        $r .= "<p>" . $userName . " wrote this review on " . $date . "</p>";
        $r .= $review['reviewText'];
        $r .= "</div>";
    }
    $r .= "</div>";
    return $r;
}

function buildReviewForm ($clientId, $invId) {
    $rf = "<span>Screen Name: ";
    $rf .= truncateUsername($clientId);
    $rf .= "</span>";
    $rf .= '<form method="post" action="/reviews/index.php">';
    $rf .= '<label>Review:</label><br>';
    $rf .= '<div class="field-wrapper"><textarea rows="5" cols="80" name="reviewText" id="reviewText" required></textarea></div>';
    $rf .= '<div class="field-wrapper">';
    $rf .= '<input type="submit" name="btnReview" value="Review Product">';
    $rf .= '<input type="hidden" name="action" value="procNewReview">';
    $rf .= '<input type="hidden" name="invId" value="'.$invId;
    $rf .= '"></div></form>';
    return $rf;
}

function buildAdminReviewView ($reviews) {
    $reviewList = '<table>';
    $reviewList .= '<thead>';
    $reviewList .= '<tr><th>Edit Your Reviews</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
    $reviewList .= '</thead>';
    $reviewList .= '<tbody>';
    foreach ($reviews as $review) {
        $date = date("F d, Y", strtotime($review['reviewDate']));
        $product = getProductInfo($review['invId']);
        $reviewList .= "<tr><td>" . $product['invName'] . " (Reviewed on " . $date . "): </td>";
        $reviewList .= "<td><a href='/reviews?action=viewEditReview&id=$review[reviewId]' title='Click to modify'>Modify</a></td>";
        $reviewList .= "<td><a href='/reviews?action=viewConfirmDeleteReview&id=$review[reviewId]' title='Click to delete'>Delete</a></td></tr>";
    }
    $reviewList .= "</tbody></table>";
    return $reviewList;
}

function buildAdminReviewEditView($reviewId){
    //build header with item name + review
    //set variables
    $reviewInfo = getSingleReviewById($reviewId);
    $invInfo = getProductInfo($reviewInfo['invId']);
    $date = $date = date("F d, Y", strtotime($reviewInfo['reviewDate']));
    //build the view
    $reviewEditView = "<h1>" . $invInfo['invName'] . " Review</h1>";
    $reviewEditView .= "<span> Reviewed on " . $date . "</span>";
    $reviewEditView .= '<form method="post" action="/reviews/index.php">';
    $reviewEditView .= '<label>Review:</label><br>';
    $reviewEditView .= '<div class="field-wrapper"><textarea rows="5" cols="80" name="reviewText" id="reviewText" required>' . $reviewInfo['reviewText'] . '</textarea></div>';
    $reviewEditView .= '<div class="field-wrapper">';
    $reviewEditView .= '<input type="submit" name="btnReview" value="Update Review">';
    $reviewEditView .= '<input type="hidden" name="action" value="procEditReview">';
    $reviewEditView .= '<input type="hidden" name="reviewId" value="'.$reviewInfo['reviewId'];
    $reviewEditView .= '"></div></form>';
    return $reviewEditView;
}

function buildAdminReviewDeleteView($reviewId){
    //build header with item name + review
    //set variables
    $reviewInfo = getSingleReviewById($reviewId);
    $invInfo = getProductInfo($reviewInfo['invId']);
    $date = $date = date("F d, Y", strtotime($reviewInfo['reviewDate']));
    //build the view
    $reviewDeleteView = "<h1>" . $invInfo['invName'] . " Review</h1>";
    $reviewDeleteView .= "<span> Reviewed on " . $date . "</span>";
    $reviewDeleteView .= '<form method="post" action="/reviews/index.php">';
    $reviewDeleteView .= '<label>Review:</label><br>';
    $reviewDeleteView .= '<div class="field-wrapper">' . $reviewInfo['reviewText'] . '</div>';
    $reviewDeleteView .= '<div class="field-wrapper">';
    $reviewDeleteView .= '<input type="submit" name="btnReview" value="Delete Review">';
    $reviewDeleteView .= '<input type="hidden" name="action" value="procDeleteReview">';
    $reviewDeleteView .= '<input type="hidden" name="reviewId" value="'.$reviewInfo['reviewId'];
    $reviewDeleteView .= '"></div></form>';
    return $reviewDeleteView;
}
?>