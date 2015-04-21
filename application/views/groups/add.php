<div class="row">
    <div class="col-md-12">   
        <h2>Example CI ACL</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Add Group</div>
            <div class="panel-body">
                <?php echo form_open('groups/add', array('novalidate' => true)); // ?>

                <div class="form-group">
                    <label for="GroupName" class="control-label">Group Name :</label>
                    <input type="text" class="form-control" name="name" id="GroupName" placeholder="Group Name" value="<?php echo set_value('name'); ?>">
                    <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <?php echo form_close(); ?>
            </div>           
        </div>       
    </div>
</div>