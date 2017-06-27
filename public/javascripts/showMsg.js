var rowID = 0;

/* show the results on the website */
$('#form').submit(function(event) {
  storeMsg();
  return false;
})

function addMsgToHistory(sender, content, time) {
  $('#history').append($('<li>').text(sender + ': ' + content + ' ' + time));
}

function scrollToBottom() {
  window.scroll(0, document.body.scrollHeight);
}

/* send messages to server for storing */
function storeMsg() {
  var msg = $('#msg').val();
  $('#msg').val('');
  $.ajax({
    type: 'POST',
    url: 'storeMsg.php' + window.location.search,
    data: {
      content: msg
    },
    success: function(response) {
      addMsgToHistory(sender, msg, $.parseJSON(response));
      scrollToBottom();
    }
  });
}

/* poll to retrieve new messages from server side */
function pollToShowMsg() {
  var gets = window.location.search;
  $.ajax({
    // if the web page is loaded, get all chat history, otherwise polling for responses
    url: (rowID == 0) ? 'loadMsg.php' + gets : 'retrieveMsg.php' + gets,
    dataType: 'JSON',
    data: {
      rowID: rowID
    },
    success: function(response) {
      for(var i = 0; i < response.length - 1; i++) {
        var uname = (senderID === response[i]['senderID']) ? sender : receiver;
        addMsgToHistory(uname, response[i]['content'], response[i]['dtime']);
      }
      scrollToBottom();
      rowID = response[response.length - 1];
      setTimeout(pollToShowMsg, 1000);
    }
  });
}

$(function() {
  pollToShowMsg();
});
