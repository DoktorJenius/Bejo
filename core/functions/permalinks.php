<?php

function search_permalink( $query ) {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  $query = permalink( urldecode( $query ) );
  $slug = str_replace( '%query%', $query, $set[ 'search_url' ] );
  return site_url() . '/' . $slug;
}

function artist_permalink( $url ) {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  $artist = permalink( $url );
  $slug = str_replace( '%artist%', $artist, $set[ 'artist_url' ] );
  return site_url() . '/' . $slug;
}

function genre_permalink( $url ) {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  $genre = permalink( $url );
  $slug = str_replace( '%genre%', $genre, $set[ 'genre_url' ] );
  return site_url() . '/' . $slug;
}

function download_permalink( $title, $id ) {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  $slug = permalink( $title );
  $id = base64_url_encode( $id );
  $full_slug = str_replace( [ '%slug%', '%id%' ], [ $slug, $id ], $set[ 'download_url' ] );
  return site_url() . '/' . $full_slug;
}

function stream_permalink( $title, $id ) {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  $slug = permalink( $title );
  $id = base64_url_encode( $id );
  $full_slug = str_replace( [ '%slug%', '%id%' ], [ $slug, $id ], $set[ 'stream_url' ] );
  return site_url() . '/' . $full_slug;
}

function file_permalink( $id, $artist, $title ) {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  $artist = permalink( $artist );
  $title = permalink( $title );
  $id = $id;
  $full_slug = str_replace( [ '%id%', '%artist%', '%title%' ], [ $id, $artist, $title ], $set[ 'post_url' ] );
  return site_url() . '/' . $full_slug;
}

function pages_permalink( $url ) {
  $pages = $url;
  $slug = str_replace( '%pages%', $pages, '%pages%' );
  return site_url() . '/' . $slug;
}

function sitemap_keywords_permalink( $num ) {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  $slug = str_replace( '%num%', $num, $set[ 'sitemap' ] );
  return site_url() . '/' . $slug;
}

function sitemap_permalink() {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  $slug = $set[ 'sitemap_index' ];
  return site_url() . '/' . $slug;
}
