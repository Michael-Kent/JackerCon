<div id="message">
	Hi <?=$acc->getFirstName();?> <?=$acc->getLastName();?>,
	<br>
	Welcome to your new account at <a href="<?=base_url();?>">JackerCon</a>.
	<br>
	Here is the <a href="<?=base_url("/email_link/")?>/?code=<?=$emailLink->getCode();?>">email verification link</a> you requested.
	<br>
	If you have any questions please contact me at web@JackerCon.com
	</div>