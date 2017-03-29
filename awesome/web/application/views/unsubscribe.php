<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12">
				<h1 class="jc-head"> unsubscribe</h1>
					<form action="<?=base_url('API/Email/unSubscribe');?>">
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="email" data-required="true" name="email" class="form-control" id="inputEmail" value="<?=$unsubscribe_email;?>">
							</div>
						</div>
						<div class="form-group row">
							<div class="offset-sm-8 col-sm-4">
								<button type="submit" class="btn btn-primary">UnSubscribe</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
				