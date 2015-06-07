<?php
include ('config.php');
include ('functions/db_fns.php');

$view = empty($_GET['v']) ? 'home' : $_GET['v'];

if($view=='home'){
	//$content = pull_all_content();
	//print_r($content);
}else{
	$pic_id = (int)$view;
	$one_content = pull_one_content($pic_id); 
	$view = 'picture';
}



include (WEBSITE_ROOT.'/view/page.php');
?>