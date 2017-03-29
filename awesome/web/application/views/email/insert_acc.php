<div id="message">
	Hi <?=$acc->getFirstName();?> <?=$acc->getLastName();?>,
	<br>
	Welcome to your new account at <a href="<?=base_url();?>">JackerCon</a> 
	<br>
	Here is the <a href="<?=base_url("/email_link/")?>/?code=<?=$emailLink->getCode();?>">verification link</a> you requested.
	</div>