<?php 
echo $this->Html->css('bootstrap.min.css');
echo $this->Html->script('jquery-1.12.0.min.js');
echo $this->Html->script('bootstrap.min.js');
$userEmail = $this->Session->read('Auth.User.User.email');
?>
<style type="text/css">
  .text-orange
  {
    color: #FF8B1F;
  }

  .text-red
  {
    color: red;
  }

  .text-huge
  {
    font-size: 30px;
  }

  .button-custom-orange
  {
    color: #fff;
      border-color: transparent;        
      background-color: #FF8B1F;
  }

  .button-custom-orange:hover
  {
    color:#FF8B1F;
    background-color: #fff;
    border-color: transparent;
  }

  .button-custom-orange:active
  {
    color: #fff;
      border-color: transparent;        
      background-color: #FF8B1F;
  } 
</style>  

<script src='https://static.opentok.com/v2/js/opentok.min.js'></script>

<script type="text/javascript">

var apiKey = '<?php echo $apiKey; ?>';
var sessionId = '<?php echo $sessionId; ?>';
var token = '<?php echo $token; ?>';
var userEmail = '<?php echo $userEmail; ?>';

var session;
var subscribers = {};

console.log("VIEW STREAM");
console.log("token: "       +token);
console.log("apiKey: "      +apiKey);
console.log("sessionId: "   +sessionId);
  //console.log("Calling: http://padpatdev.mobilemediacms.com/OpenTokTest/Server/web/generateToken.php?sessionId="   +sessionId);
  //console.log("Calling: http://padpatdev.mobilemediacms.com/OpenTokTest/Server/web/generateToken.php?sessionId="   +sessionId);

  // Initialize an OpenTok Session object
  var session = TB.initSession(sessionId);

  // Un-comment either of the following to set automatic logging and exception handling.
  // See the exceptionHandler() method below.
  TB.setLogLevel(TB.DEBUG);
  TB.addEventListener("exception", exceptionHandler);
  function initSession() 
  {
    if (TB.checkSystemRequirements() != TB.HAS_REQUIREMENTS) 
    {
      alert("You don't have the minimum requirements to run this application. Please upgrade to the latest version of Flash.");
    } 
    else 
    {
        session = TB.initSession(sessionId);  // Initialize session

        // Add event listeners to the session
        session.addEventListener('sessionConnected', sessionConnectedHandler);
        session.addEventListener('sessionDisconnected', sessionDisconnectedHandler);
        session.addEventListener('connectionCreated', connectionCreatedHandler);
        session.addEventListener('connectionDestroyed', connectionDestroyedHandler);
        session.addEventListener('streamCreated', streamCreatedHandler);
        session.addEventListener('streamDestroyed', streamDestroyedHandler);
      }
    }
    function destroySession() {
      session.removeEventListener('sessionConnected', sessionConnectedHandler);
      session.removeEventListener('sessionDisconnected', sessionDisconnectedHandler);
      session.removeEventListener('connectionCreated', connectionCreatedHandler);
      session.removeEventListener('connectionDestroyed', connectionDestroyedHandler);
      session.removeEventListener('streamCreated', streamCreatedHandler);
      session.removeEventListener('streamDestroyed', streamDestroyedHandler);
      session = null;
    }

    //--------------------------------------
    //  LINK CLICK HANDLERS
    //--------------------------------------
    /*
    If testing the app from the desktop, be sure to check the Flash Player Global Security setting
    to allow the page from communicating with SWF content loaded from the web. For more information,
    see http://www.tokbox.com/opentok/build/tutorials/helloworld.html#localTest
    */
    function connect() 
    {
      initSession();
      session.connect(apiKey, token);
    }
    
    function disconnect() 
    {
      session.disconnect();
      //stopPublishing();
    }

    function reconnect() 
    {
      disconnect();
      setTimeout(function () 
      {
        destroySession();
      }, 3000);
      setTimeout(function () 
      {
        connect();
      }, 5000);
    }

    // Called when user wants to start publishing to the session
    function startPublishing() 
    {
      if (!publisher) 
      {
        var parentDiv = document.getElementById("myCamera");
        var publisherDiv = document.createElement('div'); // Create a div for the publisher to replace
        publisherDiv.setAttribute('id', 'opentok_publisher');
        parentDiv.appendChild(publisherDiv);
        publisher = TB.initPublisher(apiKey, publisherDiv.id);  // Pass the replacement div id
        session.publish(publisher);
      } 
      else 
      {
        session.publish(publisher);
      }
    }

    function stopPublishing() 
    {
      if (publisher) 
      {
        session.unpublish(publisher);
      }
    }

    function sessionConnectedHandler(event) 
    {
      // Subscribe to all streams currently in the Session
      for (var i = 0; i < event.streams.length; i++) {
        addStream(event.streams[i]);
      }
    }
    function streamCreatedHandler(event) {
      // Subscribe to the newly created streams
      for (var i = 0; i < event.streams.length; i++) {
        addStream(event.streams[i]);
      }
    }
    function streamDestroyedHandler(event) {
      // This signals that a stream was destroyed. Any Subscribers will automatically be removed.
      // This default behaviour can be prevented using event.preventDefault()
      event.preventDefault();
      for (var i = 0; i < event.streams.length; i++) 
      {
        console.log("streamDestroyedHandler");
        //console.log(event.streams[i]);
        var subscribersContainer = document.getElementById("subscribers");
        subscribersContainer.innerHTML = '';        
        console.log("Limpiando el contenedor");

        if (event.streams[i].connection.connectionId == session.connection.connectionId) 
        {
          // Our publisher just stopped streaming
          event.preventDefault(); // Don't remove the Publisher from the DOM.
        }
      }
    }
    function sessionDisconnectedHandler(event) 
    {
      // This signals that the user was disconnected from the Session. Any subscribers and publishers
      // will automatically be removed. This default behaviour can be prevented using event.preventDefault()
      //publisher = null;
      event.preventDefault();
      if (event.streams) 
      {
        for (var i = 0; i < event.streams.length; i++) 
        {
          console.log("sessionDisconnectedHandler");
          removeStream(event.streams[i]);

        }
      }
    }
    function connectionDestroyedHandler(event) {
      // This signals that connections were destroyed
    }
    function connectionCreatedHandler(event) {
      // This signals new connections have been created.
    }
    /*
    If you un-comment the call to TB.addEventListener("exception", exceptionHandler) above, OpenTok calls the
    exceptionHandler() method when exception events occur. You can modify this method to further process exception events.
    If you un-comment the call to TB.setLogLevel(), above, OpenTok automatically displays exception event messages.
    */
    function exceptionHandler(event) {
      console.log("Exception: " + event.code + "::" + event.message);
    }
    //--------------------------------------
    //  HELPER METHODS
    //--------------------------------------
    function addStream(stream) 
    {
      // Check if this is the stream that I am publishing, and if so do not publish.
      if (stream.connection.connectionId == session.connection.connectionId) 
      {
        return;
      }
      
      var subscriberDiv = document.createElement('div'); // Create a div for the subscriber to replace
      subscriberDiv.setAttribute('id', stream.streamId); // Give the replacement div the id of the stream as its id.
      document.getElementById("subscribers").appendChild(subscriberDiv);
      subscribers[stream.streamId] = session.subscribe(stream, subscriberDiv.id);
    }

    function removeStream(stream) {
      //var subscriberDiv = document.getElementById(stream.streamId); // 
      //subscriberDiv.parentNode.removeChild(subscriberDiv)
      session.unsubscribe(stream)
      subscribers[stream.streamId] = null;
    }
    
    function show(id) 
    {
      document.getElementById(id).style.display = 'block';
    }  
    </script>

    <div class="container"> 
      <div class="row">
        <div class="col-md-6"> 
          <?php echo $this->Html->image('padpat-fixed.jpg', array('class' => 'img-responsive'));?>
        </div>
        <div class="col-md-6"> 
          <div class="row">
            <div class="col-md-10"> </div>
            <div class="col-md-2">
              <?php
              $thumb_img = $this->Html->image('profile.png',  array('class' => 'img-responsive rigth'));
              echo $this->Html->link( $thumb_img, array('controller'=>'FutureTenants','action'=>'view', $userEmail), array('escape'=>false));
              ?>
            </div>
          </div>
        </div>
      </div>

      <p class="text-huge text-orange">You are watching the broadcast!</p>
      <div class="row" id="chatContainer">
        <div class="col-md-4">
          <div id="left" style="  float: left; background: lightblue;">
            <div id="subscribers"></div>
          </div>
        </div>
        <div class="col-md-8">
          <div id="right" style="  float: right; height: 200px; width: 77%; background: #F8F8F8; overflow-y: scroll;">
           <p id="history"></p>
         </div>
       </div>
     </div>
     <div class="row">
      <div class="col-md-12" id="textchat">
        <form>
          <input type="text" placeholder="Input your text here" id="msgTxt" style="width:102%"></input>
        </form>
      </div>
    </div>
    <div id="opentok_console"></div>
  </div>

<!--div class="streamdates view">

    <div id="chatContainer" style="">
      <div id="left" style="  float: left; background: lightblue;">
        <div id="subscribers"></div>
      </div>

      <div id="right" style="  float: right; height: 200px; width: 77%; background: lightgreen; overflow-y: scroll;">
         <p id="history"></p>
      </div>    
    </div>

    <div id="textchat">
         <form>
              <input type="text" placeholder="Input your text here" id="msgTxt" style="width:102%"></input>
         </form>
    </div>  </div>  
  </div-->


  <script type="text/javascript" charset="utf-8">
    //show('connectLink');
    </script>
    <script type="text/javascript">
    connect();

    // Receive a message and append it to the history
    var msgHistory = document.querySelector('#history');
    session.on('signal:chat', function(event) 
    {
      var msg       = document.createElement('p');
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
      session.signal(
      {
        type: 'chat',
        data: userEmail+": "+msgTxt.value
      }, 
      function(error) {
        if (!error) 
        {
          msgTxt.value = '';
        }
      });
    });


    </script>




