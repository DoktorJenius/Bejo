<div class="menu-home">
<div class="box">
	<h1 class="title-menu" style="border:0;"><b><?php echo $result['title']; ?></b></h1>
	<div class="videoWrapper">
		<iframe src="https://www.youtube.com/embed/<?php echo $result['id']; ?>" width="300" frameborder="0" allowfullscreen></iframe>
	</div>

	<div class="info">
		Published on <?php echo $result['date']; ?> by <b><?php echo $result['channel']; ?></b>
		<br/>Views: <?php echo $result['view']; ?>
		<br/>Duration: <?php echo $result['duration']; ?>
	</div>
	
	<div class="share">
		<b>SHARE: </b>
		<a href="http://www.facebook.com/sharer.php?u=<?php echo canonical_url(); ?>" title="Share <?php echo $result['title']; ?> to Facebook" target="_blank" class="facebook">Facebook</a>
		<a href="https://twitter.com/share?url=<?php echo canonical_url(); ?>" title="Share <?php echo $result['title']; ?> to Twitter" target="_blank" class="twitter">Twitter</a>
	</div>
	
	<div class="menulist" align="center">
		<?php echo $set[ 'adstop' ]; ?>
		<b><?php echo $result['title']; ?></b><br/><br/><?php echo $result['desc']; ?><br><br>
	</div>

	<div class="menulist">
		<?php echo $set[ 'adsbottom' ]; ?>
		<div class="detail">
			<center>
			<a class="btn-dl" style="padding:10px 10px;margin:10px;" href="<?php echo download_permalink( $result['title'], '--' . $result['id'] ); ?>">Listen Music</a>
			<?php if($set['safelink'] == 'yes'){ ?>
			<form method="post" action="<?php echo $set['safelink_url']; ?>">
			<?php }else{ ?>
			<form method="get" action="/dl/">
			<?php } ?>
			<?php $id_en = base64_encode($result['id']); ?>
			<input type="hidden" name="go" value="mp4" />
			<input type="hidden" name="get" value="<?php echo $id_en; ?>" />
			<input type="submit" class="safelink" value="Download MP4">
			</form></center>
		</div>
	</div>
</div>
</div>
<div class="menu-sidebar">
<?php echo $set[ 'adssidebar' ]; ?>
<div class="box">
	<div class="title-menu"><b>Related</b></div>
	<?php if ( $related ) { ?>
	<?php foreach ( $related as $item ) { ?>
		<div class="menulist">
			<b><a href="<?php echo stream_permalink($item['title'], '--' . $item['id']); ?>" title="Download <?php echo htmlentities( $item['title'], ENT_QUOTES ); ?> Mp3 and Videos"><?php echo $item['title']; ?></a></b>
		<br><?php echo $item['date']; ?>
		</div>
	<?php } unset( $item ); ?>
	<?php } ?>
</div>
</div>