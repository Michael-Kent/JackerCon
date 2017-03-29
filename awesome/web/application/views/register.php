<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12">
				<h1 class="jc-head" data-required="true" > Register</h1>
				Please check your spam folder for any verification emails we send from no-reply@jackercon.com.
					<form action="<?=base_url('API/Account/Insert');?>">
						<div class="form-group row">
							<label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
							<div class="col-sm-10">
								<input type="text" data-required="true" name="username" class="form-control" id="inputUsername" placeholder="Username">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" data-required="true"  class="col-sm-2 col-form-label">Name</label>
							<div class="col-sm-10">
								<input type="text" data-required="true" name="firstname" class="form-control" id="inputName" placeholder="First Name">
								<input type="text" data-required="true" name="surname" class="form-control" placeholder="Surname">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="email" data-required="true" name="email" class="form-control" id="inputEmail" placeholder="Email">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input type="password" data-required="true" name="password" class="form-control" id="inputPassword" placeholder="Password">
								<input type="password" data-required="true" name="passwordconfirm" class="form-control" placeholder="Confirm Password">
							</div>
						</div>
						<div class="form-group row">
							<div class="offset-sm-8 col-sm-4">
								<button type="submit" class="btn btn-primary">Register Account</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-12">
				
		<form class="form-inline" action="<?=base_url('API/Email/Send/VerifyResend');?>">
			Type in your email and resend your authentication email, if you havent received it yet!<br>
			<input type="email" name="email" class="form-control" placeholder="Email">
			<button type="submit" class="btn btn-primary">Resend</button>
		</form>
				</div>
				<div class="col-sm-12">
				
		<form class="form-inline" action="<?=base_url('API/Email/Send/PasswordReset');?>">
			Type in your email to reset your password.<br>
			<input type="email" name="email" class="form-control" placeholder="Email">
			<button type="submit" class="btn btn-primary">Reset</button>
		</form>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
				<h4 class="jc-head"> Register using a google account.</h4>
				<p>
					Please enter a username and password, all other details will be pulled from your Google Account.
				</p>
				<form id="google-form-register" action="<?=base_url('API/Account/Google_Insert');?>">
					<div class="form-group row">
						<label for="inputUsername" class="col-sm-4 col-form-label">Username</label>
						<div class="col-sm-8">
							<input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-4 col-form-label">Password</label>
						<div class="col-sm-8">
							<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
							<input type="password" name="passwordconfirm" class="form-control" placeholder="Confirm Password">
						</div>
					</div>
				</form>
			<div class="g-signin2" data-onsuccess="googleOnRegister" style="width:100%;"></div>
			
		</div>
	</div>
</div>