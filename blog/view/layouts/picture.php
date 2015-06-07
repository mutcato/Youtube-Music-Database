<div id="one_content">
		<div id="one_item">
			<div id="one_title">
				<a href="<?=$one_content[picture]?>"><?=$one_content[title]?></a>
				<span id="one_user_text">
					added by <a href="http://twitter.com/<?=$one_content[tw_name]?>"><?=$one_content[tw_name]?></a>
				</span>
			</div>
			<!--<a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fblog.cruisear.com%2F%3Fv%3D<?=$one_content[id]?>&media=<?=$one_content[picture]?>&description=<?=$one_content[title]?>" data-pin-do="buttonPin" data-pin-config="none" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_28.png" /></a>-->
			<!-- Go to www.addthis.com/dashboard to customize your tools -->
			<div class="addthis_sharing_toolbox"></div>		
			<a id="one_image_div" href="<?=$one_content[picture]?>">
				<img src="<?=$one_content[picture]?>" alt="<?=$one_content[title]?>" style="max-height: 100%; max-width: 100%">
			</a>
		</div>
</div>