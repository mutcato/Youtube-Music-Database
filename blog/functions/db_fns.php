<?php
    function db_connect() {
        $connection = new mysqli(MYSQL_HOSTNAME, USERNAME, PASSWORD, DATABASE);
        
        if (!$connection)
        {
          echo 'baglanamadi';
          mysql_error(); 
        }
 
        if (!$connection->select_db(DATABASE))
        {
          echo 'database bulunamadi'; 
          mysql_error();
        }
        
        $connection->query("SET NAMES UTF8");

        return $connection;    
    }

	function db_result_to_array($result) 
    {
        $res_array = array();
            
        for ($count = 0; $row = mysqli_fetch_assoc($result); $count++)
        {
            $res_array[$count] = $row;    
        }
        return $res_array;
    }
	
	function pull_all_content($limit, $offset){
		$conn = db_connect();
		
		$query = "SELECT 
					pics.id,
					pics.tw_id,
					reddit_twitter.tw_name,
					pics.title,
					pics.picture,
					pics.type,
					pics.created_at 
					FROM pics,reddit_twitter 
					WHERE pics.type='resim' 
					AND 
					reddit_twitter.tw_id=pics.tw_id 
					AND 
					reddit_twitter.tw_id<>2778193658 
					ORDER by pics.created_at DESC
					LIMIT $limit OFFSET $offset";
		
		$result = $conn->query($query);
		
		$result = db_result_to_array($result);

		return $result;
		$conn->close();
	}	
	
	function pull_one_content($pic_id){
		$conn = db_connect();
		
		$query = "SELECT 
					pics.id,
					pics.tw_id,
					reddit_twitter.tw_name,
					pics.title,
					pics.picture,
					pics.type,
					pics.created_at 
					FROM pics,reddit_twitter 
					WHERE pics.id=$pic_id 
					AND 
					pics.type='resim' 
					AND 
					reddit_twitter.tw_id=pics.tw_id";
		
		$result = $conn->query($query);
		
		$result = mysqli_fetch_assoc($result);

		return $result;
		$conn->close();		
	}
?>