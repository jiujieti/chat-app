<?php
require_once 'include/db.php';

class Message {
  
  private $chatDB;

  public function __construct() {
    $this->chatDB = new SQLiteDB();
  }

  /* store new messages in DB */
  public function storeMsg($senderID, $receiverID, $content, $dtime) {
    $msgID = uniqid('msg_');
    try {
      $query = $this->chatDB->prepare('INSERT INTO messages (msgID, senderID, receiverID, content, dtime)
                                       VALUES (?, ?, ?, ?, ?)');
      $query->bindParam(1, $msgID);
      $query->bindParam(2, $senderID);
      $query->bindParam(3, $receiverID);
      $query->bindParam(4, $content);
      $query->bindParam(5, $dtime);
      $query->execute();
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  /* retrieve all messages after last pull */
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

  /* get the max row ID of the message table */
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