<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="jc-banner">
      	<h3 class="text-center">JACKERCON 13 BEGINS IN...</h3>
      	<h1 class="text-center">
			<strong><span class="count">day,June 21 2017</span></strong> DAYS, 
			<strong><span class="count">hour,June 21 2017</span></strong> HOURS, 
			<strong><span class="count">minute,June 21 2017</span></strong> MINUTES
		</h1>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8">
    	<div class="row">
    	  	<div class="col-lg-12">
				<h4 class="jc-head">
					<img src="<?=base_url("resources/images/jackercon12.png");?>" width="300px" alt="JackerCon"/>
					<br>
					EVERYBODY GETS TO BE A NINJA!
				</h4>
				<p>Jackercon 12 begins on March 11th 2017, through to the 25th. The theme is "EVERYBODY GETS TO BE A NINJA!" Host games which follow this if you like. Jackercon themes arent compulsory but provide a focus for the Con.</p>
				<p>The 12th Jackecon is exciting for many reasons, it celebrates the launching of this site. Allowing games to be hosted in a more organised manner compared to the now legacy forum threads. This is also the first JackerCon since the depreciation of google hangouts.</p>
     		</div>
      	</div>
    	<div class="row">
    	  	<div class="col-lg-12">
				<h1 class="jc-head">Welcome to <img src="<?=base_url("resources/images/jacercon-logo-bl.png");?>" class="brand-img" alt="JackerCon"/></h1>
				
				<p>Jackercon is a community of gamers looking for pen and paper roleplaying games run primarily through Google Hangout with a side of roll20. It was the brain child of Curt Jackson, inspired by Happy Jack's RPG Podcast. If you've found your way here, welcome! We run online week long conventions roughly 3-4 times a year but we strongly encourage the community to post one shot or episodic games all year round. Please understand that if you sign up for a game, it is as though you have signed up for one with a face to face group, there are people on the other end expecting your attendance. If you can't make it for any reason, notify your GM and/or group. Join us, Check out some resource links below, and let's have some fun!</p>
     		</div>
      	</div>
      	<div class="row">
			<div class="col-lg-12">
     			<h1 class="jc-head">Your Upcoming Games</h1> 
     			
     			<!-- Begin Game List Layout -->
     			<?
				if($games!=array()){
					foreach($games as $game){
						$this->load->view('shared/gameOverview',array('game'=>$game));
					}
				}else{?>
					<p>Oh dear...<br>It seems you either arent logged in or have no games you are playing or hosting.</p>
					
					
				<?}?>
     			<!-- End Game List Layout -->
     			
			</div>
      	</div>
    </div>
    <div class="col-md-4">
    	<div class="row">
    		<div class="col-lg-12">
				<aside>
					<?$this->load->view('shared/hostGame',array('loggedIn'=>$loggedIn));?>
					<hr>
					<?$this->load->view('shared/socialLinks');?>
				</aside>
			</div>
   		</div>
    </div>
  </div>