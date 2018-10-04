<div>
<!--
    all fields are required
    first name label
    first name input
    last name label
    last name input
    email label
    email input
    password label
    password input
    register button
-->

    <form>
        <p>All fields are required.</p>
	<label>First Name*: </label><br>
	<input type="text" name="clientFirstname" pattern="([a-zA-Z0-9\s]){5,}" required><br>
        <label>Last Name*: </label><br>
	<input type="text" name="clientLastname" pattern="([a-zA-Z0-9\s]){5,}" required><br>
        <label>Email Address: </label><br>
	<input type="email" name="clientEmail" placeholder="email@domain.com" required><br>
	<label>Password: </label><br>
        <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</p>
	<input type="text" name="clientPassword" pattern="([a-zA-Z0-9\s]){5,}" required><br>    
        <input type="submit" name="btnRegister" value="Register"><br>
    </form>

</div>