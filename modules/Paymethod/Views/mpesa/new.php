<?php echo $this->extend('template/admin/main') ?>

<?php echo $this->section('content') ?>

<div class="card mb-4">
	<div class="card-body">

		<form action="<?php echo base_url(route_to('create-mpesa')) ?>" id="mpesaform" method="post" class="row g-3" accept-charset="utf-8" enctype="multipart/form-data">
			<?php echo $this->include('common/security') ?>


			<div class="row">
				<div class="col-4"></div>

				<div class="col-4">

					<div class="row">

						<div class="col-12 mt-3">
							<label for="live_consumer_key" class=""><?php echo lang("Localize.live_consumer_key") ?></label>
							<input type="text" id="live_consumer_key" name="live_consumer_key" class="form-control" placeholder="<?php echo lang("Localize.live_consumer_key") ?>">
						</div>


						<div class="col-12 mt-3">
							<label for="test_consumer_key" class=""><?php echo lang("Localize.test_consumer_key") ?></label>
							<input type="text" id="test_consumer_key" name="test_consumer_key" class="form-control" placeholder="<?php echo lang("Localize.test_consumer_key") ?>">
						</div>

						<div class="col-12 mt-3">
							<label for="live_consumer_secret" class=""><?php echo lang("Localize.live_consumer_secret") ?></label>
							<input type="text" id="live_consumer_secret" name="live_consumer_secret" class="form-control" placeholder="<?php echo lang("Localize.live_consumer_secret") ?>">
						</div>


						<div class="col-12 mt-3">
							<label for="test_consumer_secret" class=""><?php echo lang("Localize.test_consumer_secret") ?></label>
							<input type="text" id="test_consumer_secret" name="test_consumer_secret" class="form-control" placeholder="<?php echo lang("Localize.test_consumer_secret") ?>">
						</div>

						<div class="col-12 mt-3">
							<label for="live_shortcode" class=""><?php echo lang("Localize.live_shortcode") ?></label>
							<input type="text" id="live_shortcode" name="live_shortcode" class="form-control" placeholder="<?php echo lang("Localize.live_shortcode") ?>">
						</div>


						<div class="col-12 mt-3">
							<label for="test_shortcode" class=""><?php echo lang("Localize.test_shortcode") ?></label>
							<input type="text" id="test_shortcode" name="test_shortcode" class="form-control" placeholder="<?php echo lang("Localize.test_shortcode") ?>">
						</div>
						<div class="col-12 mt-3">
							<label for="live_passkey" class=""><?php echo lang("Localize.live_passkey") ?></label>
							<input type="text" id="live_passkey" name="live_passkey" class="form-control" placeholder="<?php echo lang("Localize.live_passkey") ?>">
						</div>
						<div class="col-12 mt-3">
							<label for="test_passkey" class=""><?php echo lang("Localize.test_passkey") ?></label>
							<input type="text" id="test_passkey" name="test_passkey" class="form-control" placeholder="<?php echo lang("Localize.test_passkey") ?>">
						</div>
						<div class="col-12 mt-3">
							<label for="live_callback_url" class=""><?php echo lang("Localize.live_callback_url") ?></label>
							<input type="text" id="live_callback_url" name="live_callback_url" class="form-control" placeholder="<?php echo lang("Localize.live_callback_url") ?>">
						</div>
						<div class="col-12 mt-3">
							<label for="test_callback_url" class=""><?php echo lang("Localize.test_callback_url") ?></label>
							<input type="text" id="test_callback_url" name="test_callback_url" class="form-control" placeholder="<?php echo lang("Localize.test_callback_url") ?>">
						</div>
						<label class="form-group mt-3" for="">
							<?php echo lang("Localize.environment") ?>
						</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="environment" id="environment" value="1" checked>
							<label class="form-check-label" for="exampleRadios1">
								<?php echo lang("Localize.live") ?>
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="environment" id="environment" value="0">
							<label class="form-check-label" for="exampleRadios2">
								<?php echo lang("Localize.test") ?>
							</label>
						</div>

						<div class="text-danger">
							<?php if (isset($validation)) : ?>
								<?= $validation->listErrors(); ?>
							<?php endif ?>
						</div>



					</div>
					<br>
					<div class="col-12 text-center">
						<button type="submit" class="btn btn-success"><?php echo lang("Localize.submit") ?></button>
					</div>
				</div>

				<div class="col-4"></div>

			</div>





		</form>

	</div>
</div>
<?php echo $this->endSection() ?>