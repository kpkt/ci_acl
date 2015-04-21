<div class="row">
    <div class="col-md-12">   
        <h2>Example CI LOGIN</h2>
        <div class="panel panel-default">
            <div class="panel-heading">User Details 
            <a href="<?php echo base_url("index.php/users/edit/" . $user['user_id']); ?>" class="btn btn-warning btn-sm pull-right">Edit User</a>
            </div>
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt>#ID</dt>
                    <dd><?php echo $user['user_id'] ?></dd>
                    <dt>NAMA</dt>
                    <dd><?php echo $user['name'] ?></dd>
                    <dt>EMAIL</dt>
                    <dd><?php echo $user['email'] ?></dd>
                    <dt>CREATED</dt>
                    <dd><?php echo date('d-m-Y H:i A', strtotime($user['created'])) ?></dd>
                    <dt>MODIFIED</dt>
                    <dd><?php echo date('d-m-Y H:i A', strtotime($user['modified'])) ?></dd>
                </dl>
            </div>           
        </div>       
    </div>
</div>