<?php
require 'controllers/userController.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $sender = new UserController($_POST['sender']);
  $receiver = new UserController($_POST['receiver']);
  $data = array(
    'sender' => $_POST['sender'],
    'senderID' => $sender->getUserID(),
    'receiver' => $_POST['receiver'],
    'receiverID' => $receiver->getUserID()
  );
  
  if($sender->searchUser()) {

    if($receiver->searchUser() && $_POST['sender'] != $_POST['receiver']) {
      header('Location: chat.php?'.http_build_query($data));
    } else {
      echo "Your friend does not exist! Try again.";
    }

  } else {

    if(!empty($_POST['sender'])) {
      $sender->createUser();
      echo "You username is created. Now login and find your friend!";
    } else {
      echo "User name cannot be empty.";
    }

  }
}
?>
<html>
  <div class="container">
    <h1>Let's Chat</h1>
    <form method="POST">
      <input type="text" name="sender"></input>
      <input type="text" name="receiver"></input>
      <button>signup/login</button>
    </form>
  </div>
</html>