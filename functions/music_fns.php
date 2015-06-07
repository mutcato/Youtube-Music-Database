<?php
function db_connect_select() 
{
        $connection = mysql_connect(MYSQL_HOSTNAME, USERNAME_SELECT, PASSWORD);
        
        if (!$connection)
        {
          return false; 
        }

        if (!mysql_select_db(DATABASE))
        {
          return false; 
        }
        
        mysql_query("SET NAMES UTF8");

        return $connection;    
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

function select_top_tags()
{
    $connection = db_connect_select();
    
    $query = 'SELECT * FROM top_tags WHERE priority=1 ORDER BY tag_name ASC';
    
    $result = db_result_to_array(mysql_query($query));
    
    if(mysql_ping($connection))
    {
        mysql_close($connection); 
    } 
    
    return $result; 
}

function TopTags2TagsId($params)
{
	$connection = db_connect_select();
	foreach($params as $param)
	{
		$query = sprintf("SELECT tags.id,
							tags.tag_name
						FROM tags
						WHERE tags.tag_name='%s'",
						mysql_real_escape_string($param)
					);
		$result = mysql_fetch_array(mysql_query($query));
		if(!$result)
		{
			return false;
		}
		$tag_ids_string .= $result['id'].',';		
	}
	
    if(mysql_ping($connection))
    {
        mysql_close($connection); 
    }
	
	//strips last comma
    $tag_ids_string = substr($tag_ids_string, 0, -1);
	
	return $tag_ids_string;
}

/**
$param > string. in form of 34,45,123
*/
function get_random_song($param)
{
	$connection = db_connect_select();
	$tagCount = substr_count($param, ',')+1;
	$query = "SELECT tracks.artist_name, tracks.track_name
            FROM tracks
            INNER JOIN track_tag ON tracks.id = track_tag.track_id
            INNER JOIN tags ON tags.id = track_tag.tag_id
            WHERE track_tag.tag_id IN ($param)
            GROUP BY tracks.id
            HAVING COUNT(tracks.id)=$tagCount
            ORDER BY RAND( )
            LIMIT 1";
			
		$result = mysql_fetch_array(mysql_query($query));
		if(!$result)
		{
			echo mysql_error();
		}
		else
		{
			return $result;
		}
		if(mysql_ping($connection))
		{
			mysql_close($connection); 
		}
		
}

	

?>