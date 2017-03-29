<!-- Begin Game List Layout -->
     			<div class="media">
					<h4 class="media-heading"><a href="<?=base_url('Game/View/'.$game['id']);?>"><?=$game['name']?></a></h4>
				  <div class="media-left media-top">
					<a href="<?=base_url('Game/View/'.$game['id']);?>">
						<?if($game['imageUrl']==''){?>
							<img class="media-object" height="100px" width="100px" src="<?=base_url('resources/images/D20.png');?>" alt="Game Img">
						<?}else{?>
							<img class="media-object" height="100px" width="100px" src="<?=$game['imageUrl'];?>" alt="Game Img">
						<?}?>
					</a>
				  </div>
				  <div class="media-left media-top jc-game-details">
					<div>
						<span class='timestamp start'><?=date($game['timestampStart']);?></span> - 
						<span class='timestamp finish'><?=date($game['timestampFinish']);?></span>
						<br>
						Players <?=count($game['players']);?>/<?=$game['maxPlayers'];?><br>
						System: <?=$game['system']?><br>
						GM: <a href="<?=base_url('Profile/Search/'.$game['hostName']);?>"><?=$game['hostName'];?></a>
					</div>
				</div>
				<div class="media-body">
						<?if($account['id']==$game['hostId']){?>
							<a href="<?=base_url('Game/Manage/'.$game['id']);?>" class="btn btn-primary">Manage</a>
						<?}else{?>
						<a href="<?=base_url('Game/View/'.$game['id']);?>" class="btn btn-primary">View Game</a>
						<?}?>
					</div>
				</div>
				  <div>
					<p>Description: <?=substr($game['description'],0,200);?></p> 
					<a href="<?=base_url('Game/View/'.$game['id']);?>">Read More >></a>
				  </div>
				  <hr><br>
				  
     			<!-- End Game List Layout -->