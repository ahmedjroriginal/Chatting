<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hello</title>
    <link rel="stylesheet" href="style.css">
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
    </script>
  </head>
  <body>

    <?php

		session_start();
        $_SESSION['username'] = "jannah";

        ?>


    <div id="wrapper">

      <h1>Welcome To mY Website</h1>

      <div class="chat_wrapper">

        <div id="chat" style="height: 500px; overflow: auto;"></div>

        <form method="POST" id="messageFrm">
          <textarea name="message" rows="7" cols="30" class="textarea"></textarea>
        </form>

      </div>

    </div>

    <script>

    loadChat();

    setInterval(function() {
      loadChat();
    }, 1000);

    function loadChat() {
      $.post('handlers/messages.php?action=getMessages', function (response) {

        var scrollpos = $('#chat').scrollTop();
        var scrollpos = parseInt(scrollpos) + 520;
        var scrollHeight = $('#chat').prop('scrollHeight');

        $('#chat').html(response);

        if (scrollpos < scrollHeight) {

        } else {
          $('#chat').scrollTop( $('#chat').prop('scrollHeight') );
        }

      });
    }

      $('.textarea').keyup(function(e) {
        if (e.which == 13) {
          $('form').submit();
        }
      });

      $('form').submit(function(){

        var message = $('.textarea').val();

        $.post('handlers/messages.php?action=sendMessage&message='+message, function(response) {

          if (response == 1) {
            loadChat();
            document.getElementById('messageFrm').reset();
          }

        });

        return false;

      });

    </script>

  </body>
</html>
