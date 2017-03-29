 <body>
	<div class="nav-bar">
        <a href="<?=base_url();?>"><img alt="JackerCon" id="logo" src="<?=base_url('resources/images/jackercon12.png')?>" style='max-width:200px;'/></a>

        <img id="nav-icon" src="<?=base_url('resources/images/nav-icon.png');?>" width="50px;" />
        <ul id="nav">
        	<div id="close"><p>X</p></div>
        	<li><a href="<?=base_url("");?>">Home</a></li>
            <li><a href="<?=base_url("About");?>">About</a></li>
            <li><a href="<?=base_url("Resources");?>">Resources</a></li>
            <li><a href="<?=base_url("Contact");?>">Contact</a></li>
            <?
	 if($loggedIn){
		 ?>
		<li>
			<a onclick="displaySubList(this);">My Account</a>
            <ul>
                <li><a href="<?=base_url("Account");?>">Account Details</a></li>
            	<li><a href="<?=base_url("Profile");?>">Profile</a></li>
            	<li><a href="<?=base_url("Game/Search/".$account['id']);?>">My Games</a></li>
            </ul>
		</li>
		<li>
			<a onclick="displaySubList(this);">Games</a>
            <ul>
				<li><a href="<?=base_url("Game/Create");?>">Host A Game</a></li>
				<li><a href="<?=base_url("Game/Search");?>">Find A Game</a></li>
            	<li><a href="<?=base_url("Game/Search/".$account['id']);?>">Manage my Games</a></li>
            </ul>
		</li>
	 <?
	 }else{
	 ?>
	 <li id="seperate">|</li>
	 <li id="cta"><a href="<?=base_url("Account/Login");?>">Log-in</a></li>
	 <li id="text">or</li>
	 <li id="cta"><a href="<?=base_url("Account/Register");?>">Register</a></li>
	 <?}
	 
	 if($isAdmin){
		 ?>
	
	 <?
	 }
	 if($loggedIn){?>
		 <br>
		 <br>
		 <span style="float:right;">
			<form action="<?=base_url('API/Account/Logout');?>">
			Logged in as: <?=$account['email']?>
				<a onClick="$(this).parent('form').submit();"><button>Log out</button></a>
			</form>
		 </span>
	 <?}
		 ?>
	 </ul>
        <div class="clear"></div>
   </div>
<div class="nav-bar-space"></div>