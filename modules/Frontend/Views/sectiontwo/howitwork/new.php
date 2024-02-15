<?php echo $this->extend('template/admin/main') ?>

<?php echo $this->section('content') ?>

        <?php echo $this->include('common/message') ?>

    <div class="card mb-4">
        <div class="card-body">

            <form action="<?php echo base_url(route_to('create-section-two-deatil')) ?>" id="howitworks" method="post" class="row g-3" accept-charset="utf-8" enctype="multipart/form-data">
                <?php echo $this->include('common/security') ?>

                <div class="row justify-content-center">

                    <div class="col-md-8">

                        <div class="row">

                            <div class="col-12 mt-3">
                                <label for="title"><?php echo lang("Localize.title") ?></label>
                                <input type="text" id="title" name="title" value="<?php echo esc(old('title'))  ?>" class="form-control text-capitalize" placeholder="<?php echo lang("Localize.title") ?>">
                            </div>

                            <div class="col-12 mt-3">
                                <label for="button_text"><?php echo lang("Localize.button") ?> <?php echo lang("Localize.text") ?></label>
                                <input type="text" id="button_text" name="button_text" value="<?php echo esc(old('button_text'))  ?>" class="form-control text-capitalize" placeholder="<?php echo lang("Localize.button") ?> <?php echo lang("Localize.text") ?>">
                            </div>

                            <div class="col-12 mt-3">
                                <label for="description"><?php echo lang("Localize.description") ?></label>
                                <textarea id="editor1" rows="10" cols="80" type="text" name="description" class="form-control"> <?php echo esc(old('description'))  ?> </textarea>

                            </div>


                            <div class="col-12 mt-3">
                                <label for="howitworkimg" class="form-label"><?php echo lang("Localize.image") ?></label>
                                <div id="howitworkimg">

                                </div>
                                <small class="">max 1920X1080 px</small>
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

<?php echo $this->section('js') ?>
    <script src="<?php echo base_url('public/ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo base_url('public/ckeditor/ckeditor.active.js'); ?>"></script>
<?php echo $this->endSection() ?>