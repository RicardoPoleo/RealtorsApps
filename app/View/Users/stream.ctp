<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>OpenTok API Sample &#8212; Basic Tutorial</title>
  <script src="//static.opentok.com/webrtc/v2.2/js/TB.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<script type="text/javascript" charset="utf-8">
    	var apiKey = '45517662';
    	var sessionId = '1_MX40NTUxNzY2Mn5-MTQ1NzM4NzY3NDkxN35HZTZNODdBbG1ONzZNUE5UaDVOaWhBUHJ-UH4'; 
    	var token = 'T1==cGFydG5lcl9pZD00NTUxNzY2MiZzaWc9ZDc1MzIyMDY5NWIyMjU1YjczODYzNWMwZDFhZjQ2NjA4ZWI2NzVkNzpzZXNzaW9uX2lkPTFfTVg0ME5UVXhOelkyTW41LU1UUTFOek00TnpZM05Ea3hOMzVIWlRaTk9EZEJiRzFPTnpaTlVFNVVhRFZPYVdoQlVISi1VSDQmY3JlYXRlX3RpbWU9MTQ1NzM4OTUyMiZyb2xlPXB1Ymxpc2hlciZub25jZT0xNDU3Mzg5NTIyLjI3NzQ4MDA4MTI1OTY='; 

	    var session;
	    var publisher;
	    var subscribers = {};
    	
    	function setupSessionData() 
    	{
      		//sessionId = document.getElementById("session-id").value;
      		//token = document.getElementById("session-token").value;
    	}

    	TB.setLogLevel(TB.DEBUG);
    	TB.addEventListener("exception", exceptionHandler);
    
    	function initSession() 
    	{
	    	if (TB.checkSystemRequirements() != TB.HAS_REQUIREMENTS) 
	      	{
	        alert("You don't have the minimum requirements to run this application."
	            + "Please upgrade to the latest version of Flash.");
	      	} 
	      	else 
	      	{
        		setupSessionData();
        		session = TB.initSession(sessionId);

		        // Add event listeners to the session
		        session.addEventListener('sessionConnected', sessionConnectedHandler);
		        session.addEventListener('sessionDisconnected', sessionDisconnectedHandler);
		        session.addEventListener('connectionCreated', connectionCreatedHandler);
		        session.addEventListener('connectionDestroyed', connectionDestroyedHandler);
		        session.addEventListener('streamCreated', streamCreatedHandler);
		        session.addEventListener('streamDestroyed', streamDestroyedHandler);
      		}
    	}

	    function destroySession() 
	    {
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
    	console.log("Comenzando el Connect.");
    	console.log("Antes del init session.");
      	initSession();
    	console.log("Despues del init, antes del session.connect.");
      	session.connect(apiKey, token);
    	console.log("Despues del init, antes del session.connect.");
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

	function stopPublishing() 
    {
		if (publisher) 
		{
        	session.unpublish(publisher);
      	}
    }

    //--------------------------------------
    //  OPENTOK EVENT HANDLERS
    //--------------------------------------
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
      for (var i = 0; i < event.streams.length; i++) {
        console.log("streamDestroyedHandler");
        console.log(event.streams[i]);
        if (event.streams[i].connection.connectionId == session.connection.connectionId) {
          // Our publisher just stopped streaming
          event.preventDefault(); // Don't remove the Publisher from the DOM.
        }
      }
    }
    function sessionDisconnectedHandler(event) {
      // This signals that the user was disconnected from the Session. Any subscribers and publishers
      // will automatically be removed. This default behaviour can be prevented using event.preventDefault()
      //publisher = null;
      event.preventDefault();
      if (event.streams) {
        for (var i = 0; i < event.streams.length; i++) {
          console.log("sessionDisconnectedHandler");
          console.log(event.streams[i]);
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
    function addStream(stream) {
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
    
    function removeStream(stream) 
    {
      session.unsubscribe(stream)
      subscribers[stream.streamId] = null;
    }
    function show(id) {
      document.getElementById(id).style.display = 'block';
    }
    function hide(id) {
      document.getElementById(id).style.display = 'none';
    }
  </script>
  	<div id="links">
        <input type="button" value="Connect" id ="connectLink" onClick="javascript:connect()" />
        <input type="button" value="Leave" id ="disconnectLink" onClick="javascript:disconnect()" />
        <input type="button" value="Reconnect" id ="reconnectLink" onClick="javascript:reconnect()" />
  </div>

	<div id="myCamera" class="publisherContainer"></div>
	<div id="subscribers"></div>
	<div>
    <label>Session ID</label>
    <textarea id="session-id"></textarea>
    	<br />
    <label>Token</label>
    <textarea id="session-token"></textarea>
  </div>

  <script type="text/javascript" charset="utf-8">
    show('connectLink');
  </script>
  <div id="opentok_console"></div>
</body>
</html>


