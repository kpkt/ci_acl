<div class="row">
    <div class="col-md-12">   
        <h2>Example CI ACL</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Permission ACL</div>
            <div class="panel-body">
                <!--<div class="alert bg-danger">-->
                <ul class="list-unstyled">
                    <?php echo (!$groups ? '<li class="text-danger">Group Empty</li>' : '') ?>
                    <?php echo (!$aros ? '<li class="text-danger">Aro\'s Empty</li>' : '') ?>
                    <?php echo (!$acos ? '<li class="text-danger">Aco\'s Empty</li>' : '') ?>
                    <?php echo (!$permssions ? '<li class="text-danger">Permissions Empty</li>' : '') ?>
                </ul>
                <!--</div>-->
                <ul>
                    <li><a href="<?php echo base_url("index.php/permissions/build_aros"); ?>">Build Aro's</a></li>
                    <li><a href="<?php echo base_url("index.php/permissions/build_acos"); ?>">Build Aco's</a></li>                
                    <li><a href="<?php echo base_url("index.php/permissions/build_permission"); ?>">Build Permission</a></li>                
                </ul>
            </div>           
        </div>       
    </div>
</div>
