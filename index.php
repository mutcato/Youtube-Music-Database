<?php

include ('config.php');
include ('functions/music_fns.php');
include ('functions/api_fns.php');
include ('functions/array_and_string_fns.php');
include ('class/Mobile_Detect.php');
 // Call set_include_path() as needed to point to your client library.
require_once 'class/google-api-php-client-master/src/Google/Client.php';
require_once 'class/google-api-php-client-master/src/Google/Service/YouTube.php';

$url = $_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
if(strpos($url, 'cruisear.com/c/')){header("Location: http://".str_replace('cruisear.com/c', WEBSITE, $url));}

$view = empty($_GET['view']) ? 'home' : $_GET['view'];

//Mobile_Detect.php classından geliyor
$detect = new Mobile_Detect;
if($detect->isMobile() || $detect->isTablet()){
	$controller='mobile';
}else{
	$controller='page';
}

switch ($view):

	case 'home';
		$top_tags = select_top_tags();
		$tags = @$_GET['tag'];
	break;
	
	case 'dinle';
		$top_tags = select_top_tags();
		$tags = @$_GET['tag'];
		
		if(isset($tags))
		{
			$tagss = tags_with_plus($tags);
		}
		if($_GET['artist'])
		{
			$r['artist_name'] = stripcslashes($_GET['artist']);
			$r['track_name'] = stripcslashes($_GET['track']);

			$r['image'] =  get_song_info($r['artist_name'] , $r['track_name']);
			$r['image'] = (string)$r['image'];
			
		}
		
		if($tags)
		{
			$tags_string = (TopTags2TagsId($tags));
			$r = get_random_song($tags_string);
		}
		
		if($r['artist_name']=='' || $r['track_name']==''){
			$r['artist_name'] = 'ops!';
			$r['track_name'] = 'Something happened wrong.  ';
			$yt_id = 'IJ4SzB3WMZg';
			$r['shareUrlTwit'] = APP_BASE_URL;
			$r['shareUrlFace'] = APP_BASE_URL;
		}else{
			$str = $r['artist_name'].' - '.$r['track_name'];

			$y = youtube_video_bul($str);
			$yt_id = $y['id'];
			//$r['image'] = get_song_info($r['artist_name'], $r['track_name']);
			//Hızlandırmak için trackimage'i lastfmden değil youtube tumbnail'i aldık.
			$r['image'] = $y['image'];
			//Facebook and Twitter share button infos
			$r['shareUrlTwit'] = urlencode(url_cevir(APP_BASE_URL.'?view='.LISTEN_VIEW.'&artist='.$r[artist_name].'&track='.$r[track_name]));
			$r['shareUrlFace'] = APP_BASE_URL.'?view='.LISTEN_VIEW.'&artist='.$r[artist_name].'&track='.$r[track_name];
		}	
			$jsonPHPObj = json_encode(array('image' => (string)$r['image'], 'artist_name' => $r['artist_name'], 'track_name' => $r['track_name'], 'shareUrlTwit' => $r['shareUrlTwit'], 'shareUrlFace' => $r['shareUrlFace']));
	break;
	
endswitch;

include (WEBSITE_ROOT.'views/'.$controller.'.php');

?>