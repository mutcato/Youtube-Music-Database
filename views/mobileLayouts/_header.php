<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<title>
<?php 
	if($r['artist_name'])
	{
		echo $r['artist_name'].' - '.$r['track_name'];
	}
	else
	{
		echo 'YouTube Music Database';
	}
	?>
</title>

<meta name="description" content="Cruisear is an online radio which offers artists and tracks according to user' pleasure. You can listen by tags. Click over songs and get similar songs. " /> 
<meta name="keywords" content="internet radio, web radio, personal radio, video radio, cruisear, cruisear.com, social internet radio, music recommendations, similar artists, music" />
<meta name="copyright" content="Cruisear 2012-" /> 
<meta name="robots" content="index,follow" />
<meta name="application-name" content="Cruisear" />
<meta http-equiv="X-UA-Compatible" content="chrome=1,requiresActiveX=true">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Language" content="en"/>

<link rel='shortcut icon' href='favicon.ico'>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles/mobileStyle.css" />

<script src='http://connect.facebook.net/en_US/all.js'></script>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="scripts/js.js"></script>
<div id="fb-root"></div>

</head>
<body>

 <script>
 	
	var jsonObj; // if(jsonObj==undefined) diyebilmek için önce global olarak tanımlamamız gerekiyor
	if(jsonObj==undefined)
	{
		jsonObj = <?php echo $jsonPHPObj;?>;
		t_image = jsonObj.image;
		console.log(jsonObj);
	}

	// 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	  
		var w = window,
		d = document,
		e = d.documentElement,
		g = d.getElementsByTagName('body')[0],
		BrowserX = w.innerWidth || e.clientWidth || g.clientWidth;		
		BrowserY = w.innerHeight|| e.clientHeight|| g.clientHeight;
		if(BrowserX > BrowserY){
			PlayerX = BrowserX;
			PlayerY = BrowserY;
		}else{
			PlayerX = BrowserX;
			PlayerY = PlayerX*0.6;
		}


      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('ytplayer', {
          height: PlayerY,
          width: PlayerX,
          videoId: '<?php echo $yt_id; ?>',
          events: {
            'onStateChange': ytplayerOnStateChange
          }
        });
      }
	  
	  
  //
  // Ready Handler (this function is called automatically by YouTube JavaScript Player when it is ready)
  // * Sets up handler for other events
  //
function onYouTubePlayerReady( playerid )
  {
    var o = document.getElementById( 'ytplayer' );
    if ( o )
    {
      o.addEventListener( "onStateChange", "ytplayerOnStateChange" );
      o.addEventListener( "onError", "ytplayerOnError" );
    }
}
    

  //
  // State Change Handler
  // * Sets up the video index variable
  // * Calls the lazy play function
  //
function ytplayerOnStateChange( state )
  {	
		console.log(YT.PlayerState.PLAYING);
        
          if(state.data==0){
			if(query.artist && query.track){
				artist = query.artist;
				track = query.track;
				console.log(artist+' 111 '+track);
				radio();
			}else{
				console.log('state 00000');
				next_track_by_tag('<?php echo $tags_string;?>');
			}
		  }
        
  }

  
	function next_track_by_tag(tags)
	{
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var url = 'functions/ajax_next_track.php?tags=' + tags + '&nocache=' + Math.random();
		hr.open("GET", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{	
			   var return_data = hr.responseText;
			   console.log(return_data);
			   jsonObj = JSON.parse(return_data);
			   player.loadVideoById(jsonObj.yt_id, 0, 'large');
			   //link of artist track
			   document.getElementById("changeradio").href = "<?=APP_BASE_URL?>/?view=dinle&artist="+jsonObj.artist_name+"&track="+jsonObj.track_name;
			   document.getElementById("artist_name").innerHTML = jsonObj.artist_name;
			   document.getElementById("track_name").innerHTML = jsonObj.track_name;
			   //Changing #radiochannelname
			   document.getElementById("radiochannelname").innerHTML = jsonObj.artist_name+' - '+jsonObj.track_name;
			   //Changing page title
			   document.title = jsonObj.artist_name+' - '+jsonObj.track_name + ' on <?=$tagss?> channel';
			} 
			else
			{
	
	
	
			}
		}
		// Send the data to PHP now... and wait for response to update the status div
		document.getElementById("track_name").innerHTML = 'loading...';
		document.getElementById("artist_name").innerHTML = '';
		hr.send(null); // Actually execute the request
	}
	
	function radio()
	{
		artist = jsonObj.artist_name;
		track = jsonObj.track_name;
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var url = 'functions/ajax_next_track.php?artist_name=' + artist + '&track_name=' + track + '&nocache=' + Math.random();
		hr.open("GET", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{	
			   var return_data = hr.responseText;
			   console.log(return_data);
			   jsonObj = JSON.parse(return_data);
			   //document.getElementById("status").innerHTML = return_data;
			   player.loadVideoById(jsonObj.yt_id, 0, 'large');
			   //link of artist track
			   document.getElementById("changeradio").href = "<?=APP_BASE_URL?>/?view=dinle&artist="+jsonObj.artist_name+"&track="+jsonObj.track_name;
			   document.getElementById("artist_name").innerHTML = jsonObj.artist_name;
			   document.getElementById("track_name").innerHTML = jsonObj.track_name;
			   //Changing #radiochannelname
			   document.getElementById("radiochannelname").innerHTML = jsonObj.artist_name+' - '+jsonObj.track_name;
			   //Changing page title
			   document.title = jsonObj.artist_name+' - '+jsonObj.track_name + ' on <?=$r['artist_name']?> channel';
	
			} 
			else
			{

			}
		}
		
		// Send the data to PHP now... and wait for response to update the status div
		document.getElementById("track_name").innerHTML = 'loading...';
		document.getElementById("artist_name").innerHTML = '';
		hr.send(); // Actually execute the request
	}
	
	
	//Share Functions
	    FB.init({appId: "<?php echo FACEBOOK_APP_ID; ?>", status: true, cookie: true});

		function postToFeed() 
	{
		console.log(t_image);
        // calling the API ...
        var obj = {
          method: 'feed',
          link: jsonObj.shareUrlFace,
          picture: jsonObj.image,
          name: jsonObj.artist_name+' - '+jsonObj.track_name,
          caption: 'cruisear.com',
          description: 'Discover new artists, listen new songs.'
        };

        function callback(response) {
          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
        }

        FB.ui(obj, callback);
    }
	  
	function twitShare()
	{
		window.open('https://twitter.com/share?hashtags=NowPlaying&related=<?php echo TWITTER_NAME;?>&via=<?php echo TWITTER_NAME;?>&text='+jsonObj.artist_name+' - '+jsonObj.track_name+'&url='+jsonObj.shareUrlTwit, '', "height=250,width=600");
	}
	function stumbleShare()
	{
		window.open('http://www.stumbleupon.com/submit?url='+jsonObj.shareUrlTwit+'&title='+jsonObj.artist_name+' - '+jsonObj.track_name+'Video Clip Radio. Discover new artists, listen new songs.');
	}
	function GooglePlusShare()
	{
		window.open('https://plus.google.com/share?url='+jsonObj.shareUrlTwit);
	}
	function RedditShare()
	{
		window.open('http://www.reddit.com/submit?url='+jsonObj.shareUrlTwit+'&title='+jsonObj.artist_name+' - '+jsonObj.track_name);
	}
  </script>
