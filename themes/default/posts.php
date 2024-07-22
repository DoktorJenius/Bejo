<div class="menu-home">
	<div class="box">
		<h1 class="title-menu"><b>Kumpulan Lagu dari: <?php echo get_search_query(); ?></b></h1>
		<?php echo $set[ 'adstop' ]; ?>
		<?php if ( $data ) { ?>
		<?php foreach ( $data as $item ) { ?>
			<div class="menulist">
				<h2 style="font-size:14px;"><b><?php echo $item['artist']; ?> - <?php echo $item['title']; ?>.mp3</b></h2>
				by <?php echo $item['artist']; ?><br>
				<a rel="nofollow" class="btn-cloud" href="<?php echo file_permalink( $item['id'], ', ' . $item['title'] ); ?>" title="Download <?php echo htmlentities( $item['title'], ENT_QUOTES ); ?> Mp3 and Videos">Download</a> 
				<a rel="nofollow" class="btn-cloud" href="<?php echo $set[ 'adslink' ]; ?>">Fast Download</a>
			</div>
		<?php } unset( $item ); ?>
		<?php paging($all_songs,$page,$set[ 'artist_count' ],'?'); ?>
		<?php } ?>
		<?php echo $set[ 'adsbottom' ]; ?>
	</div>
</div>
<div class="menu-sidebar">
	<?php echo $set[ 'adssidebar' ]; ?>
	<?php if ( $searches ) {?>
		<div class="box">
			<div class="title-menu"><b>Recent Search</b></div>
			<?php foreach( $searches as $item ) { ?>
				<a class="list" href="<?php echo search_permalink( $item['keyword'] ); ?>"># <?php echo $item['keyword']; ?></a>
			<?php } ?>
		</div>
    <?php } ?>
</div>