<h2>Group : Permissions </h2>
<table id="acls" class="table table-hover table-bordered table-condensed table-striped">     
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
                    <a href="<?php echo base_url("index.php/users/view/"); ?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                    <a href="<?php echo base_url("index.php/users/view/"); ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
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
                if ($aco['model'] == 'action') {//only list aros_acos with alias action 
                    foreach ($arosacos as $key => $value) {
                        if ($value['aco_id'] == $aco['id']) {
                            echo "<td class=\"text-center\">";
                            echo ($value['status'] ? '<a id="id-' . $value['id'] . '"  class="btn btn-xs btn-success disallow" href="#"><span aria-hidden="true" class="glyphicon glyphicon-ok"></span></a>' : '<a id="id-' . $value['id'] . '" class="btn btn-xs btn-danger allow" href="#"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a>');
                            echo "</td>";
                        }
                    }
                }
                echo "</tr>";
            }
        }
        ?>

    </tbody>
</table>
<style>
    .current {
        text-decoration: underline;
        color: green;
    }
</style>

<div id="menu">
    <ul>
        <li><a id="about-link" class="current" href="#">ABOUT</a></li>
        <li><a id="events-link" href="#">EVENTS</a></li>
        <li><a id="reviews-link" href="#">REVIEWS</a></li>
        <li><a id="contact-link" href="#">CONTACT</a></li>
    </ul>
</div>