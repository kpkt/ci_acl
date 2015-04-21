<div class="row">
    <div class="col-md-12">   
        <h2>Example CI LOGIN</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Registration Form</div>
            <div class="panel-body">
                <?php echo form_open('authentications/register', array('novalidate' => true)); // ?>
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
                    <label for="UserPassword2" class="control-label">Verify Password :</label>
                    <input type="password" class="form-control" name="password2" id="UserPassword2" placeholder="verify password" value="<?php echo set_value('password2'); ?>">
                    <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="UserName" class="control-label">User Name :</label>
                    <input type="text" class="form-control" name="name" id="UserName" placeholder="Full Name" value="<?php echo set_value('name'); ?>">
                    <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="UserEmail" class="control-label">User Email :</label>
                    <input type="text" class="form-control" name="email" id="UserEmail" placeholder="Email" value="<?php echo set_value('email'); ?>">
                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                </div>                
                <button type="submit" class="btn btn-primary">Submit</button>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">Already have an account? <a href="<?php echo base_url("index.php/authentications/login"); ?>" class="btn btn-sm btn-success">Login</a></div>
        </div>       
    </div>
</div>