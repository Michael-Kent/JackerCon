<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-sm-4">
					<img src="<?=$profile['imageLink'];?>" width="100%;"></img>
				</div>
				<div class="col-sm-8">
					<h1 class="jc-head"><?=$profile['username']?></h1>
				
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				<?=$profile['aboutMe'];?>
				
	<hr>
	<?foreach($profile['comments'] as $comment){?>
		<?=$comment['profile']['username'];?>|<?=$comment['timestamp'];?><br>
		<?=$comment['comment'];?>
		<hr>
	<?}?>
	<form action="<?=base_url('API/Account/AddComment/'.$profile['accountID']);?>">
	<label for="comment" class="col-sm-2 col-form-label">Comment:</label>
		<div class="col-sm-10">
			<textarea class="form-control" id="comment" name="comment" rows="2"></textarea>
		</div>
			<button type="submit" class="btn btn-primary" style="width:100%;">Submit Comment</button>
	</form>
				
				
				
				
				</div>
			</div>
		</div>
	</div>
</div>

	</div>