<?php
$seconds_to_cache = 1209600;
$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
header("Expires: $ts");
header("Pragma: cache");
header("Cache-Control: max-age=$seconds_to_cache");
?>
<!doctype html itemscope itemtype="http://schema.org/LocalBusiness">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1,user-scalable=no">
<title><?php wp_title('',true); echo ' | '; bloginfo('title'); ?></title>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/favicon.png" rel="shortcut icon">


<meta itemprop="name" content="<?php bloginfo('title'); ?>">
<meta itemprop="description" content="<?php bloginfo('description'); ?>">
<?php wp_head(); ?>
<script type="text/javascript" src="//use.typekit.net/swo7dem.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>

<body>
<header role="main">
	<div class="logo"><a href="<?php bloginfo('url'); ?>" itemprop="url"><img src="<?php bloginfo('template_url'); ?>/assets/aklogo.png" itemprop="logo" width="160" height="80"></a></div>
	<nav>
	<?php wp_nav_menu(); ?>
		
	</nav>
</header>