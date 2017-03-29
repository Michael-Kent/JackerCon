<pre><?//=print_r($game)?></pre>

<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12">
				<h1 class="jc-head"> Manage Game</h1>
				<? if(!empty($game)){?>
					<form action="<?=base_url('API/Game/Update/'.$game['id']);?>">
						<div class="form-group row">
							<label for="title" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm-10">
								<input type="text" name="title" value="<?=$game['name']?>" class="form-control" id="title" placeholder="Title">
							</div>
						</div>	
						<div class="form-group row">
							<label for="system" class="col-sm-2 col-form-label">System</label>
							<div class="col-sm-10">
								<input type="text" name="system" class="form-control" id="system" placeholder="Game System" value="<?=$game['system']?>">
							</div>
						</div>	
						<div class="form-group row">
							<label for="image" class="col-sm-2 col-form-label">Image</label>
							<div class="col-sm-10">
								<input type="text" name="imageUrl" class="form-control" id="image" placeholder="Image URL" value="<?=$game['imageUrl']?>">
								<img id="image-display" href='#' height='100px'></img>
							</div>
						</div>	
					  <div class="form-group row">
						<label for="description" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="description" name="description" rows="4"><?=$game['description'];?></textarea>
						</div>
					  </div>
					  <div class="form-group row">
						<label for="playerInfo" class="col-sm-2 col-form-label">playerInfo</label>
						
						<div class="col-sm-10">
							<textarea class="form-control" id="playerInfo" name="playerInfo" rows="4"><?=$game['playerInfo'];?></textarea>
						</div>
					  </div>
					  (This is only visible to player in your game, you can place character gen info, or how to join your session)
						<div class="form-group row">
						  <label for="datetime" class="col-sm-2 col-form-label">Date and time</label>
						  <div class="col-sm-10">
							<!-- <?=$game['timestampStart']?> -->
							<input class="form-control" type="datetime-local" value="<?=date('Y-m-d\TH\:i\:\0\0',substr($game['timestampStart'], 0, -3));?>" id="datetime" name="timestampStart" value="2017-03-11T00:00:00" min="2017-03-11T00:00:00" max="2017-03-25T23:59:59">
						  
							<select class="form-control" name="game_length">
							<?
							$game_length=($game['timestampFinish']-$game['timestampStart'])/3600000;
							//echo($game_length);
							?>
								<option <?if($game_length==1){?>selected="true" <?}?>value="<?=(1*3600000);?>">1 hour</option>
								<option <?if($game_length==2){?>selected="true" <?}?>value="<?=(2*3600000);?>">2 hours</option>
								<option <?if($game_length==3){?>selected="true" <?}?>value="<?=(3*3600000);?>">3 hours</option>
								<option <?if($game_length==4){?>selected="true" <?}?>value="<?=(4*3600000);?>">4 hours</option>
								<option <?if($game_length==5){?>selected="true" <?}?>value="<?=(5*3600000);?>">5 hours</option>
								<option <?if($game_length==6){?>selected="true" <?}?>value="<?=(6*3600000);?>">6 hours</option>
							</select>
							</div>
						</div>
					  <div class="form-group row">
						<label for="players" class="col-sm-2 col-form-label"> Max Players</label>
						<div class="col-sm-10">
							<select class="form-control" id="players" name="maxPlayers">
								<option <?if($game['maxPlayers']==1){?>selected="true" <?}?>value="1">1</option>
								<option <?if($game['maxPlayers']==2){?>selected="true" <?}?>value="2">2</option>
								<option <?if($game['maxPlayers']==3){?>selected="true" <?}?>value="3">3</option>
								<option <?if($game['maxPlayers']==4){?>selected="true" <?}?>value="4">4</option>
								<option <?if($game['maxPlayers']==5){?>selected="true" <?}?>value="5">5</option>
								<option <?if($game['maxPlayers']==6){?>selected="true" <?}?>value="6">6</option>
								<option <?if($game['maxPlayers']==7){?>selected="true" <?}?>value="7">7</option>
								<option <?if($game['maxPlayers']==8){?>selected="true" <?}?>value="8">8</option>
							</select>
						</div>
					  </div>
				<!--
		  <div class="form-check">
			<label class="form-check-label">
			  <input type="checkbox" class="form-check-input" name ="live" value="<?if($game['isLive']){?>on<?}else{?>off<?}?>">
			  This game will be live streamed.
			</label>
		  </div>
		  <fieldset class="form-group" name="hostingPlatform">
			<div class="form-check">
			  <label class="form-check-label">
				<input type="radio" class="form-check-input" name="hostingPlatform" id="optionsRadios1" value="Roll20">
				Roll20
			  </label>
			</div>
			<div class="form-check">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="hostingPlatform" id="optionsRadios2" value="Google Hangouts">
				Google Hangouts
			  </label>
			</div>
			<div class="form-check">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="hostingPlatform" id="optionsRadios2" value="Other" checked>
				Other
			  </label>
			</div>
		  </fieldset>-->
				<div class="form-group row">
					<div class="col-sm-12">
						<button type="submit" class="btn btn-primary" style="width:100%;">Update Game Information</button>
					</div>
				</div>
				</form>
				<?}?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>