<?php
require 'include/models/message.php';
require 'include/db.php';

class MessageController {
  private $chatDB;

  public function __construct() {
    $this->chatDB = new SQLiteDB();
  }

  public function storeMsg($senderID, $receiverID, $content, $dtime) {
    $msg = new Message($senderID, $receiverID, $content, $dtime);
    try {
      $query = $this->chatDB->prepare('INSERT INTO messages (msgID, senderID, receiverID, content, dtime)
                                       VALUES (?, ?, ?, ?, ?)');
      $query->bindParam(1, $msg->msgID);
      $query->bindParam(2, $msg->senderID);
      $query->bindParam(3, $msg->receiverID);
      $query->bindParam(4, $msg->content);
      $query->bindParam(5, $msg->dtime);
      $query->execute();
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function retrieveMsg($userID1, $userID2, $rowID) {
    try {
      $query = $this->chatDB->prepare('SELECT * FROM messages WHERE ((senderID = :userID1 
                                                                AND receiverID = :userID2)
                                                                 OR (senderID = :userID2
                                                                AND receiverID = :userID1))
                                                                AND rowid > :rowID');
      $query->bindParam(':userID1', $userID1);
      $query->bindParam(':userID2', $userID2);
      $query->bindParam(':rowID', $rowID);
      $result = $query->execute();
      return $result;      
    } catch(Exception $e) {
      echo $e->getMessages();
    }
  }

  public function getLastRowID() {
    try {
      $result = $this->chatDB->query('SELECT MAX(rowid) FROM messages');
      return $result->fetchArray()['MAX(rowid)'];
    } catch(Exception $e) {
      echo $e->getMessages();
    }
  }
}
?>