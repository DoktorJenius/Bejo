<?php

require 'libraries/ua.class.php';
require 'libraries/simple_html_dom.php';


require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/functions/site.php';

require 'core/classes/agc.php';

if ( $route['name'] == 'artist' ) {
	
$data = agc()->artist();
$searches = agc()->get_recent_search();
$top_download = agc()->top_download();
$artist = agc()->artist_search();
$q = get_search_query();
$all_songs = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select id from posts where artist = '$q'"));

if(!empty($_GET['page'])){
$paging = '| Page '.$_GET['page'];
$site_title = str_replace( [ '%artist%', '%page%', '%domain%' ], [ get_search_query(), $paging, $_SERVER['HTTP_HOST'] ], $set['artist_title'] );
$meta_description = str_replace( [ '%artist%', '%page%', '%domain%' ], [ get_search_query(), $paging, $_SERVER['HTTP_HOST'] ], $set['artist_desc'] );
} else {
$paging = '';
$site_title = str_replace( [ '%artist%', '%page%', '%domain%' ], [ get_search_query(), $paging, $_SERVER['HTTP_HOST'] ], $set['artist_title'] );
$meta_description = str_replace( [ '%artist%', '%page%', '%domain%' ], [ get_search_query(), $paging, $_SERVER['HTTP_HOST'] ], $set['artist_desc'] );
}	
$meta_robots = $set['search_index'];

}else{
	
$data = agc()->genre();
$searches = agc()->get_recent_search();
$top_download = agc()->top_download();
$q = get_search_query();
$all_songs = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select id from posts where genre = '$q'"));

if(!empty($_GET['page'])){
$paging = '| Page '.$_GET['page'];
$site_title = str_replace( [ '%genre%', '%page%', '%domain%' ], [ get_search_query(), $paging, $_SERVER['HTTP_HOST'] ], $set['genre_title'] );
$meta_description = str_replace( [ '%genre%', '%page%', '%domain%' ], [ get_search_query(), $paging, $_SERVER['HTTP_HOST'] ], $set['genre_desc'] );
} else {
$paging = '';
$site_title = str_replace( [ '%genre%', '%page%', '%domain%' ], [ get_search_query(), $paging, $_SERVER['HTTP_HOST'] ], $set['genre_title'] );
$meta_description = str_replace( [ '%genre%', '%page%', '%domain%' ], [ get_search_query(), $paging, $_SERVER['HTTP_HOST'] ], $set['genre_desc'] );
}
$meta_robots = $set['search_index'];

}

include 'themes/'.$set['theme'].'/header.php';
include 'themes/'.$set['theme'].'/posts.php';
include 'themes/'.$set['theme'].'/footer.php'; 
?>
