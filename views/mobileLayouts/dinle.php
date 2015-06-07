    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="ytplayer"></div>
	<div id="player">
		<div id="artist_channel">
			<div id="artist_track">
				<span id="artist_name"><?=$r['artist_name']?></span>
				<span id="track_name"><?=$r['track_name']?></span>
			</div>
			<div id="channel">
					playing on
					<span id="channelInfo">
						<?php if($_GET['artist'] && $_GET['track']):
								echo $r['artist_name'].' - '.$r['track_name'];
							  elseif($tagss):
								echo $tagss;
							  endif;
						?> 
					</span>
					channel
			</div>
		</div>
		<?php if(!$_GET['artist']):?>
			<a id="changeSong" title="Shuffle" href="javascript:void(0);" onclick="next_track_by_tag('<?php echo $tags_string;?>');"><img src="img/nextSong.png" alt="Change the song" /></a>
		<?php else:?>
			<a id="changeSong" title="Shuffle" href="javascript:void(0);" onclick="radio();"><img src="img/nextSong.png" alt="Change the song" /></a>
		<?php endif;?>
			<span class="fav">
				<a id="twitShare" title="Share on Twitter" onclick="twitShare();" href="javascript:void(0);"><img src="img/TwitterShare.png" alt="Share on Twitter" /></a>
				<a title="Share on Facebook" href="javascript:void(0);" onclick="postToFeed();"> <img src="img/FacebookShare.png" alt="Share on Facebook" /> </a> 
				<a id="twitShare" title="Share on Twitter" onclick="stumbleShare();" href="javascript:void(0);"><img src="img/StumbleShare.png" alt="Share on StumbleUpon" /></a>
				<a id="twitShare" title="Share on Twitter" onclick="GooglePlusShare();" href="javascript:void(0);"><img src="img/GooglePlusShare.png" alt="Share on Google+" /></a>
				<a id="twitShare" title="Share on Twitter" onclick="RedditShare();" href="javascript:void(0);"><img src="img/RedditShare.png" alt="Share on Reddit" /></a>			
			</span>
	</div>
	<br />
		<a class="btn btn-success" id="changeradio" href="<?= APP_BASE_URL.'/?view=dinle&artist='.$r['artist_name'].'&track='.$r['track_name']?>">
			Click here to play similar songs of <br/>
			<span id="radiochannelname">
					<?php echo $r['artist_name'].' - '.$r['track_name']; ?> 
			</span>
		</a>
	
	
	<?php require_once('_tags.php');?>