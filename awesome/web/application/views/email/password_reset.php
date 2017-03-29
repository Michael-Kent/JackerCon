<div id="message">
	Hi <?=$acc->getFirstName();?> <?=$acc->getLastName();?>,
	<br>
	You have requested to resset your <a href="<?=base_url();?>">JackerCon</a> account's password.
	<br>
	Here is a link that will allow you to <a href="<?=base_url("/email_link/password/")?>/?code=<?=$emailLink->getCode();?>">reset your password</a>.
	<br>
	If you have any questions please contact me at web@JackerCon.com
	</div>