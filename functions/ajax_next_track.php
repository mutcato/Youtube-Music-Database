<?php
include ('../config.php');
include ('music_fns.php');
include ('api_fns.php');
include ('array_and_string_fns.php');
 // Call set_include_path() as needed to point to your client library.
include ('../class/google-api-php-client-master/src/Google/Client.php');
include ('../class/google-api-php-client-master/src/Google/Service/YouTube.php');
 
if($_GET['tags'])
{
	function next_track_by_tag($tags)
	{
		$r = get_random_song($tags);
		//Artistname "&" içeriyorsa, URL'yi bozmasın diye onu "and" ile değiştiriyor.
		if (strpos($r['artist_name'],'&') !== false) {
			$r['artist_name'] = str_replace("&", "and", $r['artist_name']);
		}
		$str = $r['artist_name'].' - '.$r['track_name'];
		if($r['artist_name']=='' || $r['track_name']==''){
			$r['artist_name'] = 'ops!';
			$r['track_name'] = 'Something happened wrong  ';
			$r['yt_id'] = '0q5uDKtI1Go';
			$r['shareUrlTwit'] = APP_BASE_URL;
			$r['shareUrlFace'] = APP_BASE_URL;
		}else{
			$y = youtube_video_bul($str);
			$yt_id = $y['id'];
			$r['yt_id'] = $yt_id; 
			//$songInfo = get_song_info($r['artist_name'], $r['track_name']);
			$r['image'] = $y['image']; 
			$r['shareUrlTwit'] = urlencode(url_cevir(APP_BASE_URL.'?view='.LISTEN_VIEW.'&artist='.$r[artist_name].'&track='.$r[track_name]));
			$r['shareUrlFace'] = APP_BASE_URL.'?view='.LISTEN_VIEW.'&artist='.$r[artist_name].'&track='.$r[track_name];
		}
		echo json_encode($r);
	}
	
	next_track_by_tag($_GET['tags']);
}

if($_GET['artist_name'] && $_GET['track_name'])
{
	$r['artist_name'] = stripcslashes($_GET['artist_name']);
	$r['track_name'] = stripcslashes($_GET['track_name']);
	$radio_track = get_similar_tracks($r['artist_name'], $r['track_name']);
	
	//Artistname "&" içeriyorsa, URL'yi bozmasın diye onu "and" ile değiştiriyor.
	if (strpos($radio_track['artist_name'],'&') !== false) {
		$radio_track['artist_name'] = str_replace("&", "and", $radio_track['artist_name']);
	}	
	if($radio_track['artist_name']=='' || $radio_track['track_name']==''){
		$radio_track['artist_name'] = 'ops!';
		$radio_track['track_name'] = 'Something happened wrong';
		$radio_track['yt_id'] = '0q5uDKtI1Go';
		$radio_track['shareUrlTwit'] = APP_BASE_URL;
		$radio_track['shareUrlFace'] = APP_BASE_URL;

	}else{	
		$y = youtube_video_bul($radio_track['artist_name'].' - '.$radio_track['track_name']);
		$radio_track['yt_id'] = $y['id']; 
		$radio_track['shareUrlTwit'] = urlencode(url_cevir(APP_BASE_URL.'?view='.LISTEN_VIEW.'&artist='.$radio_track[artist_name].'&track='.$radio_track[track_name]));
		$radio_track['shareUrlFace'] = APP_BASE_URL.'?view='.LISTEN_VIEW.'&artist='.$radio_track[artist_name].'&track='.$radio_track[track_name];
	}
	echo json_encode($radio_track);
}
 

?>