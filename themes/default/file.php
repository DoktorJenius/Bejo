<div class="menu-home">
  <div class="box">
	<h1 class="title-menu" style="border:0;"><b><?php echo $result['artist']; ?> - <?php echo $result['title']; ?></b></h1>
	<div class="info">
	  <div style="overflow: auto; height: 23px; text-align: justify; background:transparent;font-size:11px;font-family:Arial,Helvetica,sans-serif;padding:2px;">
	  Download Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3  Gratis, Album Terbaru <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> Pack Zip Rar, Free Download <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>  Mp3, Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> Mp3, Kumpulan Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> Full Album, Gratis Download  <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3 Mp3, Single Terbaru <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> Kumpulan Lagu Terpopuler <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> Lengkap Gratis, Free Download Full Album <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> Komplit Terbaru Gratis. Download Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3 Stafaband.info, Stafaband.co. Download Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3 Savelagu.info, Savelagu.tv, Savelagu.eu. Download Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3 Virusmusik.net. Download Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3 Muviza.com, Muviza. Download Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3 Uyeshare.com, Download Lagu <?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3 Bursamp3.
	  </div>
	</div>
  <div class="menulist">
	<table><tbody>
	  <tr valign="middle">
		<td valign="top"><img src="<?php echo $result['cover']; ?>" alt="<?php echo $result['artist']; ?> - <?php echo $result['title']; ?>" title="<?php echo $result['artist']; ?> - <?php echo $result['title']; ?>" class="thumb"/></td>
		<td valign="top" width="100%"><b><?php echo $result['artist']; ?> - <?php echo $result['title']; ?>.mp3</b><br/>by <?php echo $result['artist']; ?></td>
	  </tr>
	</tbody></table>
  </div>
  <div class="info"><b>Note:</b> All songs are for personal, non-commercial use only. Please support the Artists by buying their original music <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> Available on iTunes.com, Amazon.com, YesAsia.com.</div>
  <?php echo $set[ 'adstop' ]; ?>
  <div class="menulist">
	<table class="table">
		<tr><th width="15%">Title</th><th width="1%">:</th><th width="84%"><?php echo $result['title']; ?></th></tr>
		<tr><td>Artist</td><td>:</td><td><a href="<?php echo artist_permalink($result['artist']); ?>" title="<?php echo $result['artist']; ?>"><b><?php echo $result['artist']; ?></b></a></td></tr>
		<tr><td>Album</td><td>:</td><td><?php echo $result['album']; ?></td></tr>
		<tr><td>Year</td><td>:</td><td><?php echo $result['rilis']; ?></td></tr>
		<tr><td>Genre</td><td>:</td><td><?php echo $result['genre']; ?></td></tr>
		<tr><td>Type File</td><td>:</td><td>Audio MP3 (.mp3)</td></tr>
	</table>
  </div>
  <center>
		<?php if($result['yt'] == ''){ ?>
		<audio controls controlsList="nodownload" style="width:100%">
			<source src="/save/<?php echo $_SERVER["HTTP_HOST"]; ?>/<?php echo $result['id']; ?>/<?php echo $result['artist']; ?> - <?php echo $result['title']; ?>" type="audio/mpeg"/>
			Your browser does not support the audio element.
		</audio>
		<?php } else { ?>
		<?php if($result['yt'] =='https://www.youtube.com/watch?v='.$check.''){ ?>
			<iframe src="<?php echo site_url(); ?>/player.php?id=<?php echo $check; ?>" frameborder="0" width=" 100%" height="40" allowfullscreen></iframe>
		<?php }elseif($result['yt'] =='http://www.youtube.com/watch?v='.$check.''){ ?>
			<iframe src="<?php echo site_url(); ?>/player.php?id=<?php echo $check; ?>" frameborder="0" width=" 100%" height="40" allowfullscreen></iframe>
		<?php }else{ ?>
		<audio controls controlsList="nodownload" style="width:100%">
			<source src="<?php echo $result['yt']; ?>" type="audio/mpeg"/>
			Your browser does not support the audio element.
		</audio>
		<?php }} ?>
  </center>
  <div class="share">
	<b>SHARE: </b>
	<a href="http://www.facebook.com/sharer.php?u=<?php echo canonical_url(); ?>" title="Share <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> to Facebook" target="_blank" class="facebook">Facebook</a>
	<a href="https://twitter.com/share?url=<?php echo canonical_url(); ?>" title="Share <?php echo $result['artist']; ?> - <?php echo $result['title']; ?> to Twitter" target="_blank" class="twitter">Twitter</a>
  </div>
  <?php if($result['lyric'] == ''){ ?>
  <?php } else { ?>
  <div class="menulist">
  <b>Lirik <?php echo $result['artist']; ?> – <?php echo $result['title']; ?>: </b>
  <div class="detail">
  <center>
  <?php echo $result['lyric']; ?><br>
  </center>
  </div>
  </div>
  <?php } ?>
  <?php echo $set[ 'adsbottom' ]; ?>
  <div class="menulist">
	<b>Link Download Song: </b>
	  <div class="detail">
	  <center>
		<?php
		if($result['yt'] == ''){
		?>
		<a class="btn-dl" href="/save/<?php echo $_SERVER["HTTP_HOST"]; ?>/<?php echo $result['id']; ?>/<?php echo $result['artist']; ?> - <?php echo $result['title']; ?>">Download MP3 (<?php echo fsize($result['size']); ?>)</a>
		<?php } else { ?>
		<?php if($result['yt'] =='https://www.youtube.com/watch?v='.$check.''){ ?>
		<?php if($set['safelink'] == 'yes'){ ?>
		<form method="post" action="<?php echo $set['safelink_url']; ?>">
		<?php }else{ ?>
		<form method="get" action="/dl/">
		<?php } ?>
		<?php $id_en = base64_encode($check); ?>
		<input type="hidden" name="go" value="mp3" />
		<input type="hidden" name="get" value="<?php echo $id_en; ?>" />
		<input type="submit" class="safelink" value="Download MP3">
		</form>
		<?php }elseif($result['yt'] =='http://www.youtube.com/watch?v='.$check.''){ ?>
		<?php if($set['safelink'] == 'yes'){ ?>
		<form method="post" action="<?php echo $set['safelink_url']; ?>">
		<?php }else{ ?>
		<form method="get" action="/dl/">
		<?php } ?>
		<?php $id_en = base64_encode($check); ?>
		<input type="hidden" name="go" value="mp3" />
		<input type="hidden" name="get" value="<?php echo $id_en; ?>" />
		<input type="submit" class="safelink" value="Download MP3">
		</form>
		<?php }else{ ?>
		<a class="btn-dl" href="<?php echo $result['yt']; ?>">Download MP3</a>
		<?php }} ?>
		</center></div>
  </div>
</div>
</div>
<div class="menu-sidebar">
  <?php echo $set[ 'adssidebar' ]; ?>
  <?php if ( $top_download ) { ?>
	<div class="box">
	  <div class="title-menu"><b>Top Download</b></div>
	  <?php foreach ( $top_download as $item ) { ?>
		<h2 class="menulist">
		  <a href="<?php echo file_permalink( $item['id'], $item['artist'], $item['title'] ); ?>" title="Download <?php echo htmlentities( $item['artist'].' - '.$item['title'], ENT_QUOTES ); ?> Mp3"><?php echo $item['artist'].' - '.$item['title']; ?></a>
		</h2>
	  <?php } unset( $item ); ?>
	</div>
  <?php } ?>
</div>