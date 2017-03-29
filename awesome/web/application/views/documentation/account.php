<div class="container">
	
	<div class="row">
	
	<h4>Here is a typical response JSON from the Logout function</h4>
	<pre>
	{
		"URI":"http://www.online-projects.co.uk/JackerCon/home/API/Account/Logout",
		"success":true,
		"redirectPage":"http://www.online-projects.co.uk/JackerCon/",
		"messages":{
			"#notification":"you are successfully logged out."
		}
	}
	</pre>
	<h4>Here are some external links for tools that are being used</h4>
	<a href="https://developers.google.com/identity/sign-in/web/sign-in">Google Sign-in </a>
	<br>
	<a href="https://developers.google.com/identity/sign-in/web/backend-auth">Getting the GoogleID</a>
	<br>
	</div>
	<div class="row">
	
		<div class="col-md-2">
			<h3>URL</h3>
		</div>
		<div class="col-md-2">
			<h3>Post Data</h3>
		</div>
		<div class="col-md-8">
			<h3>Information</h3>
		</div>
	</div>
	<hr>
	<div class="row">
	
		<div class="col-md-2">
			API/Account/Auth
		</div>
		<div class="col-md-2">
			<ul>
				<li>password</li>
				<li>email</li>
			</ul>
		</div>
		<div class="col-md-8">
			This api call will sign in the user to the system, saving an authentication code as a session variable. This will authenticate future calls without having to resend email/password untill either user logs out or the authentication code is timed out.
			<br><br>
			Expected responces are:
			
			<ul>
				<li>You are successfully logged in.</li>
				<li>The email address for this account hasnt been verified yet.</li>
				<li>No account was found with those credentials</li>
			</ul>
			<br>
			A successfull log in will provide a redirect url, to the home page.
		</div>
	</div>
	<hr>
	<div class="row">
	
		<div class="col-md-2">
			API/Account/Google
		</div>
		<div class="col-md-2">
			<ul>
				<li>googleID</li>
			</ul>
		</div>
		<div class="col-md-8">
			This API call signs in the user to a Jackercon account that has been linked to their google account.
			<br>
			If no Jackercon account has been linked, but an account exsists with the same email address they will be logged in and the accounts will be linked.
			<br><br>
			Expected responces are:
			
			<ul>
				<li>You are successfully logged in.</li>
				<li>No JackerCon account has been found for your google account.</li>
				<li>No Google account has been found.</li>
			</ul>
			<br>
			A successfull log in will provide a redirect url, to the home page.
		</div>
	</div>
	<hr>
	<div class="row">
	
		<div class="col-md-2">
			API/Account/Logout
		</div>
		<div class="col-md-2">
			no post data is required
		
		</div>
		<div class="col-md-8">
			This will delete the Authentication Code that is stored for the currently logged in user. That user will then be required to log in again.
			<br><br>
			Expected responces are:
			<ul>
				<li>Log out unsuccesful, please check if you are logged in and try again.</li>
				<li>you are successfully logged out.</li>
			</ul>
			<br>
			A successfull log out will provide a redirect url, to the home page.
		</div>
	</div>
	<hr>
	<div class="row">
	
		<div class="col-md-2">
			API/Account/Insert
			
		</div>
		<div class="col-md-2">
			<ul>
				<li>password</li>
				<li>passwordconfirm</li>
				<li>email</li>
				<li>username</li>
				<li>firstname</li>
				<li>surname</li>
			</ul>
		</div>
		<div class="col-md-8">
			A new account will be created with the provided information.
			<br>
			The user will have to verify their email address, by clicking a link they are sent, before they are able to log in.
			<br><br>
			Expected responces are:
			<ul>
				<li>There was an issue sending your verification email.</li>
				<li>Your account has been created, you have been sent an email, you will need to click the link to verify your email.</li>
				<li>Account creation failed, please ensure you have entered all required details.</li>
			</ul>
			<br>
			A successfull Created account will provide a redirect url, to the home page.
		</div>
	</div>
	<hr>
	<div class="row">
	
		<div class="col-md-2">
			API/Account/Google_insert
		</div>
		<div class="col-md-2">
			<ul>
				<li>googleID</li>
				<li>password*</li>
				<li>passwordconfirm*</li>
				<li>email*</li>
				<li>username*</li>
				<li>firstname*</li>
				<li>surname*</li>
			</ul>
			* Optional Parameters
		</div>
		<div class="col-md-8">
			Google Insert, will create an account for a user. Utilising optional parameters when provided.
			<br>
			With no details provided Google account details will be used. With a random username.
			<br>
			Google provides information on if the email has already been verified, when true users will be able to sign in instantly.
			<br><br>
			Expected responces are:
			<ul>
				<li>You are successfully logged in.</li>
				<li>Your account has been created, but there was an issue sending your verification email.</li>
				<li>Your account has been created, you have been sent an email, you will need to click the link to verify your email.</li>
				<li>There was an issue creating an account.</li>
			</ul>
			<br>
			A successfull Created account will provide a redirect url, to the home page.
		</div>
	</div>
	<hr>
	<div class="row">
	
		<div class="col-md-2">
			API/Account/Update
		</div>
		<div class="col-md-2">
			<ul>
				<li>password</li>
				<li>email</li>
				<li>username</li>
				<li>firstname</li>
				<li>surname</li>
			</ul>
		</div>
		<div class="col-md-8">
		
		</div>
	</div>
</div>