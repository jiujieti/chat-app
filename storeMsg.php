<?php
require 'include/controllers/msgController.php';

if(!empty($_POST)) {
  $msgController = new MessageController();
  $msg = $msgController->msg;
  $dt = new DateTime("now", new DateTimeZone('Europe/Amsterdam'));
  $t = $dt->format('d/m/Y, H:i:s');
  $msg->storeMsg($_GET['senderID'], $_GET['receiverID'],
                 $_POST['content'], $t);
  echo json_encode($t);
}
?>