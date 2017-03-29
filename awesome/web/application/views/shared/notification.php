<div class="container" id="notification-root" <?if ($notification==null){?> style="display:none;" <?}?>>
  <div class="row">
    <div class="col-lg-12">
      	<h4 class="text-center"> <span id="notification"><?=$notification?></span>
			<a onClick="$('#notification-root').hide();"><button>Hide</button></a>
		</h4>
    </div>
  </div>
</div>