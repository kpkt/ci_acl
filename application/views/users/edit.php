
<div class="row">
    <div class="col-md-12">   
        <h2>Example CI LOGIN</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Edit User</div>
            <div class="panel-body">
                <?php echo form_open('users/edit/', null, array('user_id' => $user['user_id'])); // ?>
                <div class="form-group">
                    <label for="UserUsername" class="control-label">Username :</label>
                    <input type="text" class="form-control" name="username" id="UserUsername" placeholder="username" value="<?php echo $user['username']; ?>">
                    <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                </div>                
                <div class="form-group">
                    <label for="UserName" class="control-label">Full Name :</label>
                    <input type="text" class="form-control" name="name" id="UserName" placeholder="Full Name" value="<?php echo $user['name']; ?>">
                    <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="UserEmail" class="control-label">User Email :</label>
                    <input type="text" class="form-control" name="email" id="UserEmail" placeholder="Email" value="<?php echo $user['email']; ?>">
                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                </div>                
                <button type="submit" class="btn btn-primary">Update</button>
                <?php echo form_close(); ?>
            </div>           
        </div>       
    </div>
</div>