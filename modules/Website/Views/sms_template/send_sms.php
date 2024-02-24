<?php echo $this->extend('template/admin/main') ?>

<?php echo $this->section('content') ?>

    <?php echo $this->include('common/message') ?>

    <div class="card mb-4">
        <div class="card-body">

            <form action="<?php echo base_url(route_to('send-sms-smstemplate')) ?>" id="sms_templatecreate" method="post" class="row g-3" accept-charset="utf-8" enctype="multipart/form-data">
                <?php echo $this->include('common/security') ?>

                <div class="row justify-content-center">
              
                    <div class="col-lg-8">

                        <div class="row">
                            <div class="col-12 mt-3">
                                <label for="template_id" class="form-label"><?php echo lang("Localize.sms_template") ?></label>
                                <select class="form-select" name="template_id" id="template_id" required="">
                                    <option value="">Select a template</option>
                                    <?php foreach($sms_template as $data){ ?>
                                        <option value="<?php echo $data->id?>" ><?php echo $data->title?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="mobile"><?php echo lang("Localize.mobile") ?></label>
                                <input type="text" id="mobile" name="mobile" value="<?php echo esc(old('mobile')) ?>" class="form-control text-capitalize" placeholder="<?php echo lang("Localize.mobile") ?>">
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

                    
                </div>
            </form>
        </div>
    </div>
<?php echo $this->endSection() ?>