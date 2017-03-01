 <?php
  if(isset($_SESSION['valid'])&&$_SESSION['valid']==true) { ?>
  <table class="table">
    <thead>
    <tr>
      <th>
        ID
      </th>
      <th>
        Firstname
      </th>
      <th>
        Surename
      </th>
      <th>
        Email
      </th>
      <th>Street</th>
      <th>Number</th>
      <th>Zip</th>
      <th>City</th>
      <th>Phone</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach($clients as $client) { ?>
    <tr>
      <td> <a href='?controller=clients&action=show&id=<?php echo $client->id; ?>'><?php echo $client->id ?></a></td>
      <td><?php echo $client->firstname ?></td>
      <td><?php echo $client->surename ?></td>
      <td><?php echo $client->email ?></td>
      <td><?php echo $client->street ?></td>
      <td><?php echo $client->housenumber ?></td>
      <td><?php echo $client->zip ?></td>
      <td><?php echo $client->city ?></td>
      <td><?php echo $client->phone ?></td>
    </tr>
  <?php }?>
    </tbody>
  </table>
<?php
  }else{
      callWithMessage('pages', 'error','Please log in First');
  } ?>