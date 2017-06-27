var rowID = 0;

/* show the results on the website */
$('#form').submit(function(event) {
  storeMsg();
  return false;
})

function addMsgToHistory(sender, content, time) {
  $('#history').append($('<li>').text(sender + ': ' + content + ' ' + time));
}

/* send messages to server for storing */
function storeMsg() {
  $.ajax({
    type: 'POST',
    url: 'include/storeMsg.php' + window.location.search,
    data: {
      content: $('#msg').val()
    },
    success: function(response) {
      addMsgToHistory(sender, $('#msg').val(), $.parseJSON(response));
    }
  });
}

/* poll to retrieve new messages from server side */
function pollToShowMsg() {
  var gets = window.location.search;
  $.ajax({
    // if the web page is loaded, get all chat history, otherwise polling for responses
    url: (rowID == 0) ? 'include/loadMsg.php' + gets : 'include/retrieveMsg.php' + gets,
    dataType: 'JSON',
    data: {
      rowID: rowID
    },
    success: function(response) {
      for(var i = 0; i < response.length - 1; i++) {
        var uname = (senderID === response[i]['senderID']) ? sender : receiver;
        addMsgToHistory(uname, response[i]['content'], response[i]['dtime']);
      }
      rowID = response[response.length - 1];
      setTimeout(pollToShowMsg, 1000);
    }
  });
}

$(function() {
  pollToShowMsg();
});
