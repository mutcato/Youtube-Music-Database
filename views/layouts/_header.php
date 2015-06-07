<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<title>
<?php 
	if($r['artist_name'])
	{
		echo $r['artist_name'].' - '.$r['track_name'];
	}
	else
	{
		echo 'YouTube Music Database';
	}
	?>
</title>

<meta name="description" content="Cruisear is an online radio which offers artists and tracks according to user' pleasure. You can listen by tags. Click over songs and get similar songs. " /> 
<meta name="keywords" content="internet radio, web radio, personal radio, video radio, cruisear, cruisear.com, social internet radio, music recommendations, similar artists, music" />
<meta name="copyright" content="Cruisear 2012-" /> 
<meta name="robots" content="index,follow" />
<meta name="application-name" content="Cruisear" />
<meta http-equiv="X-UA-Compatible" content="chrome=1,requiresActiveX=true">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Language" content="en"/>

<link rel='shortcut icon' href='favicon.ico'>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="styles/style.css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

<script src='http://connect.facebook.net/en_US/all.js'></script>
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script type="text/javascript" src="scripts/js.js"></script>
<div id="fb-root"></div>

</head>
<body>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=125962467592875&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-36295151-1', 'auto');
  ga('send', 'pageview');
</script>