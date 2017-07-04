<?php
require 'models/user.php';

class UserController {

  public $usr;

  public function __construct() {
    $this->usr = new User();
  }

  public function signup($uname) {
    $message = '';
    if($this->usr->searchUser($uname)) {
      $message = 'User exists! Please login.';
    } else if(empty($uname)) {
      $message = 'User cannot be empty.';
    } else {
      $this->usr->createUser($uname);
      $message = 'This user is created. Now login and find your friend!';
    }
    return $message;
  }

  public function login($sender, $receiver) {
    $message = '';
    $data = array(
      'sender' => $sender,
      'senderID' => $this->usr->getUserID($sender),
      'receiver' => $receiver,
      'receiverID' => $this->usr->getUserID($receiver)
    );

    if($this->usr->searchUser($sender)) {
      if($this->usr->searchUser($receiver) && $sender != $receiver) {
        header('Location: chat.php?'.http_build_query($data));
      } else {
        $message = 'Your friend does not exist! Try again.';
      }
    } else if(!empty($sender)) {
      $message = 'User does not exist! Singup or try again.';
    } else {
      $message = 'User name cannot be empty!';
    }
    return $message;
  }

}
?>