<div class="headerdiv">
    <div>
	<img id="logo" src="../images/logo.gif" alt="ACME logo">
    </div>
    <div>
        <h2>
            <?php

            //when logged out show img + My Account that links to Login Screen
            //when logged in show img + welcome link to admin view and Logout with link to logout

                $msgLogin = '<img id="accountfolder" src="../images/account.gif" alt="my account folder"> My Account';
                $linkLogin = '<a href="../accounts/index.php?action=viewLogin">';
                $msgWelcome ="";
                if (isset($_SESSION['loggedin'])) {
                    if($_SESSION['loggedin'] === TRUE){
                        $msgLogin = "Logout";
                        $linkLogin = '<a href="../accounts/index.php?action=procLogout">';
                        //fill out the welcome message
                        $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
                        $msgWelcome = '<span><a href="../accounts/index.php">Welcome ';
                        $msgWelcome .= $cookieFirstname;
                        $msgWelcome .= '</a> | </span>';
                        echo $msgWelcome;
                    }
                }    
                $linkLogin .= $msgLogin;
                $linkLogin .= '</a>';
                echo $linkLogin;
            ?>
        </h2>
    </div>
</div>