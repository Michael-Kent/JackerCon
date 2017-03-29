

<div class="page">
    <div class="inner white-box">
<h2>What account data can be edited</h2><br>
	<div>
	<? if($loggedIn){?>
	<pre><?=print_r($profile);?></pre>
	<form>
			<input type="text" id="register-username" name="username" placeholder="<?=$account['username']?>"/><br>
			<input type="text" id="register-name" name="firstname" placeholder="<?=$account['firstName']?>"/>
			<input type="text" id="register-surname" name="surname" placeholder="<?=$account['lastName']?>"/><br>
			<input type="text" id="register-email" name="email" placeholder="<?=$account['email']?>"/>
	</form>
	</div>
	<?}else{?>
		ERROR: You need to be logged in to edit your account details.
		
	<?}?>
	</div>
	</div>