<div class="menu-home">
	<div class="box">
		<h1 class="title-menu"><b>Download MP3 & Video for: <?php echo get_search_query(); ?></b></h1>
<?php if ( $artist ) { ?>
<?php foreach ( $artist as $item ) { ?>
	<div class="info">
		<table width="100%">
		<tr><td valign="top">
		<img src="/themes/default/images/artists.png"/>
		</td>
		<td><h2 style="font-size:16px;"><b><?php echo $item['name']; ?></b></h2>
		Dapatkan semua lagu dari <b><?php echo $item['name']; ?></b> di <?php echo $set[ 'sitename' ]; ?>. Download daftar kumpulan lagu dari <b><?php echo $item['name']; ?></b> dengan mudah, gratis sepuasnya, dan nikmatilah!<br>
		<a class="btn-more" href="<?php echo artist_permalink( $item['name'] ); ?>">Selengkapnya</a>
		</td></tr>
		</table>
	</div>
<?php } unset( $item ); ?>
<?php } ?>
<?php if($set['rating'] == 'yes'){ ?>
<div class="info" style="margin:5px 0">
<ul itemscope itemtype="http://schema.org/MusicAlbum" style='padding:0;margin:0;color:#888;'>
<li>
<span itemprop="track" content="<?php echo get_search_query(); ?>"></span><span itemprop="fileFormat" content="Mp3"><span itemprop="byArtist" content="<?php echo get_search_query(); ?>"><span itemprop="keywords" content="Songs,Music,Album,Artists,Lyrics,Chord,Video,Live,Concert"><span itemprop="publisher" content="Youtube">
Reviewed by <span itemprop="author"><?php echo $namanya; ?></span> on
<span class="date updated"><?php echo date('l F d Y'); ?> </span>&#9733
<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
<span itemprop="ratingValue"><?php echo $ratingvalue; ?></span>
out of <span itemprop="bestRating">100</span>
based on <span itemprop="ratingCount"><?php echo $ratingcount; ?></span> user ratings
</span></br>
<span itemscope itemtype="http://schema.org/Rating">
Rating: <span itemprop="bestRating">5</span>
<meta itemprop="ratingValue" content="<?php echo $bintang; ?>"> &#9733 </span>
<span class="views" style='vertical-align: right;'><?php echo $viewes; ?> views</span>
</li>
</ul></div>
<?php }else{}?>
<?php echo $set[ 'adstop' ]; ?>
<?php if ( $data ) { ?>
<?php foreach ( $data as $item ) { ?>
	<div class="menulist">
		<h2 style="font-size:14px;"><b><?php echo $item['artist']; ?> - <?php echo $item['title']; ?>.mp3</b></h2>
		by <?php echo $item['artist']; ?><br>
		<a rel="nofollow" class="btn-cloud" href="<?php echo file_permalink( $item['id'], $item['artist'], $item['title'] ); ?>" title="Download <?php echo htmlentities( $item['artist'].' - '.$item['title'], ENT_QUOTES ); ?> Mp3 and Videos">Download</a> 
		<a rel="nofollow" class="btn-cloud" href="<?php echo $set[ 'adslink' ]; ?>">Fast Download</a>
	</div>
<?php } unset( $item ); ?>
<?php } ?>

<?php if ( $result ) { ?>
<?php foreach ( $result as $item ) { ?>
	<div class="menulist">
		<h2 style="font-size:14px;"><b><?php echo $item['title']; ?>.mp3</b></h2>
		by <?php echo $item['channel']; ?><br>
		<a rel="nofollow" class="btn-cloud" href="<?php echo download_permalink( $item['title'], '--' . $item['id'] ); ?>" title="Download <?php echo htmlentities( $item['title'], ENT_QUOTES ); ?> Mp3 and Videos">Download</a> 
		<a rel="nofollow" class="btn-cloud" href="<?php echo $set[ 'adslink' ]; ?>">Fast Download</a>
	</div>
<?php } unset( $item ); ?>
<?php } ?>

<?php echo $set[ 'adsbottom' ]; ?>
	</div>
</div>
<div class="menu-sidebar">
<?php echo $set[ 'adssidebar' ]; ?>
	<?php if ( $top_download ) {?>
    <div class="box">
	  <div class="title-menu"><b>Top Download</b></div>
        <?php foreach( $top_download as $item ) { ?>
          <a class="list" href="<?php echo file_permalink( $item['id'], $item['artist'], $item['title'] ); ?>" title="Download <?php echo htmlentities( $item['artist'].' - '.$item['title'], ENT_QUOTES ); ?> Mp3"># <?php echo $item['artist']; ?> - <?php echo $item['title']; ?></a>
        <?php } ?>
	</div>
    <?php } ?>
	<?php if ( $searches ) {?>
    <div class="box">
	  <div class="title-menu"><b>Recent Search</b></div>
        <?php foreach( $searches as $item ) { ?>
          <a class="list" href="<?php echo search_permalink( $item['keyword'] ); ?>"># <?php echo $item['keyword']; ?></a>
        <?php } ?>
    </div>
      <?php } ?>
</div>
