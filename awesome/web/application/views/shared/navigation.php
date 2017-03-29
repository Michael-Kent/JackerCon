<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="<?=base_url();?>"><img src="<?=base_url("resources/images/jacercon-logo.png");?>" class="brand-img" alt="JackerCon"/>Beta</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?=base_url("");?>">Home</a></li>
        <li><a href="<?=base_url("About");?>">About</a></li>
        <?if($isAdmin){?>
		<li><a href="<?=base_url("Resources");?>">Resources</a></li>
        <?}?>
		<li><a href="<?=base_url("Contact");?>">Contact</a></li>
        
		<li><p class="navbar-text visible-md visible-lg">|</p><hr class="hidden-md hidden-lg"></li>
		
        <?if($loggedIn){?>
		
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				<i class="fa fa-user-circle-o" aria-hidden="true"></i> <?=$account['username']?>
			</a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?=base_url("Account");?>">Account Details</a></li>
            <li><a href="<?=base_url("Profile");?>">Profile</a></li>
            <li><a href="<?=base_url("Game/Search/".$account['username']);?>">My Games</a></li>
            <li class="divider"></li>
			<form id="logout-form" action="<?=base_url('API/Account/Logout');?>">
			</form>
			<li><a onClick="$('#logout-form').submit();">Log out</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Games<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?=base_url("Game/Create");?>">Host A Game</a></li>
            <li><a href="<?=base_url("Game/Search");?>">Find A Game</a></li>
            <li><a href="<?=base_url("Game/Search/".$account['username']);?>">Manage My Games</a></li>
            <!--<li class="divider"></li>-->
          </ul>
        </li>

		<?}else{?>
		
        <li><p class="navbar-text"><a href="<?=base_url("Account/Login");?>">Login</a> or <a href="<?=base_url("Account/Register");?>">Register</a></p></li>
		<?}?>
		
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>