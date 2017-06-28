var rowID = 0;

/* show the results on the website */
$('#form').submit(function(event) {
  storeMsg();
  return false;
})

function addMsgToHistory(sender, content, time, tbd) {
  if(tbd) {
    $('#history').append($('<li class="tbd">').text(sender + ': ' + content + ' ' + time));
  } 
  if(!tbd) {
    $('#history').append($('<li>').text(sender + ': ' + content + ' ' + time))
  }
}

function atBottom() {
  return ((window.innerHeight + window.scrollY) >= document.body.offsetHeight);
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
      var b = atBottom();
      addMsgToHistory(sender, msg, $.parseJSON(response), true);
      if (b) {
        scrollToBottom();
      }
    }
  });
}

/* poll to retrieve new messages from server side */
function pollToShowMsg() {
  $.ajax({
    // if the web page is loaded, get all chat history, otherwise polling for responses
    url: 'retrieveMsg.php' + window.location.search,
    dataType: 'JSON',
    data: {
      rowID: rowID
    },
    success: function(response) {
      $('li.tbd').remove();
      var b = atBottom();
      for(var i = 0; i < response.length - 1; i++) {
        var uname = (senderID === response[i]['senderID']) ? sender : receiver;
        addMsgToHistory(uname, response[i]['content'], response[i]['dtime'], false);
      }
      if (b && response.length > 1) {
        scrollToBottom();
      }
      rowID = response[response.length - 1];
      setTimeout(pollToShowMsg, 1000);
    }
  });
}

$(function() {
  pollToShowMsg();
});
