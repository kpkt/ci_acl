<?php $authUser = $this->session->userdata('user_session'); ?>
<div class="header clearfix">
    <div style="padding-bottom: 5px;">
        <?php if ($authUser['name']): ?>
            <p class="text-muted">Login as : <?php echo $authUser['name'] ?>
                <span class="pull-right"><a class="btn btn-success btn-sm" href="<?php echo base_url("index.php/authentications/logout") ?>">Logout</a></span>
            </p>
        <?php else: ?>
             <p class="text-muted">
                <span class="pull-right"><a class="btn btn-success btn-sm" href="<?php echo base_url("index.php/authentications/login") ?>">Login</a></span>
            </p>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
    <nav>
        <ul class="nav nav-pills pull-right">
            <li role="presentation" class=" <?php echo (empty($this->uri->segment(1)) ? 'active' : '') ?>"><a href="<?php echo base_url() ?>">Home</a></li>
            <li role="presentation" class=" <?php echo ($this->uri->segment(1) == 'users' ? 'active' : '') ?>"><a href="<?php echo base_url("index.php/users/index") ?>">Users</a></li>            
        </ul>
    </nav>
    <h3 class="text-muted">Project: Codeigniter ACL (access controll list) : <?php echo $authUser['username'] ?></h3>
</div>
<?php
$message = $this->session->flashdata('item');
echo (!empty($message) ? '<div class="alert alert-' . $message['class'] . ' alert-dismissable" role="alert" id="infoMessage"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' . $message['message'] . '</div>' : '');
//$this->session->sess_destroy();
