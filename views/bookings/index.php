
<?php
  if(isset($_SESSION['valid'])&&$_SESSION['valid']==true) { ?>
    <table class="table">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Client
            </th>
            <th>
                Description
            </th>
            <th>
                Venues
            </th>
            <th>
                Features
            </th>
            <th>Start</th>
            <th>End</th>
            <th>Created</th>
            <th>Approved/Denied on</th>
            <th>Booking State</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach($bookings as $booking) { ?>
        <tr>
            <td><a href='?controller=bookings&action=show&id=<?php echo $booking->id; ?>'><?php echo $booking->id ?></a></td>
            <td><a href='?controller=clients&action=show&id=<?php echo $booking->client->id?>' ><?php echo $booking->client->surename.' '.$booking->client->firstname ?></a></td>
            <td><?php echo $booking->description ?></td>
            <td><ul><?php ;
                    foreach($booking->getVenues() as $venue) {?>
                        <li> <a href="index.php?controller=venues&action=show&id=<?php echo $venue->id?>"><?php echo $venue->name?></a></li>
                    <?php }   ?>
                </ul>
            </td>
            <td><ul><?php
                    foreach($booking->getFeatures() as $feature) {
                        ?>

                        <li> <a href="index.php?controller=features&action=show&id=<?php echo $feature->id?>"><?php echo $feature->name?></a></li>
                    <?php }   ?>
                </ul>
            </td>
            <td><time><?php echo $booking->startDateTime ?></time></td>
            <td><time><?php echo $booking->endDateTime ?></time></td>
            <td><?php echo $booking->createdTimeStamp ?></td>
            <td><?php echo $booking->approvedDenyTimeStamp ?></td>
            <td><?php echo $booking->getBookingStateName()?></td>
        </tr>
        <?php }?>
        </tbody>
    </table>

<?php
  }else{
      callWithMessage('pages', 'error','Please log in First');
  } ?>