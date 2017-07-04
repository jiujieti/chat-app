<html>
  <link href="/public/styles/common.css" rel="stylesheet">

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
