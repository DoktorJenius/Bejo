<div class="menu-home">
  <div class="box">
	<h1 class="title-menu" style="border:0;"><b><?php echo $result['title']; ?></b></h1>
	<div class="info">
	  <div style="overflow: auto; height: 23px; text-align: justify; background:transparent;font-size:11px;font-family:Arial,Helvetica,sans-serif;padding:2px;">
	  Download Lagu <?php echo $result['title']; ?>.mp3  Gratis, Album Terbaru <?php echo $result['title']; ?> Pack Zip Rar, Free Download <?php echo $result['title']; ?>  Mp3, Lagu <?php echo $result['title']; ?> Mp3, Kumpulan Lagu <?php echo $result['title']; ?> Full Album, Gratis Download  <?php echo $result['title']; ?>.mp3 Mp3, Single Terbaru <?php echo $result['title']; ?> Kumpulan Lagu Terpopuler <?php echo $result['title']; ?> Lengkap Gratis, Free Download Full Album <?php echo $result['title']; ?> Komplit Terbaru Gratis. Download Lagu <?php echo $result['title']; ?>.mp3 Stafaband.info, Stafaband.co. Download Lagu <?php echo $result['title']; ?>.mp3 Savelagu.info, Savelagu.tv, Savelagu.eu. Download Lagu <?php echo $result['title']; ?>.mp3 Virusmusik.net. Download Lagu <?php echo $result['title']; ?>.mp3 Muviza.com, Muviza. Download Lagu <?php echo $result['title']; ?>.mp3 Uyeshare.com, Download Lagu <?php echo $result['title']; ?>.mp3 Bursamp3.
	  </div>
	</div>
  <div class="menulist">
	<table><tbody>
	  <tr valign="middle">
		<td valign="top"><img src="<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" title="<?php echo $result['title']; ?>" class="thumb"/></td>
		<td valign="top" width="100%"><b><?php echo $result['title']; ?>.mp3</b><br/>by <?php echo $result['channel']; ?></td>
	  </tr>
	</tbody></table>
  </div>
  <div class="info"><b>Note:</b> All songs are for personal, non-commercial use only. Please support the Artists by buying their original music <?php echo $result['title']; ?> Available on iTunes.com, Amazon.com, YesAsia.com.</div>
  <?php echo $set[ 'adstop' ]; ?>
  <div class="menulist">
	<table class="table">
		<tr><th width="15%">Title</th><th width="1%">:</th><th width="84%"><?php echo $result['title']; ?></th></tr>
		<tr><td>Artist</td><td>:</td><td><b><?php echo $result['channel']; ?></b></td></tr>
		<tr><td>Views</td><td>:</td><td><?php echo $result['view']; ?></td></tr>
		<tr><td>Published</td><td>:</td><td><?php echo $result['date']; ?></td></tr>
		<tr><td>Duration</td><td>:</td><td><?php echo $result['duration']; ?></td></tr>
		<tr><td>Type File</td><td>:</td><td>Audio MP3 (.mp3)</td></tr>
	</table>
  </div>
  <center>
	<iframe src="<?php echo site_url(); ?>/player.php?id=<?php echo $result['id']; ?>" frameborder="0" width=" 100%" height="40" allowfullscreen></iframe>
  </center>
  <div class="share">
		<b>SHARE: </b>
		<a href="http://www.facebook.com/sharer.php?u=<?php echo canonical_url(); ?>" title="Share <?php echo $result['title']; ?> to Facebook" target="_blank" class="facebook">Facebook</a>
		<a href="https://twitter.com/share?url=<?php echo canonical_url(); ?>" title="Share <?php echo $result['title']; ?> to Twitter" target="_blank" class="twitter">Twitter</a>
  </div>
  <?php echo $set[ 'adsbottom' ]; ?>
  <div class="menulist">
	<b>Link Download Song: </b>
	  <div class="detail">
	  <center>
			<a class="btn-dl" style="padding:10px 10px;margin:10px;" href="<?php echo stream_permalink( $result['title'], '--' . $result['id'] ); ?>">Watch Video</a>
			<?php if($set['safelink'] == 'yes'){ ?>
			<form method="post" action="<?php echo $set['safelink_url']; ?>">
			<?php }else{ ?>
			<form method="get" action="/dl/">
			<?php } ?>
			<?php $id_en = base64_encode($result['id']); ?>
			<input type="hidden" name="go" value="mp3" />
			<input type="hidden" name="get" value="<?php echo $id_en; ?>" />
			<input type="submit" class="safelink" value="Download MP3">
			</form>
	  </center>
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
			<b><a href="<?php echo download_permalink($item['title'], '--' . $item['id']); ?>" title="Download <?php echo htmlentities( $item['title'], ENT_QUOTES ); ?> Mp3 and Videos"><?php echo $item['title']; ?></a></b>
		<br><?php echo $item['date']; ?>
		</div>
	<?php } unset( $item ); ?>
	<?php } ?>
</div>
</div>