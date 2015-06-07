    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
	<div id="ytplayer"></div>
	<a href="<?=APP_BASE_URL?>" id="dinleLogo"></a>
	<div id="sosyalmedya">
		<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2F<?=FACEBOOK_PAGE?>&amp;send=false&amp;layout=button&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=30&amp;appId=125962467592875" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:30px;" allowTransparency="true"></iframe>
		<div>
			<a href="https://twitter.com/<?=TWITTER_NAME?>" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @<?=TWITTER_NAME?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>		
		</div>
	</div>
	<?php if(!$_GET['artist']):?>
		<div id="nexttrack" title="Next track" onclick="next_track_by_tag('<?php echo $tags_string;?>');"></div>
	<?php else:?>
		<div id="nexttrack" title="Next track" onclick="radio();"></div>
	<?php endif;?>	
	<div id="player">
		<div id="plchfav">
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
		<span class="fav">
			<a id="twitShare" title="Share on Twitter" onclick="twitShare();" href="javascript:void(0);"><img src="img/TwitterShare.png" alt="Share on Twitter" /></a>
			<a title="Share on Facebook" href="javascript:void(0);" onclick="postToFeed();"> <img src="img/FacebookShare.png" alt="Share on Facebook" /> </a> 
			<a id="twitShare" title="Share on StumbleUpon" onclick="stumbleShare();" href="javascript:void(0);"><img src="img/StumbleShare.png" alt="Share on StumbleUpon" /></a>
			<a id="twitShare" title="Share on Google+" onclick="GooglePlusShare();" href="javascript:void(0);"><img src="img/GooglePlusShare.png" alt="Share on Google+" /></a>
			<a id="twitShare" title="Share on Reddit" onclick="RedditShare();" href="javascript:void(0);"><img src="img/RedditShare.png" alt="Share on Reddit" /></a>			
		</span>
		</div>
		
		<a id="changeradio" title="Similar songs to the <?=$r['artist_name'].' - '.$r['track_name'];?>" href="<?=APP_BASE_URL.'?view=dinle&artist='.$r['artist_name'].'&track='.$r['track_name']?>"><img src="img/radio.jpg" alt="Similar songs" /></a>

	</div>
	
	<?php require_once('_tags.php');?>