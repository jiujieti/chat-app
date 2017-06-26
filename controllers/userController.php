<?php
require 'models/user.php';
require 'db.php';

class UserController {
  private $chatDB;
  private $uname;

  public function __construct($uname) {
    $this->chatDB = new SQLiteDB();
    $this->uname = $uname;
  }

  /* search if a user exists or not */
  public function searchUser() {
    try {
      $query = $this->chatDB->prepare('SELECT COUNT(*) FROM users WHERE userName = :uname');
      $query->bindParam(':uname', $this->uname);
      $result = $query->execute();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
    // if any results are returned
    if($result->fetchArray()['COUNT(*)'] > 0) {
      return true;
    } else {
      return false;
    }
  }

  /* create a user */
  public function createUser() {
    $user = new User($this->uname);
    try {
      $query = $this->chatDB->prepare('INSERT INTO users (userID, userName) VALUES (?, ?)');
      $query->bindParam(1, $user->userID);
      $query->bindParam(2, $user->userName);
      $query->execute();
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  /* return a user's ID if exists */
  public function getUserID() {
    if($this->searchUser()) {
      try {
        $query = $this->chatDB->prepare('SELECT userID FROM users WHERE userName = :uname');
        $query->bindParam(':uname', $this->uname);
        $result = $query->execute();
        return $result->fetchArray()['userID'];
      } catch(Exception $e) {
        echo $e->getMessage();
      }
    }
    return false;
  }
}
?>