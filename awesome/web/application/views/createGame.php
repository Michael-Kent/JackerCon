<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12">
				<h1 class="jc-head"> Host Game</h1>
				<form action="<?=base_url('API/Game/Insert');?>">
						<div class="form-group row">
							<label for="title" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" id="title" placeholder="Title">
							</div>
						</div>	
						<div class="form-group row">
							<label for="system" class="col-sm-2 col-form-label">System</label>
							<div class="col-sm-10">
								<input type="text" name="system" class="form-control" id="system" placeholder="Game System">
							</div>
						</div>	
						<div class="form-group row">
							<label for="image" class="col-sm-2 col-form-label">Image</label>
							<div class="col-sm-10">
								<input type="text" name="imageUrl" class="form-control" id="image" placeholder="Image URL">
								<img id="image-display" href='#' height='100px'></img>
							</div>
						</div>	
					  <div class="form-group row">
						<label for="description" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="description" name="description" rows="4"></textarea>
						</div>
					  </div>
					  <div class="form-group row">
						<label for="playerInfo" class="col-sm-2 col-form-label">playerInfo <br>(This is only visible to player in your game, you can place character gen info, or how to join your session)</label>
						
						<div class="col-sm-10">
							<textarea class="form-control" id="playerInfo" name="playerInfo" rows="4"></textarea>
						</div>
					  </div>
						<div class="form-group row">
						  <label for="datetime" class="col-sm-2 col-form-label">Date and time</label>
						  <div class="col-sm-10">
							<input class="form-control" type="datetime-local" value="2017-03-11T00:00:00" id="datetime" name="timestampStart" min="2017-03-11T00:00:00" max="2017-03-25T23:59:59">
						  
							<select class="form-control" name="game_length">
								<option value="<?=(1*3600000);?>">1 hour</option>
								<option value="<?=(2*3600000);?>">2 hours</option>
								<option value="<?=(3*3600000);?>">3 hours</option>
								<option value="<?=(4*3600000);?>">4 hours</option>
								<option value="<?=(5*3600000);?>">5 hours</option>
								<option value="<?=(6*3600000);?>">6 hours</option>
							</select>
							</div>
						</div>
					  <div class="form-group row">
						<label for="players" class="col-sm-2 col-form-label"> Max Players</label>
						<div class="col-sm-10">
							<select class="form-control" id="players" name="maxPlayers">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
						</div>
					  </div>
				
		  <div class="form-check">
			<label class="form-check-label">
			  <input type="checkbox" class="form-check-input" name ="live" value="off">
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
		  </fieldset>
				<div class="form-group row">
					<div class="col-sm-12">
						<button type="submit" class="btn btn-primary" style="width:100%;">Publish Game Information</button>
					</div>
				</div>
				</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>