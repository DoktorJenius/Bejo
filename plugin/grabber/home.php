<?php
require 'libraries/ua.class.php';

require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/functions/site.php';

require 'core/classes/agc.php';

if ( isset( $_GET['search'] ) ) {
  if ( $_GET['search'] ) {
    redirect( search_permalink( $_GET['search'] ) );
  } else {
    redirect( site_url() );
  }
}
if(!empty($_GET['page'])){
  $site_title = $set[ 'home_title' ].' | Page '.$_GET['page'];
  $meta_description = $set[ 'home_desc' ].' | Page '.$_GET['page'];
  $meta_robots = $set['home_index'];
} else {
  $site_title = $set[ 'home_title' ];
  $meta_description = $set[ 'home_desc' ];
  $meta_robots = $set['home_index'];
}

$all_posts = agc()->all_posts();
$top_songs = agc()->get_itunes_top_songs();
$new_releases = agc()->get_itunes_new_releases();
$top_videos = agc()->get_youtube_top_videos();
$trend_music = agc()->get_youtube_trend_music();
$searches = agc()->get_recent_search();
$top_download = agc()->top_download();
$all_songs = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select id from posts"));

include 'themes/'.$set['theme'].'/header.php';
require 'themes/'.$set['theme'].'/home.php';
include 'themes/'.$set['theme'].'/footer.php'; 
?>
