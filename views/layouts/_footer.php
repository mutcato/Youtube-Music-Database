<script type="text/javascript">	
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
			PlayerX = BrowserX*0.85;
			PlayerY = BrowserY*0.94;
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
            'onStateChange': ytplayerOnStateChange,
			'onReady': onPlayerReady
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
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
			   console.log(jsonObj.artist_name);
			   console.log(jsonObj.track_name);
			   jsonObj = JSON.parse(return_data);
			   player.loadVideoById(jsonObj.yt_id, 0, 'large');
			   //link of artist track
			   document.getElementById("changeradio").href = "<?=APP_BASE_URL?>/?view=dinle&artist="+jsonObj.artist_name+"&track="+jsonObj.track_name;
			   document.getElementById("artist_name").innerHTML = jsonObj.artist_name;
			   document.getElementById("track_name").innerHTML = jsonObj.track_name;
			   //Changing #radiochannelname
			   document.getElementById("changeradio").title = 'Similar songs to the '+jsonObj.artist_name+' - '+jsonObj.track_name;
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
			   document.getElementById("changeradio").title = 'Similar songs to the '+jsonObj.artist_name+' - '+jsonObj.track_name;
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
		console.log(jsonObj.shareUrlFace);
		console.log(jsonObj.image);
		console.log(jsonObj.artist_name+' - '+jsonObj.track_name);
        // calling the API ...
        var obj = {
          method: 'feed',
          link: jsonObj.shareUrlFace,
          picture: jsonObj.image,
          name: jsonObj.artist_name+' - '+jsonObj.track_name,
          caption: 'YouTube Music DataBase (ytmdb.com)',
          description: 'Discover new artists, listen new songs.'
        };

        function callback(response) {
			
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
	
	
	//artist_channel div'inin içine çok yazı girerse div çok uzar. Uzayınca da aşağıya taşar.
	//Player genişliğinden(PlayerX) 40px kalıncaya kadar genişleyebilir.
	//Daha fazla genişlemeye kalkınca artist_channel divinin içindekilerin font-size'ı küçülür.
	//var uzun_width = document.getElementById("artist_channel").offsetWidth;
	//console.log(uzun_width);
</script>
</body>
</html>