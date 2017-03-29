<div class="container">
	<div class="row">
		<div class="col-sm-4">
		<h1 class="jc-head"> Sign In</h1>
			<form action="<?=base_url('API/Account/Auth');?>">
				<div class="form-group row">
					<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-10">
						<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<button type="submit" class="btn btn-primary" style="width:100%;">Sign in</button>
					</div>
				</div>
			</form>
			
			<a href="<?=base_url('Account/Register');?>">Click here to register an account.</a>
		</div>
		<div class="col-sm-4">
			<h4 class="jc-head"> Sign In using a google account.</h4>
			<p>
				If your JackerCon account is already linked to your google account you can sign in here.
			</p>
			<div class="g-signin2" data-onsuccess="googleOnSignIn"></div>
			<form id="google-form" action="<?=base_url('API/Account/Google');?>">
			</form>
			<p>
				A JackerCon account that uses the same email address as registered on your Google Account will be accepted and linked. You can otherwise link your account from your account page once signed in.
			</p>
			<p>
				If you created your account through your Google Account then your account is already linked.
			</p>
		</div>
	</div>
</div>