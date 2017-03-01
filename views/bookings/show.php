<?php
  if(isset($_SESSION['valid'])&&$_SESSION['valid']==true ||isset($showfromextern)&&$showfromextern==true) { ?>
  
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
            <th>Features</th>
            <th>Start</th>
            <th>End</th>
            <th>Created</th>
            <th>Approved/Denied on</th>
            <th>BookingState</th>


        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $booking->id ?></td>
            <td><?php echo $booking->client->surename.' '.$booking->client->firstname ?></td>
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
        </tbody>
    </table>
<?php
  }else{
      callWithMessage('pages', 'error','Please log in First');
  } ?>