<?php
     /*
     $params: array
     returns an array
     */
     function  simplexml_kurtul($params)
     {

        if($params)
        {
             foreach($params as $key => $param)
             {   
                 $b[$key] = (string)$param; 
             }          
            
             if($b){return $b;}else{return false;}            
        }
        else
        {
            return false;
        } 

     }
 


     /*
    $params: string, artist_name - song
    returns an array >> video_id
    */      
    function youtube_video_bul($params)
    {   
        //str_replace("'", "", $params);
        $q = preg_replace('/[[:space:]]/', '/', trim($params));       
        $q = utf8_decode(utf8_encode($q));   		
        //$replacements = array(',', '?', '!', '.');       
        //$q = str_replace($replacements, "", $q); 
        //$feedURL = "http://gdata.youtube.com/feeds/api/videos/-/{$q}?category=Music&v=2&safeSearch=strict&orderby=relevance&max-results=1&format=5";
        
		  $client = new Google_Client();
		  $client->setDeveloperKey($GLOBALS['GOOGLE_DEVELOPER_KEY']);

		  // Define an object that will be used to make all API requests.
		  $youtube = new Google_Service_YouTube($client);

		  try {
			// Call the search.list method to retrieve results matching the specified
			// query term.
			$searchResponse = $youtube->search->listSearch('id,snippet', array(
			  'q' => $params,
			  'maxResults' => 1,
			));

			$videos = '';

			// Add each result to the appropriate list, and then display the lists of
			// matching videos, channels, and playlists.
			foreach ($searchResponse['items'] as $searchResult) {
			  if ($searchResult['id']['kind'] = 'youtube#video') {
				  $watch['image'] = $searchResult['snippet']['thumbnails']['medium']['url']; 
				  $watch['id'] = $searchResult['id']['videoId'];
			  }
			}

		  } catch (Google_ServiceException $e) {
			$htmlBody .= sprintf('<p>A Google service error occurred: <code>%s</code></p>',
			  htmlspecialchars($e->getMessage()));
		  } catch (Google_Exception $e) {
			$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
			  htmlspecialchars($e->getMessage()));
		  }
		  
		  return $watch;
 
    }    

	
	function get_song_info($artist, $track)
	{
		$completeurl = 'http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key='.LASTFM_APP_ID.'&artist='.trim($artist).'&track='.trim($track); 
		$completeurl = urlencode($completeurl);
        $xml = @simplexml_load_file($completeurl);
        $tpic = $xml->track->album->image[1];
		return $tpic;
	}
	
	
    function get_similar_tracks($artist, $track)
    {  
	
       $completeurl = 'http://ws.audioscrobbler.com/2.0/?method=track.getsimilar&artist='.$artist.'&track='.$track.'&api_key='.LASTFM_APP_ID; 
       $completeurl = urlencode($completeurl);
       $xml = @simplexml_load_file($completeurl);
       $tracks = $xml->similartracks->track;
       $length = count($tracks);
       for($i=0; $i<$length; $i++)
       {
           $tnames[$i] = $tracks[$i]->name;
           $artistnames[$i] = $tracks[$i]->artist->name;
           $tpics[$i] = $tracks[$i]->image[2];
		   
       }
       $tnames = simplexml_kurtul($tnames);
       $artistnames = simplexml_kurtul($artistnames); 
       $tpics = simplexml_kurtul($tpics); 
	   
       if(!$tnames){return false;}
        else
		{
		
			$key = rand(0, 49);;
 
				  $track_info['track_name'] = strtolower($tnames[$key]);
				  $track_info['artist_name'] = strtolower($artistnames[$key]);
				  $track_info['image'] = strtolower($tpics[$key]);
				  $track_info['key'] = $key;                 
         
			
        }

       return $track_info;      
    }

?>