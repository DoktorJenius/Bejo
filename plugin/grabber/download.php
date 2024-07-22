<?php
require 'libraries/ua.class.php';
require 'libraries/simple_html_dom.php';

require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/functions/site.php';

require 'core/classes/agc.php';

dmca_redirect();
$result = agc()->get_download();
$related = agc()->get_related();
$top_download = agc()->top_download();
$searches = agc()->get_recent_search();

if ( $result ) {
  $site_title = str_replace( [ '%title%', '%duration%', '%domain%' ], [ $result['title'], $result['duration'], $_SERVER['HTTP_HOST'] ], $set['download_title'] );
  $meta_description = str_replace( [ '%title%', '%duration%', '%domain%' ], [ $result['title'], $result['duration'], $_SERVER['HTTP_HOST'] ], $set['download_desc'] );
  $meta_robots = $set['download_index'];
} else {
  redirect( site_url() );
}

include 'themes/'.$set['theme'].'/header.php';
require 'themes/'.$set['theme'].'/download.php';
include 'themes/'.$set['theme'].'/footer.php';
?>
