
<div class="row">
    <div class="col-md-6 col-md-offset-3">   
        <h2>Example CI LOGIN</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Login Form</div>
            <div class="panel-body">
                <?php echo form_open('authentications/login', array('novalidate' => true)); // ?>
                <div class="form-group">
                    <label for="UserUsername" class="control-label">Username :</label>
                    <input type="text" class="form-control" name="username" id="UserUsername" placeholder="username" value="<?php echo set_value('username'); ?>">
                    <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="UserPassword" class="control-label">Password :</label>
                    <input type="password" class="form-control" name="password" id="UserPassword" placeholder="password" value="<?php echo set_value('password'); ?>">
                    <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">                     
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">Do not have an account? <a href="<?php echo base_url("index.php/authentications/register"); ?>" class="btn btn-sm btn-success">Register</a></div>
        </div>
    </div>
</div>