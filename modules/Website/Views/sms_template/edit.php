<?php echo $this->extend('template/admin/main') ?>

<?php echo $this->section('content') ?>

<?php echo $this->include('common/message') ?>

<div class="card mb-4">
    <div class="card-body">

        <form action="<?php echo base_url(route_to('update-smstemplate', $sms_template->id)) ?>" id="sectwohowitwork" method="post" class="row g-3" accept-charset="utf-8" enctype="multipart/form-data">
            <?php echo $this->include('common/securityupdate') ?>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row">
                        <!-- <div class="col-12 mt-3">
                            <label for="title"><?php // echo lang("Localize.title") ?></label>
                            <input type="text" id="title" name="title" value="<?php // echo esc(old('title')) ??  $sms_template->title ?>" class="form-control text-capitalize" placeholder="<?php // echo lang("Localize.title") ?>">
                        </div> -->

                        <div class="col-12 mt-3">
                            <label for="description"><?php echo lang("Localize.sms_body") ?></label>
                            <textarea id="editor1" rows="10" cols="80" type="text" name="description" class="form-control"> <?php echo esc(old('description'))  ?? $sms_template->description ?> </textarea>
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
                    </div>
                </div>
                <div class="col-lg-4 col-md-offset-1">
                    <div class="row mt-3">
                        <h5>Use these text on message template where you want to use this type of data in your message.</h5>
                        <ul>
                            <li>%merchant_id%</li>
                            <li>%amount%</li>
                            <li>%transection_id%</li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<?php echo $this->endSection() ?>

<?php echo $this->section('js') ?>
<!-- <script src="<?php // echo base_url('public/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php // echo base_url('public/ckeditor/ckeditor.active.js'); ?>"></script> -->
<?php echo $this->endSection() ?>