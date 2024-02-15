<?php echo $this->extend('template/admin/main') ?>

<?php echo $this->section('content') ?>


<div class="card mb-4">
	<div class="card-body">

		<form action="<?php echo base_url(route_to('create-luggagesetting')) ?>" id="luggagesetting" method="post" class="row g-3" accept-charset="utf-8">
			<?php echo $this->include('common/security') ?>


			<div class="col-lg-6">
				<label for="free_luggage_pcs" class=""><?php echo lang("Localize.free") ?> <?php echo lang("Localize.luggage") ?> (in pcs)</label>
				<input type="number" id="free_luggage_pcs" name="free_luggage_pcs" value="<?php echo esc(old('free_luggage_pcs'))  ?>" class="form-control" placeholder="<?php echo lang("Localize.free") ?> <?php echo lang("Localize.luggage") ?> (in pcs)">
			</div>
			<div class="col-lg-6">
				<label for="free_luggage_kg" class=""><?php echo lang("Localize.free") ?> <?php echo lang("Localize.luggage") ?> (in kg)</label>
				<input type="number" id="free_luggage_kg" step="0.01" name="free_luggage_kg" value="<?php echo esc(old('free_luggage_kg'))  ?>" class="form-control" placeholder="<?php echo lang("Localize.free") ?> <?php echo lang("Localize.luggage") ?> (in kg)">
			</div>

			<div class="col-lg-6">
				<label for="paid_max_luggage_pcs" class=""><?php echo lang("Localize.paid") ?> <?php echo lang("Localize.max") ?> <?php echo lang("Localize.luggage") ?> (in pcs)</label>
				<input type="number" id="paid_max_luggage_pcs" name="paid_max_luggage_pcs" value="<?php echo esc(old('paid_max_luggage_pcs'))  ?>" class="form-control" placeholder="<?php echo lang("Localize.paid") ?> <?php echo lang("Localize.max") ?> <?php echo lang("Localize.luggage") ?> (in pcs)">
			</div>
			<div class="col-lg-6">
				<label for="paid_max_luggage_kg" class=""><?php echo lang("Localize.paid") ?> <?php echo lang("Localize.max") ?> <?php echo lang("Localize.luggage") ?> (in kg)</label>
				<input type="number" id="paid_max_luggage_kg" step="0.01" name="paid_max_luggage_kg" value="<?php echo esc(old('paid_max_luggage_kg'))  ?>" class="form-control" placeholder="<?php echo lang("Localize.paid") ?> <?php echo lang("Localize.max") ?> <?php echo lang("Localize.luggage") ?> (in kg)">
			</div> 

			<div class="col-lg-6">
				<label for="price_pcs" class=""> <?php echo lang("Localize.price") ?> (per pcs)</label>
				<input type="number" step="0.01" id="price_pcs" name="price_pcs" value="<?php echo esc(old('price_pcs'))  ?>" class="form-control" placeholder="<?php echo lang("Localize.price") ?> (per pcs)">
			</div>
			<div class="col-lg-6">
				<label for="price_kg" class=""><?php echo lang("Localize.price") ?> (per kg)</label>
				<input type="number" step="0.01" id="price_kg" name="price_kg" value="<?php echo esc(old('price_kg'))  ?>" class="form-control" placeholder="<?php echo lang("Localize.price") ?> (per kg)">
			</div>

			<div class="text-danger">
				<?php if (isset($validation)) : ?>
					<?= $validation->listErrors(); ?>
				<?php endif ?>
			</div>

			<br>
			<div class="col-12 text-center">
				<button type="submit" class="btn btn-success"><?php echo lang("Localize.submit") ?></button>
			</div>
		</form>

	</div>
</div>
<?php echo $this->endSection() ?>