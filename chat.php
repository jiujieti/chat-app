<html>  
  <div class="container">
    <h1>Let's Chat</h1>
    <form method="POST">
      <input id="msg" type="text" name="message"></input>
      <button id="button" type="button">chat</button>
    </form>
  </div>
  <p id="sender">Sender: <?php echo $_GET['sender']?></p>
  <p id="receiver">Receiver: <?php echo $_GET['receiver']?></p>
  <p>
    <ul id="history"></ul>
  </p>
  <script src="public/javascripts/jquery-3.2.1.min.js"></script>
  <script src="public/javascripts/showMsg.js"></script>
</html>