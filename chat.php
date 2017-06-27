<html>
  <h1>Let's Chat</h1>
  <p id="sender">Sender: <?php echo $_GET['sender']?></p>
  <p id="senderID">Sender ID: <?php echo $_GET['senderID']?></p>
  <p id="receiver">Receiver: <?php echo $_GET['receiver']?></p>
  <p id="receiverID">Receiver ID: <?php echo $_GET['receiverID']?></p>
  <p>
    <ul id="history"></ul>
  </p>
  <div class="container">
    <form id="form" method="POST">
      <input id="msg" type="text" name="message"></input>
      <button id="button" type="submit">chat</button>
    </form>
  </div>
  <script src="public/javascripts/jquery-3.2.1.min.js"></script>
  <script src="public/javascripts/showMsg.js"></script>
</html>