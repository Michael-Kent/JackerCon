<div class="container">
  <div class="row">
    <div class="col-md-8">
    	<div class="row">
			<div class="col-lg-12">
     			<h1 class="jc-head">Upcoming Games</h1> 
     			
	<?foreach($games as $game){
		$this->load->view('shared/gameOverview',array('game'=>$game));
	}?>
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