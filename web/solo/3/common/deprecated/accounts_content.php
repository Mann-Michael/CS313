<div>
<!--
    email address label
    email input box
    password label
    password input
    login input
    not a member label
    link to registration page
-->
    
    <form>
	<label>Email Address: </label><br>
	<input type="email" name="clientEmail" placeholder="email@domain.com"><br>
	<label>Password: </label><br>
        <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</p>
	<input type="text" name="clientPassword" pattern="([a-zA-Z0-9\s]){5,}" required><br>    
        <input type="submit" name="btnLogin" value="Login"><br>
    </form>
    <h2>Not a member?</h2>
    <!-- need to set this up to be a post/ get -->
    <a href="registration.php">Create an Account</a>
    
</div>