var sender = $('#sender').html().split(': ')[1];
var receiver = $('#receiver').html().split(': ')[1];
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
  $.ajax({
    url: 'retrieveMsg.php' + window.location.search,
    dataType: 'JSON',
    data: {
      rowID: rowID
    },
    success: function(response) {
      for(var i = 0; i < response.length - 1 ; i++) {
        var arr = ['<li>', receiver, ': ', response[i]['content'], ' ', response[i]['dtime'], '</li>'];
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