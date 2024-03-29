<?php echo $this->extend('template/admin/main') ?>
	<?php echo $this->section('content') ?>
	<?php echo $this->include('common/message') ?>
		<div class="card mb-4">
			<div class="card-body">

		<form action="<?php echo base_url(route_to('update-sms', $sms->id)) ?>" id="smsedit" method="post" class="row g-3" accept-charset="utf-8" enctype="multipart/form-data">
				<?php echo $this->include('common/securityupdate') ?>
				

		<div class="row justify-content-center">
					
						<div class="col-md-6">

							<div class="col-12 mt-3">
								<label for="url" class=""><?php echo lang("Localize.url") ?></label>	
								<input type="text" id="url" name ="url" value="<?php echo esc(old('url')) ?? $sms->url  ?>" class="form-control"  placeholder="<?php echo lang("Localize.url") ?>">
							</div>

							<div class="col-12 mt-3">
							<label for="email" class=""><?php echo lang("Localize.email") ?></label>	
								<input type="email" id="email" name ="email" value="<?php echo esc(old('email')) ?? $sms->email  ?>" class="form-control"  placeholder="<?php echo lang("Localize.email") ?> <?php echo lang("Localize.host") ?>">
							</div>


							<div class="col-12 mt-3">
							<label for="sender_id" class=""><?php echo lang("Localize.sender_id") ?></label>	
								<input type="text" id="sender_id" name ="sender_id" value="<?php echo esc(old('sender_id')) ?? $sms->sender_id ?>" class="form-control"  placeholder="<?php echo lang("Localize.sender_id") ?> <?php echo lang("Localize.sender_id") ?>">
							</div>

							<div class="col-12 mt-3">
							<label for="api_key" class=""><?php echo lang("Localize.api_key") ?></label>	
								<input type="text" id="api_key" name ="api_key" value="<?php echo esc(old('api_key')) ?? $sms->api_key  ?>" class="form-control"  placeholder="<?php echo lang("Localize.api_key") ?> <?php echo lang("Localize.api_key") ?>">
							</div>
							
							<div class="text-danger">
                                <?php if (isset($validation)): ?>
                                  <?=$validation->listErrors();?>
                                <?php endif?>
                              </div>

							
							  <br>
                            <div class="col-12 text-center">
                              <button type="submit" class="btn btn-success"><?php echo lang("Localize.submit") ?></button>
                            </div>
						</div>

				

					

				</div>




		</form>
	</div>
</div>
<?php echo $this->endSection() ?>