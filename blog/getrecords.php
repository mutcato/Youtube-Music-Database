<?php
require_once("config.php");
require_once("functions/db_fns.php");

$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 10;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;

$content = pull_all_content($limit, $offset);
$item = '';
foreach($content as $c):
	$item .=	
	"<div id='item'>
			<div id='title'>
				<a href='?v=$c[id]' target='_blank'>$c[title]</a>
				<span id='user_text'>
					added by <a href='http://twitter.com/$c[tw_name]'>$c[tw_name]</a>
				</span>
			</div>
			<a href='//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fblog.cruisear.com%2F%3Fv%3D$c[id]&media=$c[picture]&description=$c[title]' data-pin-do='buttonPin' data-pin-config='none' data-pin-height='28'><img src='//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_28.png' /></a>
			<a id='image_div' href='?v=$c[id]' target='_blank'>
				<img src='$c[picture]' alt='$c[title]' style='max-height: 100%; max-width: 100%'>
			</a>
	</div>";
endforeach;
echo ($item);
?>
