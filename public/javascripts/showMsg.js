var sender = $('#sender').html().split(': ')[1];
var senderID = $('#senderID').html().split(': ')[1];
var receiver = $('#receiver').html().split(': ')[1];
var receiverID = $('#receiverID').html().split(': ')[1];
var rowID = 0;

/* show the results on the website */
$('#form').submit(function(event) {
  storeMsg();
  return false;
})

/* send messages to server for storing */
function storeMsg() {
  $.ajax({
    type: 'POST',
    url: 'storeMsg.php' + window.location.search,
    data: {
      content: $('#msg').val()
    },
    success: function(response) {
      var arr = ['<li>', sender, ': ', $('#msg').val(), ' ', $.parseJSON(response), '</li>'];
      $('ul').append(arr.join(''));
      $('#msg').val('');
    }
  });
}

/* poll to retrieve new messages from server side */
function pollToShowMsg() {
  var gets = window.location.search;
  $.ajax({
    url: (rowID == 0) ? 'loadMsg.php' + gets : 'retrieveMsg.php' + gets,
    dataType: 'JSON',
    data: {
      rowID: rowID
    },
    success: function(response) {
      for(var i = 0; i < response.length - 1 ; i++) {
        var uname = (senderID === response[i]['senderID']) ? sender : receiver;
        var arr = ['<li>', uname, ': ', response[i]['content'], ' ', response[i]['dtime'], '</li>'];
        $('ul').append(arr.join(''));
      }
      rowID = response[response.length - 1];
      setTimeout(pollToShowMsg, 1000);
    }
  });
}

$(function() {
  pollToShowMsg();
});