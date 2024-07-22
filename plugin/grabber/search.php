<?php
require 'libraries/ua.class.php';
require 'libraries/simple_html_dom.php';

require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/functions/site.php';

require 'core/classes/agc.php';

if ( $redirect = badword_redirect() ) {
  redirect( $redirect );
}

dmca_redirect();

$artist = agc()->artist_search();
$data = agc()->upload_search();
$result = agc()->get_search();
$trend_music = agc()->get_youtube_trend_music();
$searches = agc()->get_recent_search();
$top_download = agc()->top_download();

$size = ( isset( $result[0]['size'] ) ) ? $result[0]['size'] : '';

if($set['auto_search'] == 'yes'){
  $inp = strtolower(get_search_query());
  $add=mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO keywords (keyword) VALUES ('$inp')");
}else{}

if($set['limit_keyword'] == '0'){
	
}else{
	$totalkey = mysqli_result(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT COUNT(id) FROM keywords"), 0);
	if($totalkey > $set['limit_keyword']){
		mysqli_query($GLOBALS["___mysqli_ston"], "delete from keywords");
	}
}

$a = rand(1,9);
$b = rand(0,9);
$c = ''.$a.'.'.$b.' MB';

if($set['rating'] == 'yes'){
$namanya2 = array('Dicky','Reyhan','Debby','Adnan','Dendi','Wisma','Alma','Imam','Riana','Rinda','Agnes','Fitri','Rachel','Aldo','Mega');
$namanya1 = array_rand($namanya2);
$namanya  = $namanya2[$namanya1];

$ratingvalue3 = rand(7,9);
$ratingvalue2 = rand(0,9);
$ratingvalue = $ratingvalue3.''.$ratingvalue2;

$ratingcount3 = rand(1,9);
$ratingcount2 = rand(0,9);
$ratingcount = $ratingcount3.''.$ratingcount2;

$bintang = rand(4,5);

$viewes4 = rand(1,9);
$viewes3 = rand(0,9);
$viewes2 = rand(0,9);
$viewes1 = rand(0,9);
$viewes = $viewes4.','.$viewes3.''.$viewes2.''.$viewes1;
}else{
}

$site_title = str_replace( [ '%query%', '%size%', '%domain%' ], [ get_search_query(), $c, $_SERVER['HTTP_HOST'] ], $set['search_title'] );
$meta_description = str_replace( [ '%query%', '%size%', '%domain%' ], [ get_search_query(), $c, $_SERVER['HTTP_HOST'] ], $set['search_desc'] );
$meta_robots = $set['search_index'];

include 'themes/'.$set['theme'].'/header.php';
include 'themes/'.$set['theme'].'/search.php';
include 'themes/'.$set['theme'].'/footer.php';
?>
