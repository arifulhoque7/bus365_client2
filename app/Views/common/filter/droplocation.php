<label for="drop_location_id" class="form-label"><?php echo lang("Localize.drop") ?> <abbr title="Required field">*</abbr></label>

<?php if ($drop_location_id) : ?>
    <select class="form-select select2" name="drop_location_id" id="drop_location_id" required>

        <?php foreach ($location as $locationvalue) : ?>


            <?php if ((!empty($drop_location_id) && ($locationvalue->id == $drop_location_id))) : ?>
                <option value="<?php echo $locationvalue->id ?>" selected><?php echo $locationvalue->name ?></option>

            <?php else : ?>
                <option value="<?php echo $locationvalue->id ?>"><?php echo $locationvalue->name ?></option>
            <?php endif ?>

        <?php endforeach ?>

    </select>
<?php else : ?>
    <select class="form-select select2" name="drop_location_id" id="drop_location_id" required>
        <option value="">None</option>

        <?php foreach ($location as $locationvalue) : ?>
            <option value="<?php echo $locationvalue->id ?>"><?php echo $locationvalue->name ?></option>
        <?php endforeach ?>
    </select>
<?php endif ?>