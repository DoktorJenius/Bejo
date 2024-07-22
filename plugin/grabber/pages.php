<?php
require 'libraries/ua.class.php';
require 'libraries/simple_html_dom.php';

require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/functions/site.php';

require 'core/classes/agc.php';

$result = agc()->get_pages();
$searches = agc()->get_recent_search();

if ( $result ) {
  $site_title = $result['title'].' | '.$set[ 'home_title' ];
  $meta_description = $result['title'].' | '.$set[ 'home_desc' ];
} else {
  redirect( site_url() );
}

include 'themes/'.$set['theme'].'/header.php';

include 'themes/'.$set['theme'].'/pages.php';

include 'themes/'.$set['theme'].'/footer.php'; ?>
