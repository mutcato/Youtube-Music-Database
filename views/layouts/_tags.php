 <form id="combination" action="index.php" method="get" name="combination" target="_self">
                <div class="FixedHeightContainer">
				
                    <div class="TagContent">
					<div id="tagsHeader">Make an intersection set and click go.</div>
                        <input type="hidden" name="view" value="<?php echo LISTEN_VIEW;?>" />
                        <?php 
                            if($top_tags):
                                foreach($top_tags as $key => $top_tag):
                        ?>
                                    <div onclick="changeAction(<?php echo $key;?>)" class="cbox">
									<input id="field<?=$key?>" class="cekbox" type="checkbox" name="tag[]" value="<?php echo $top_tag['tag_name'];?>" />
									<label for="field<?=$key?>"><?php echo $top_tag['tag_name'];?></label></div>
                        <?php 
                                endforeach;
                            endif;
                        ?>
                    </div> 
					<input type="submit" value="GO>>" class="FindButton" />
                </div>
</form>