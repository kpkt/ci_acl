<h2>Group : Permissions </h2>
<table class="table table-hover table-bordered table-condensed table-striped">     
    <thead>
        <tr class="info">
            <th>Controller/Action</th>
            <?php foreach ($groups as $key => $value) { ?>
                <th><?php echo $value['name'] ?></th>
            <?php } ?>
        </tr>
        <tr class="warning">
            <td>All</td>
            <?php foreach ($groups as $key => $value) { ?>
                <td class="text-center">
                    <a href="<?php echo base_url("index.php/users/view/"); ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                    <a href="<?php echo base_url("index.php/users/view/"); ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>   
        <?php
      
        
        $count_groups = count($groups);
        $count = $count_groups + 1;
        foreach ($acos as $keyc => $aco) {
              $status = rand(0, 1);
            if ($aco['model'] == 'controller') {
                echo "<tr  class=\"info\">"
                . "<th colspan=\"$count\">" . $aco['alias'] . "</th>"
                . "</tr>";
            } else {
                echo "<tr>";
                echo "<td>" . $aco['alias'] . "</td>";
                for ($index = 0; $index < $count_groups; $index++) {
                    echo "<td class=\"text-center\">";
                    echo ($status ? '<a class="btn btn-success btn-xs" href="javascript:void(0)"><span aria-hidden="true" class="glyphicon glyphicon-ok"></span></a>' : '<a class="btn btn-danger btn-xs" href="javascript:void(0)"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a>');
                    #echo ($status ? "OK":"KO");
                    echo "</td>";
                }
                echo "</tr>";
            }
        }
        ?>

    </tbody>
</table>
