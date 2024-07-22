<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width" />

    <title><?php echo $site_title; ?></title>

    <?php if ( isset( $meta_description ) ) { ?>
      <meta name="description" content="<?php echo $meta_description; ?>" />
      <meta property="og:description" content="<?php echo $meta_description; ?>" />
    <?php } ?>
	<meta name="keywords" content="<?php echo $set[ 'keywords' ]; ?>" />
    <meta property="og:site_name" content="<?php echo $set[ 'sitename' ]; ?>" />
    <meta property="og:title" content="<?php echo $site_title; ?>" />
    <meta property="og:url" content="<?php echo canonical_url(); ?>" />
	<meta name="google-site-verification" content="<?php echo $set[ 'google' ]; ?>" />
	
    <?php if ( isset( $meta_robots ) ) { ?>
      <meta name="robots" content="<?php echo $meta_robots; ?>" />
    <?php } ?>

    <?php if ( isset( $result[0]['image'] ) ) { ?>
      <meta property="og:image" content="<?php echo $result[0]['image']; ?>" />
    <?php } elseif ( isset( $result['image'] ) ) { ?>
      <meta property="og:image" content="<?php echo $result['image']; ?>" />
    <?php } ?>
	<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <?php register_stylesheet( site_url() . '/themes/default/style.css' ); ?>
	<?php echo $set[ 'adspopup' ]; ?>
  </head>

  <body>
	<div id="bayu-head">
		<div class="wrapper">
			<h2 class="logo"><a rel="home" href="/"><?php echo $set['sitename'] ;?></a></h2>
			<!-- Menu Bar
			<div class="menu">
				<ul class="nav">
					<li><a href="/chart" title="Music"><hd>Chart</hd></a></li>
				</ul>
			</div>
			-->
		</div>
		<div class="clear"></div>
	</div>
	<div id="search" name="top">
		<div class="wrapper">
			<form method="get" action="<?php echo site_url(); ?>" class="searchform">
				<input type="text" name="search" autocomplete="off"  placeholder="Type your search here ..."/>
				<input type="submit" value="Search"/>
			</form>
		</div>
	</div>
	<div class="wrapper">