


    <table class="table">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Description
            </th>
            <th>
                Picture
            </th>


        </tr>
        </thead>
        <tbody>
        <?php foreach($features as $feature) { ?>
        <tr>
            <td><a href='?controller=features&action=show&id=<?php echo $feature->id; ?>'><?php echo $feature->id ?></a></td>
            <td><a href='?controller=features&action=show&id=<?php echo $feature->id?>' ><?php echo $feature->name ?></a></td>
            <td><?php echo $feature->description ?></td>
            <td><img src="<?php echo $feature->picturepath ?>"></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
