<?php
require 'controllers/msgController.php';

if(!empty($_POST)) {
  $msgController = new MessageController();
  $dt = new DateTime("now", new DateTimeZone('Europe/Amsterdam'));
  $t = $dt->format('d/m/Y, H:i:s');
  $msgController->store($_GET['senderID'], $_GET['receiverID'],
                        $_POST['content'], $t);
  echo json_encode($t);
}
?>