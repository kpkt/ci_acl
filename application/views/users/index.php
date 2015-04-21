<h2>Users List 
    <p class="pull-right"><a href="<?php echo base_url("index.php/users/add"); ?>" class="btn btn-primary btn-sm">Add User</a></p>
</h2>
<table class="table table-bordered table-striped" id="userTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th style="width: 175px">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a href="<?php echo base_url("index.php/users/change_password/" . $user['user_id']); ?>" title="Change Password" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></a>
                    <a href="<?php echo base_url("index.php/users/view/" . $user['user_id']); ?>" class="btn btn-default btn-xs">View</a>
                    <a href="<?php echo base_url("index.php/users/edit/" . $user['user_id']); ?>" class="btn btn-default btn-xs">Edit</a>                    
                    <a href="<?php echo base_url("index.php/users/delete/" . $user['user_id']); ?>"
                       onclick="return confirm('Are you sure you want to delete this item? <?php echo $user['name'] ?>');" 
                       class="btn btn-default btn-xs">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
