<?php
require 'libraries/ua.class.php';
require 'libraries/simple_html_dom.php';

require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/functions/site.php';

require 'core/classes/agc.php';

dmca_redirect();
$result = agc()->get_file();
$recent_upload = agc()->recent_upload();
$top_download = agc()->top_download();

if ( $result ) {
if(!empty($_GET['page'])){
  $paging = '| Page '.$_GET['page'];
  $site_title = str_replace( [ '%title%', '%artist%', '%size%', '%page%', '%domain%' ], [ $result['title'], $result['artist'], fsize($result['size']), $paging, $_SERVER['HTTP_HOST'] ], $set['post_title'] );
  $meta_description = str_replace( [ '%title%', '%artist%', '%size%', '%page%', '%domain%' ], [ $result['title'], $result['artist'], fsize($result['size']), $paging, $_SERVER['HTTP_HOST'] ], $set['post_desc'] );
} else {
  $paging = '';
  $site_title = str_replace( [ '%title%', '%artist%', '%size%', '%page%', '%domain%' ], [ $result['title'], $result['artist'], fsize($result['size']), $paging, $_SERVER['HTTP_HOST'] ], $set['post_title'] );
  $meta_description = str_replace( [ '%title%', '%artist%', '%size%', '%page%', '%domain%' ], [ $result['title'], $result['artist'], fsize($result['size']), $paging, $_SERVER['HTTP_HOST'] ], $set['post_desc'] );
}
  $kode = $result['id'];
  $hit = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE posts SET listen = listen+1 WHERE id = '$kode'");
  $meta_robots = $set['post_index'];
} else {
  redirect( site_url() );
}
$checks = str_replace('https://www.youtube.com/watch?v=', '', $result['yt']); 
$check = str_replace('http://www.youtube.com/watch?v=', '', $checks); 

if($_GET['page']==2){
$paging='<a class="paging" href="'.canonical_url().'">1</a>
		<div class="paging-active">2</div>
		<a class="paging" href="?page=3">3</a>';
}elseif($_GET['page']==3){
$paging='<a class="paging" href="'.canonical_url().'">1</a>
		<a class="paging" href="?page=2">2</a>
		<div class="paging-active">3</div>';
}else{
$paging='<div class="paging-active">1</div>
		<a class="paging" href="?page=2">2</a>
		<a class="paging" href="?page=3">3</a>';
}

include 'themes/'.$set['theme'].'/header.php';
require 'themes/'.$set['theme'].'/file.php';
include 'themes/'.$set['theme'].'/footer.php'; 
?>
