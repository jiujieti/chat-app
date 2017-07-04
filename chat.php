<html>
  <link href="/public/styles/common.css" rel="stylesheet">

  <div id="container">
    <h1>Let's Chat</h1>
    <p>
      <ul id="history"></ul>
    </p>
    <form id="form" method="POST">
      <input id="msg" type="text" name="message"></input>
      <button id="button" type="submit">chat</button>
    </form>
  </div>
  <script src="/public/javascripts/jquery-3.2.1.min.js"></script>
  <script>
    var sender = '<?php echo $_GET['sender']?>';
    var senderID = '<?php echo $_GET['senderID']?>';
    var receiver = '<?php echo $_GET['receiver']?>';
    var receiverID = '<?php echo $_GET['receiverID']?>';
  </script>
  <script src="/public/javascripts/showMsg.js"></script>
</html>
