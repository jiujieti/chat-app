<?php
require 'include/controllers/userController.php';

// user signup
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'signup') {
  $user = new UserController($_POST['user']);
  if($user->searchUser()) {
    echo "User exists! Please login.";
  } else {
    if(empty($_POST['user'])) {
      echo "User cannot be empty.";
    } else {
      $user->createUser();
      echo "You username is created. Now login and find your friend!";
    }
  }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'login') {
  
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
      echo "User does not exist! Singup or try again.";
    } else {
      echo "User name cannot be empty!";
    }

  }
}
?>
<html>
  <div class="container">
    <h1>Let's Chat</h1>
    <form method="POST">
      <input type="text" name="user"></input>
      <input type="hidden" name="type" value="signup"></input>
      <button>signup</button>
    </form>
    <form method="POST">
      <input type="text" name="sender"></input>
      <input type="text" name="receiver"></input>
      <input type="hidden" name="type" value="login"></input>
      <button>login</button>
    </form>
  </div>
</html>