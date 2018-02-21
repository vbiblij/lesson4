<?php

?>
<p>Its a test variable <b><?= $text; ?></b></p>
<p>Its a test db data</p>
<table>
<?php foreach($messages as $message) { ?>
  <tr><td><?= $message['id'];?></td><td><?= $message['message'];?></td><td><?= $message['time'];?></td></tr>
<?php } ?>
</table>