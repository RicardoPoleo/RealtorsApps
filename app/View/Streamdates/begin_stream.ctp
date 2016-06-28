
<script src='https://static.opentok.com/v2/js/opentok.min.js'></script>

<script type="text/javascript">

        var apiKey = '<?php echo $apiKey; ?>';
        var sessionId = '<?php echo $sessionId; ?>';
        var token = '<?php echo $token; ?>';

        
        console.log("token: "       +token);
        console.log("apiKey: "      +apiKey);
        console.log("sessionId: "   +sessionId);

        // Initialize an OpenTok Session object
        var session = TB.initSession(sessionId);

        // Initialize a Publisher, and place it into the element with id="publisher"
        var publisher = TB.initPublisher(apiKey, 'subscribers');

        publisher.addEventListener('accessAllowed', allowed);
        publisher.addEventListener('accessDenied', denied);

        function allowed() 
        {
            console.log('Allowed');
        }

        function denied() 
        {
            console.log('Denied');
        }

        // Attach event handlers
        session.on({

          // This function runs when session.connect() asynchronously completes
          sessionConnected: function(event) 
          {
            // Publish the publisher we initialzed earlier (this will trigger 'streamCreated' on other
            // clients)
            session.publish(publisher);
          },

          // This function runs when another client publishes a stream (eg. session.publish())
          streamCreated: function(event) 
          {
            // Create a container for a new Subscriber, assign it an id using the streamId, put it inside
            // the element with id="subscribers"
            var subContainer = document.createElement('div');
            subContainer.id = 'stream-' + event.stream.streamId;
            document.getElementById('subscribers').appendChild(subContainer);

            // Subscribe to the stream that caused this event, put it inside the container we just made
            session.subscribe(event.stream, subContainer);
          }
        });

        // Connect to the Session using the 'apiKey' of the application and a 'token' for permission
        session.connect(apiKey, token);
    </script>

<div class="streamdates view">
  <h2>You are broadcasting now!</h2>

    <div id="chatContainer" style="">
      <div id="left" style="  float: left; background: lightblue;">
        <div id="publisher"></div>
        <div id="subscribers"></div>
      </div>

      <div id="right" style="  float: right; height: 200px; width: 77%; background: lightgreen; overflow-y: scroll;">
         <p id="history"></p>
      </div>    
    </div>

    <div id="textchat">
         <form>
              <input type="text" placeholder="Input your text here" id="msgTxt"></input>
         </form>
    </div>    
</div>

<script type="text/javascript">
    // Receive a message and append it to the history
    var msgHistory = document.querySelector('#history');
    session.on('signal:chat', function(event) {
      var msg = document.createElement('p');
      msg.innerHTML = event.data;
      msg.className = event.from.connectionId === session.connection.connectionId ? 'mine' : 'theirs';
      msgHistory.appendChild(msg);
      msg.scrollIntoView();
    });

    // Text chat
    var form    = document.querySelector('form');
    var msgTxt  = document.querySelector('#msgTxt');

    // Send a signal once the user enters data in the form
    form.addEventListener('submit', function(event) 
    {
      event.preventDefault();
      session.signal({
          type: 'chat',
          data: 'broadcaster: '+msgTxt.value
        }, function(error) {
          if (!error) {
            msgTxt.value = '';
          }
        });
    });    
</script>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
</div>
