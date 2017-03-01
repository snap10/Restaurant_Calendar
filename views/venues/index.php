

<div id="venuesList" class="form-group">
    <div class="col-sm-12">

        <table id="venuetable" class="table">
            <thead>
            <tr>

                <th>
                    ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Beschreibung
                </th>
                <th>
                    Bild
                </th>
                <th>Features</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($venues as $venue) { ?>
                <tr>
                    <td>
                        <div class="checkbox required">
                            <label><input id="venuebox<?php echo $venue->id ?>" name="venuelist[]"
                                          value="<?php echo $venue->id ?>"
                                          type="checkbox" class="group-required"  /><?php echo $venue->id ?>
                            </label>
                        </div>
                      
                    </td>
                    <td><a target="_blank" href='?controller=venues&action=show&id=<?php echo $venue->id; ?>'><?php echo $venue->name ?></a></td>
                    <td><?php echo $venue->description ?></td>
                    <td><img class="image tableimage"src="<?php echo $venue->picturepath ?>"></td>
                    <td><?php foreach ($venue->getFeatures() as $feature) { ?>
                        <div class="checkbox">
                            <label>
                                <input id="featurebox<?php echo $feature->id ?>" name="featurelist[]"
                                       value="<?php echo $feature->id ?>"
                                       type="checkbox"><?php echo $feature->name ?>
                            </label>
                            <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    
