<?php $authUser = $this->session->userdata('user_session'); ?>
<div class="row">
    <div class="col-md-12">   
        <h2>Example CI LOGIN</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Chaneg Password User</div>
            <div class="panel-body">
                <?php
                echo form_open('users/change_password/', null, array(
                    'user_id' => $user['user_id'], 'username' => $authUser['username']
                )); 
                ?>
                <div class="form-group">
                    <label for="UserPassword" class="control-label">Current Password :</label>
                    <input type="password" class="form-control" name="current_password" id="UserPassword" placeholder="password" value="<?php echo set_value('current_password'); ?>">
                    <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="UserPassword" class="control-label">New Password :</label>
                    <input type="password" class="form-control" name="new_password" id="UserPassword" placeholder="password" value="<?php echo set_value('new_password'); ?>">
                    <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="UserPassword2" class="control-label">Verify New Password :</label>
                    <input type="password" class="form-control" name="new_password2" id="UserPassword2" placeholder="verify password" value="<?php echo set_value('new_password2'); ?>">
                    <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                </div>       
                <button type="submit" class="btn btn-primary">Update</button>
                <?php echo form_close(); ?>
            </div>           
        </div>       
    </div>
</div>