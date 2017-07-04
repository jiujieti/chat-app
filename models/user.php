<?php
require_once 'include/db.php';

class User {

  private $chatDB;

  public function __construct() {
    $this->chatDB = new SQLiteDB();
  }
  
  /* create a user */
  public function createUser($uname) {
    $userID = uniqid('usr_');
    try {
      $query = $this->chatDB->prepare('INSERT INTO users (userID, userName) VALUES (?, ?)');
      $query->bindParam(1, $userID);
      $query->bindParam(2, $uname);
      $query->execute();
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  /* search if a user exists or not */
  public function searchUser($uname) {
    try {
      $query = $this->chatDB->prepare('SELECT COUNT(*) FROM users WHERE userName = :uname');
      $query->bindParam(':uname', $uname);
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

  /* return a user's ID if exists */
  public function getUserID($uname) {
    if($this->searchUser($uname)) {
      try {
        $query = $this->chatDB->prepare('SELECT userID FROM users WHERE userName = :uname');
        $query->bindParam(':uname', $uname);
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
