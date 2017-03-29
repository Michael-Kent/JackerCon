<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="jc-head">Account</h1>
					
					<h4 class="jc-head"><?=$account['firstName'];?> <?=$account['lastName'];?> (<?=$account['username'];?>)</h4>
					
					<p>This is your account page, you can manage your account details here. Your name, email and settings on this page are private but you can set up your <a href="<?=base_url('Profile');?>">profile page</a> to display your public details.</p>
					
					<?if(!$account['verify']){?>
					<p>The email address <?=$account['email'];?> has not been verified yet.</p>
					<form class="form-inline" action="<?=base_url('API/Email/Send/VerifyResend');?>">
						Click here to resend your authentication email, if you havent received it yet!<br>
						<input type="email" name="email" class="form-control" value="<?=$account['email'];?>" style="display:none;">
						<button type="submit" class="btn btn-primary">Resend</button>
					</form>
					<?}else{?>
					
					<? if($account['emailSub']){?>
					<form action="<?=base_url('API/Email/unSubscribe');?>">
						<div class="form-group row" style="display:none;">
							<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="email" data-required="true" name="email" class="form-control" id="inputEmail" value="<?=$account['email'];?>">
							</div>
						</div>
						<div class="form-group row">
							<div class="offset-sm-8 col-sm-4">
								<button type="submit" class="btn btn-primary">UnSubscribe from emails</button>
							</div>
						</div>
					</form>
					<?}else{?>
					<form action="<?=base_url('API/Email/Subscribe');?>">
						<div class="form-group row">
							<div class="offset-sm-8 col-sm-4">
								<button type="submit" class="btn btn-primary">Subscribe to emails</button>
							</div>
						</div>
					</form>
					<?}?>
						
				<form action="<?=base_url('API/Account/Update');?>" data-required="false" >
					<h4 class="jc-head"><?=$account['firstName'];?> <?=$account['lastName'];?> (<?=$account['username'];?>)</h4>
						<!--<div class="form-group row">
							<label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
							<div class="col-sm-10">
								<input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username" value="<?=$account['username'];?>">
							</div>
						</div>-->
						<div class="form-group row">
							<label for="inputName" class="col-sm-2 col-form-label">Name</label>
							<div class="col-sm-10">
								<input type="text" name="firstname" class="form-control" id="inputName" placeholder="First Name" value="<?=$account['firstName'];?>">
								<input type="text" name="surname" class="form-control" placeholder="Surname" value="<?=$account['lastName'];?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="image" class="col-sm-2 col-form-label">Image</label>
							<div class="col-sm-10">
								<input type="text" name="imageUrl" class="form-control" id="image" placeholder="Image URL" value="<?=$profile['imageLink'];?>">
								<img id="image-display" href='#' height='100px'></img>
							</div>
						</div>
					  <div class="form-group row">
						<label for="aboutMe" class="col-sm-2 col-form-label">aboutMe</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="aboutMe" name="aboutMe" rows="4" ><?=$profile['aboutMe'];?></textarea>
						</div>
					  </div>
					<div class="form-group row">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary" style="width:100%;">Update Account Information</button>
						</div>
					</div>
				</form>
	<br>
					<!--
	account created on <?=$account['date_created'];?><br>
	last logged in on <?=$account['date_logged_in'];?><br>
					<form class="form-inline" action="<?=base_url('API/Email/Send/PasswordReset');?>">
						Click here to receive a password reset email.<br>
						<input type="email" name="email" class="form-control" value="<?=$account['email'];?>"  style="display:none;">
						<button type="submit" class="btn btn-primary">Reset</button>
					</form>
					-->
					
					<?}?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
		<?if(!$account['google_linked']){?>
			<h4 class="jc-head"> Sign In using a google account.</h4>
			<p>
				A JackerCon account that uses the same email address as registered on your Google Account will be accepted and linked. You can otherwise link your account from your account page once signed in.
			</p>
			<div class="g-signin2" data-onsuccess="googleOnSignIn"></div>
			<form id="google-form" action="<?=base_url('API/Account/Google');?>">
			</form>
			<p>
				If you created your account through your Google Account then your account is already linked.
			</p>
		<?}else{?>
			you are connected to a google account
		<?}?>
		</div>
	</div>
</div>

<div class="page">
    <div class="inner white-box">
<h2>What user data can be displayed</h2><br>
<?//account is an associative array so you would have to provide a referance to the specific information you require.?>
	<b>ID:</b>	<?=$account['id'];?><br>
	<b>Username:</b>	<?=$account['username'];?><br>
	<b>First Name:</b>	<?=$account['firstName'];?><br>
	<b>Last Name:</b> 	<?=$account['lastName'];?><br>
	<b>Email:</b>	<?=$account['email'];?><br>
	<b>Verify:</b>	<?=$account['verify'];?> (has the email for this account clicked the verification link)<br>
	<b>Subscribed:</b>	<?=$account['emailSub'];?> (are they subscribed to receive emails)<br>
	<b>Been a user since:</b>	<?=$account['date_created'];?><br>
	<b>Last Logged in:</b>	<?=$account['date_logged_in'];?><br>
	
	
	<form id="form-deAuth" >
	<h2>log out</h2>
		<span id="response"></span>
		<button type="submit">Log out</button>
	</form>
	
		<?//$this->view('shared/account_update_form');?>
	
	</div>
	</div>