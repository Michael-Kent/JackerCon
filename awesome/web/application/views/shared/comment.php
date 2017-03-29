<div class="media">
  <div class="media-left">
    <img src="<?=$comment['profile']['imageLink'];?>" class="media-object" style="width:60px">
  </div>
  <div class="media-body">
    <h4 class="media-heading"> <a href="<?=base_url('Profile/Search/'.$comment['profile']['username']);?>"><?=$comment['profile']['username'];?></a></h4>
    <p><?=$comment['comment'];?></p>
	<?=$comment['timestamp'];?> UTC
	</div>
</div>
<hr>