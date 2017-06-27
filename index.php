<?php
require 'include/controllers/userController.php';

$message = '';

// user signup
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'signup') {
  $user = new UserController($_POST['user']);
  if($user->searchUser()) {
    $message = 'User exists! Please login.';
  } else if(empty($_POST['user'])) {
    $message = 'User cannot be empty.';
  } else {
    $user->createUser();
    $message = 'This user is created. Now login and find your friend!';
  }
}

// user login
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
      $message = 'Your friend does not exist! Try again.';
    }
  } else if(!empty($_POST['sender'])) {
    $message = 'User does not exist! Singup or try again.';
  } else {
    $message = 'User name cannot be empty!';
  }
}
?>
<html>
  <link href="public/styles/common.css" rel="stylesheet">

  <div id="container">
    <h1>Let's Chat</h1>
    <form method="POST">
      <input type="text" name="user" class="users"></input>
      <input type="hidden" name="type" value="signup"></input>
      <button>signup</button>
    </form>
    <form method="POST">
      <input type="text" name="sender" class="users"></input>
      <input type="text" name="receiver" class="users"></input>
      <input type="hidden" name="type" value="login"></input>
      <button>login</button>
    </form>
    <p><?php echo $message; ?></p>
  </div>
</html>
