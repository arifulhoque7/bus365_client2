<?php echo $this->extend('template/admin/main') ?>

<?php echo $this->section('content') ?>

<?php echo $this->include('common/message') ?>

<div class="card mb-4">
    <div class="card-body">

        <form action="<?php echo base_url(route_to('update-fleet', $fleet->id)) ?>" id="fleetupdate" method="post" class="row g-3" accept-charset="utf-8" enctype="multipart/form-data">
            <?php echo $this->include('common/securityupdate') ?>

            <div class="col-lg-3">
                <label for="fleettype" class="form-label"><?php echo lang("Localize.fleet") ?> <?php echo lang("Localize.type") ?> <abbr title="Required field">*</abbr></label>
                <input type="text" placeholder="Fleet Type" name="type" value="<?php echo old('type') ?? $fleet->type ?>" class="form-control">
            </div>

            <div class="col-lg-3">
                <label for="layout" class="form-label"><?php echo lang("Localize.fleet") ?> <?php echo lang("Localize.layout") ?> <abbr title="Required field">*</abbr></label>
                <select id="layout" class="form-select" name="layout" required="required">
                    <?php
                    foreach ($layout as $key => $value) {
                        $selected = ($fleet->layout == $value->id) ? 'selected' : '';
                        echo '<option value="' . $value->id . '" ' . $selected . '>' . $value->layout_number . '</option>';
                    }
                    ?>
                </select>
            </div>


            <div class="col-lg-4">
                <label for="total_seat" class="form-label"><?php echo lang("Localize.total") ?> <?php echo lang("Localize.seat") ?> <abbr title="Required field">*</abbr></label>
                <input type="number" name="total_seat" id="total_seat" placeholder="Total Seat" class="form-control" value="<?php echo old('total_seat') ?? $fleet->total_seat ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="seat_number" class="form-label"><?php echo lang("Localize.seat") ?> <?php echo lang("Localize.number") ?> <abbr title="Required field">*</abbr></label>
                <textarea class="form-control" name="seat_number" id="seat_number" rows="3" readonly><?php echo old('total_seat') ?? $fleet->seat_number ?></textarea>
            </div>


            <div class="col-lg-3">
                <label class="form-label" for="">
                    <?php echo lang("Localize.status") ?>
                    <abbr title="Required field">*</abbr>
                </label>

                <?php if ($fleet->status == 1) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            <?php echo lang("Localize.active") ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                            <?php echo lang("Localize.disable") ?>
                        </label>
                    </div>
                <?php else : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="1">
                        <label class="form-check-label" for="exampleRadios1">
                            <?php echo lang("Localize.active") ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="0" checked>
                        <label class="form-check-label" for="exampleRadios2">
                            <?php echo lang("Localize.disable") ?>
                        </label>
                    </div>
                <?php endif ?>

            </div>

            <div class="text-danger">
                <?php if (isset($validation)) : ?>
                    <?= $validation->listErrors(); ?>
                <?php endif ?>
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success"><?php echo lang("Localize.submit") ?></button>
            </div>
        </form>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('js') ?>
<script src="<?php echo base_url('public/js/fleet.js'); ?>"></script>
<?php echo $this->endSection() ?>