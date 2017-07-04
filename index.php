<?php

require 'Controllers/userController.php';

if(!isset($_GET['sender']) || !isset($_GET['senderID']) 
|| !isset($_GET['receiver']) || !isset($_GET['receiverID'])) {
  $userController = new UserController();
  $message = '';
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'signup') {
    $message = $userController->signup($_POST['user']);
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'login') {
    $message = $userController->login($_POST['sender'], $_POST['receiver']);
  }
  require 'views/home.php';
}
?>