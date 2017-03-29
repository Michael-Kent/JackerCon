<!-- Begin Game List Layout -->
<div class="media">
	<div class="media-left media-top">
		<a href="#">
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
			<?if($account['id']==$game['hostId']){?>
				<a href="<?=base_url('Game/Manage/'.$game['id']);?>" class="btn btn-primary">Manage</a>
			<?}?>
		</div>
	</div>
</div>
<div>
	<div><!--class="media-body"-->
		<p>Description: <?=$game['description'];?></p> 
		<?if($isApprovedPlayer||$account['id']==$game['hostId']){?>
			<p>Player Info: <?=$game['playerInfo'];?></p> 
		<?}?>
		<?if($account['id']==$game['hostId']){?>
			<br>Players:<br>
		<ul>
			<?foreach($game['players'] as $player){?>
				<li><?=$player['username'];?>
				<?if($player['approved']=='0'){?>
					<form action="<?=base_url('API/Game/Approve/'.$game['id'].'/'.$player['ID']);?>">
						<button onClick="$(this).parent('form').submit();">Approve Player</button>
					</form>
				<?}?>
					<form action="<?=base_url('API/Game/Leave/'.$game['id'].'/'.$player['ID']);?>">
						<button onClick="$(this).parent('form').submit();">Remove Player</button>
					</form>
				
				</li>
			<?}?>
		</ul>
	<?}else if($isSpace){
		if($isPlayer){
			if($isApprovedPlayer){?>
			<form action="<?=base_url('API/Game/Leave/'.$game['id']);?>">
				<button onClick="$(this).parent('form').submit();">Leave Game</button>
			</form>
			<?}else{?>
				You are awaiting approval by the game host.<br>
			<form action="<?=base_url('API/Game/Leave/'.$game['id']);?>">
				<button onClick="$(this).parent('form').submit();">Cancel Join Request</button>
			</form>
			<?}
		}else{?>
			<form action="<?=base_url('API/Game/Join/'.$game['id']);?>">
				<button onClick="$(this).parent('form').submit();">Join Game</button>
			</form>
		<?}
	}else{?>
		<br>this game is full<br>
		<?if($isPlayer){?>
			<form action="<?=base_url('API/Game/Leave/'.$game['id']);?>">
				<button onClick="$(this).parent('form').submit();">Leave Game</button>
			</form>
		<?}
	}?>
	</div>
	<hr>
	<?foreach($game['comments'] as $comment){
		$this->load->view('shared/comment',array('comment'=>$comment));
	}?>
	<form action="<?=base_url('API/Game/AddComment/'.$game['id']);?>">
	<label for="comment" class="col-sm-2 col-form-label">Comment:</label>
		<div class="col-sm-10">
			<textarea class="form-control" id="comment" name="comment" rows="2"></textarea>
		</div>
			<button type="submit" class="btn btn-primary" style="width:100%;">Submit Comment</button>
	</form>
</div>