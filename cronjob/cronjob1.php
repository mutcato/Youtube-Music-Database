<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<?php
    /* Mysql Settings */
    define('MYSQL_HOSTNAME', 'localhost');
    define('USERNAME', 'cruisear');
    define('PASSWORD', 'l122cmx6HB');
    define('DATABASE', 'cruisear_muzik');
    define('WEBSITE_ROOT', $_SERVER['DOCUMENT_ROOT'].'/c/');
	define('LASTFM_APP_ID', '0254a6c86df6730e94861e840076d500');	
	
    function db_connect() 
    {
        $connection = mysql_connect(MYSQL_HOSTNAME, USERNAME, PASSWORD);
        
        if (!$connection)
        {
          echo 'baglanamadi';
          mysql_error(); 
        }
 
        if (!mysql_select_db(DATABASE))
        {
          echo 'database bulunamadi'; 
          mysql_error();
        }
        
        mysql_query("SET NAMES UTF8");

        return $connection;    
    }
	
    function  simplexml_kurtul($params)
    {

        foreach($params as $key => $param)
        {   
            $b[$key] = (string)$param; 
        }          


        if($b){return $b;}else{return false;} 
    }
	
    function db_result_to_array($result) 
    {
        $res_array = array();
            
        for ($count = 0; $row = mysql_fetch_array($result); $count++)
        {
            $res_array[$count] = $row;    
        }
        return $res_array;
    }

	
 function sayac_oku()
 {
        db_connect();
        $query = "SELECT sayac FROM sayac";
        $result = mysql_query($query);
        $result = mysql_fetch_array($result);
        return $result['sayac'];    
 } 
 
 function select_satir_artist($satir)
 {
	db_connect();
	$q = "SELECT artist_name FROM artists WHERE id = ".$satir;
	$result = mysql_query($q);
	$result = mysql_fetch_array($result);
	return $result['artist_name'];
 }
 
 function select_top_tracks($artist)
 {
          $completeurl = 'http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist='.trim($artist).'&api_key='.LASTFM_APP_ID;
          $xml = simplexml_load_file($completeurl);
          $ts = $xml->toptracks->track;
          $length = count($ts); 
          for ($i = 0; $i < $length; $i++) {
             $tracks[$i] = $ts[$i]->name;
          }
          return simplexml_kurtul($tracks);	
 }
 
 function get_tags_by_track($track, $artist)
{
        $completeurl = 'http://ws.audioscrobbler.com/2.0/?method=track.gettoptags&artist='.trim($artist).'&track='.trim($track).'&api_key='.LASTFM_APP_ID;
        $xml = simplexml_load_file($completeurl);
        $ts = $xml->toptags->tag;
        $length = count($ts); 
        for ($i = 0; $i < $length; $i++) 
		{
           $tags[$i] = $ts[$i]->name;
        }
        return simplexml_kurtul($tags);
}
//print_r(get_tags_by_track('angie', 'the rolling stones'));

    function all_together($artist, $tracks)
    {       
       foreach($tracks as $track)
       {
          $tags = get_tags_by_track($track, $artist);
		  $count = count($tags);	   
		  if($count >= 1)
		  {	   
			  mysql_query(sprintf("INSERT INTO tracks SET tracks.artist_name='%s', tracks.track_name='%s'",trim(addslashes(strtolower(strip_tags($artist)))),trim(addslashes(strtolower(strip_tags($track))))));
			  $track_id = mysql_insert_id();
          }
		  if($count >= 1)
			{
			  foreach($tags as $tag)
			  {
				  if(strlen($tag)<90)
				  {
					$result = mysql_query(sprintf("SELECT id FROM tags WHERE tag_name='%s'",trim(addslashes(strtolower(strip_tags($tag))))));
					$num_rows = mysql_num_rows($result);
					if($num_rows > 0)
					{
						 $result = mysql_fetch_array($result);
						 if(!$result){echo mysql_error();}
						 $tag_id = $result['id'];
					}
					else
					{
						mysql_query(sprintf("INSERT INTO tags SET tags.tag_name='%s'",trim(addslashes(strtolower(strip_tags($tag))))));
						$tag_id = mysql_insert_id();
						if(!$tag_id){echo mysql_error();}                
					}
					$r = mysql_query(sprintf("INSERT INTO track_tag SET track_tag.track_id='%s', track_tag.tag_id='%s'",$track_id, $tag_id));
					if(!$r){echo mysql_error();}
				  }
			  } 
			}
       }
    }
	
    function sayac_arttir($kactane)
    {
        db_connect();
        $query = "UPDATE sayac SET sayac = sayac + ".$kactane;
        $result = mysql_query($query);
    }
 

 
 //********************************************************//
 
 $sayac = sayac_oku();
 
 function track_sec($satir)
 {
	db_connect();
	
	$query = "SELECT * FROM tracks WHERE id=$satir";
	
	$result = mysql_fetch_array(mysql_query($query));
	
	if(!$result)
	{
		mysql_error();
	}
	
	return $result;
 }
 echo $sayac;
 
 function hepsibir($sayac)
 {
	db_connect();
	for($satir=$sayac; $satir < $sayac + 30; $satir++)
	{
		$track = track_sec($satir);
		//print_r ($track);
		
		$tags = get_tags_by_track($track['track_name'], $track['artist_name']);
		//print_r($tags);
		foreach($tags as $tag)
		{
			$count = count($tags);	   
		    if($count >= 1)
		    {
				if(strlen($tag)<90)
				{
					$result = mysql_query(sprintf("SELECT id FROM tags WHERE tag_name='%s'",trim(addslashes(strtolower(strip_tags($tag))))));
					$num_rows = mysql_num_rows($result);
					if($num_rows > 0)
					{
						$result = mysql_fetch_array($result);
						if(!$result){echo mysql_error();}
						$tag_id = $result['id'];		
					}
					else
					{
						mysql_query(sprintf("INSERT INTO tags SET tags.tag_name='%s'",trim(addslashes(strtolower(strip_tags($tag))))));
						$tag_id = mysql_insert_id();
						if(!$tag_id){echo mysql_error();} 		
					}
					
					$r = mysql_query(sprintf("INSERT INTO track_tag SET track_tag.track_id='%s', track_tag.tag_id='%s'",$track['id'], $tag_id));
					if(!$r){echo mysql_error();}
				}
			}
		}
	}
	
	
 }
 
 hepsibir($sayac);
 sayac_arttir(30);
 
?>


</body>
</html>
