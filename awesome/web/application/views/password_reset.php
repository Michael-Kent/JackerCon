<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12">
				<h1 class="jc-head"> Register</h1>
					<form action="<?=base_url('API/Account/Password_Reset');?>">
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input type="text" data-required="true" name="code" class="form-control" value="<?=$code?>" style="display:none;">
								<input type="password" data-required="true" name="password" class="form-control" id="inputPassword" placeholder="Password">
								<input type="password" data-required="true" name="passwordconfirm" class="form-control" placeholder="Confirm Password">
							</div>
						</div>
						<div class="form-group row">
							<div class="offset-sm-8 col-sm-4">
								<button type="submit" class="btn btn-primary">Reset Password</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>