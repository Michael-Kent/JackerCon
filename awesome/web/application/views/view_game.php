<div class="container">
  <div class="row">
    <div class="col-md-8">
    	  <div class="row">
    	  	<div class="col-lg-12">
	<? if(!empty($game)){?>
	
				<h1 class="jc-head"><?=$game['name']?></h1>
				<?
	
		
		$isPlayer=false;
		$isApprovedPlayer=false;
		foreach($game['players'] as $player){
			if($player['username']==$account['username']){
				$isPlayer=true;
				$isApprovedPlayer=$player['approved']=='1';
			}
		}
		
		$this->load->view('shared/gameView',
			array(
			'game'=>$game,
			'loggedIn'=>$loggedIn,
			'isPlayer'=>$isPlayer,
			'isApprovedPlayer'=>$isApprovedPlayer,
			'isSpace'=>count($game['players'])<$game['maxPlayers']
			));
			
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
