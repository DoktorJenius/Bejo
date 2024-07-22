<div class="menu-home">
	<div class="box">
		<div class="title-menu"><b>Top iTunes</b></div>

		<?php if ( $top_songs ) { ?>
		<?php foreach ( $top_songs as $item ) { ?>
      	<?php $imgs = "".str_replace("https://","",$item['image']); ?>
		<div class="tabel">
			<div class="kotak">
				<div class="cover">
					<a href="<?php echo search_permalink( $item['title'] ); ?>" title="<?php echo htmlentities( $item['title'], ENT_QUOTES ); ?>">
						<img src="https://i2.wp.com/<?php echo $imgs; ?>?resize=153,153" alt="<?php echo htmlentities( $item['title'], ENT_QUOTES ); ?>" title="<?php echo htmlentities( $item['title'], ENT_QUOTES ); ?>"/>
					</a>
				</div>
				<h2 class="artist" style="font-size:12px;">
					<a href="<?php echo search_permalink( $item['title'] ); ?>" title="<?php echo htmlentities( $item['title'], ENT_QUOTES ); ?>">
						<b><?php echo $item['title']; ?></b>
					</a>
				</h2>
			</div>
		</div>
		<?php } unset( $item ); ?>
		<?php } ?>
		
	<div class="clear"></div>
	</div>
		
		<?php if ( $all_posts ) { ?>
		<div class="box">
		<div class="title-menu"><b>New Release</b></div>
		<?php foreach ( $all_posts as $item ) { ?>
        <?php $imgs2 = "".str_replace("https://","",$item['cover']); ?>
        <?php $imgs = "".str_replace("http://","",$imgs2); ?>
		<div class="tabel">
			<div class="kotak">
				<div class="cover">
					<a href="<?php echo file_permalink( $item['id'], $item['artist'], $item['title'] ); ?>" title="<?php echo htmlentities( $item['artist'].' - '.$item['title'], ENT_QUOTES ); ?>">
						<img src="https://i2.wp.com/<?php echo $imgs; ?>?resize=153,153" alt="<?php echo htmlentities( $item['title'], ENT_QUOTES ); ?>" title="<?php echo htmlentities( $item['artist'].' - '.$item['title'], ENT_QUOTES ); ?>"/>
					</a>
				</div>
				<h2 class="artist" style="font-size:12px;">
					<a href="<?php echo file_permalink( $item['id'], $item['artist'], $item['title'] ); ?>" title="<?php echo htmlentities( $item['artist'].' - '.$item['title'], ENT_QUOTES ); ?>">
						<b><?php echo $item['artist']; ?> - <?php echo $item['title']; ?></b>
					</a>
				</h2>
			</div>
		</div>
		<?php } unset( $item ); ?>
		<div class="clear"></div>
		<?php paging($all_songs,$page,$set[ 'new_post_count' ],'?'); ?>
		<div class="clear"></div>
		</div>
		<?php } ?>

</div>
<div class="menu-sidebar">
	<div class="box">
		<div class="title-menu"><b>Top Videos</b></div>	
	<?php if ( $top_videos ) { ?>
    <?php foreach ( $top_videos as $item ) { ?>
    <?php $imgs = "".str_replace("https://","",$item['image']); ?>
	<div class="menulist">
		<table><tbody>
			<tr valign="middle">
				<td valign="top"><img src="https://i2.wp.com/<?php echo $imgs; ?>?resize=58,58" width="46px" height="46px" alt="<?php echo htmlentities( $item['title'], ENT_QUOTES ); ?>" class="thumb"></td>
				<td valign="top">
					<h2 style="font-size:14px;"><a href="<?php echo download_permalink( $item['title'], '--' . $item['id'] ); ?>">
						<b><?php echo $item['title']; ?></b></a>
					</h2><?php echo $item['channel']; ?>
				</td>
			</tr>
		</tbody></table>
	</div>
	<?php } unset( $item ); ?>
	<?php } ?>
	</div>
	<?php if ( $top_download ) {?>
    <div class="box">
	  <div class="title-menu"><b>Top Download</b></div>
        <?php foreach( $top_download as $item ) { ?>
          <a class="list" href="<?php echo file_permalink( $item['id'], $item['artist'], $item['title'] ); ?>" title="Download <?php echo htmlentities( $item['artist'].' - '.$item['title'], ENT_QUOTES ); ?> Mp3"># <?php echo $item['artist']; ?> - <?php echo $item['title']; ?></a>
        <?php } ?>
	</div>
    <?php } ?>
</div>