<h2>Group List 
    <p class="pull-right"><a href="<?php echo base_url("index.php/groups/add"); ?>" class="btn btn-primary btn-sm">Add Group</a></p>
</h2>
<table class="table table-bordered table-striped" id="groupTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Create</th>
            <th>Modified</th>
            <th style="width: 175px">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($groups as $group) : ?>
            <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $group['name']; ?></td>
                <td><?php echo $group['created']; ?></td>                
                <td><?php echo $group['modified']; ?></td>
                <td>
                    <a href="<?php echo base_url("index.php/groups/permission/" . $group['group_id']); ?>" title="Change Password" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></a>
                    <a href="<?php echo base_url("index.php/groups/view/" . $group['group_id']); ?>" class="btn btn-default btn-xs">View</a>
                    <a href="<?php echo base_url("index.php/groups/edit/" . $group['group_id']); ?>" class="btn btn-default btn-xs">Edit</a>                    
                    <a href="<?php echo base_url("index.php/groups/delete/" . $group['group_id']); ?>"
                       onclick="return confirm('Are you sure you want to delete this item? <?php echo $group['name'] ?>');" 
                       class="btn btn-default btn-xs">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
