<?php

$found = false;

foreach ( $routes as $route => $args ) {
  $querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
  $set = array();
  while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
  ((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
  
  if ( $args['name'] == 'search' ) {
    $route = str_replace( '%query%', '([^/_~!#$&*()+={}\[\]|;,]+)', $set['search_url'] );
  } if ( $args['name'] == 'artist' ) {
    $route = str_replace( '%artist%', '([^/_~!#$&*()+={}\[\]|;,]+)', $set['artist_url'] );
  } if ( $args['name'] == 'genre' ) {
    $route = str_replace( '%genre%', '([^/_~!#$&*()+={}\[\]|;,]+)', $set['genre_url'] );
  } if ( $args['name'] == 'download' ) {
    $route = str_replace( [ '%slug%', '%id%' ], '([^/_~!#$&*()+={}\[\]|;,]+)', $set['download_url'] );
  } if ( $args['name'] == 'stream' ) {
    $route = str_replace( [ '%slug%', '%id%' ], '([^/_~!#$&*()+={}\[\]|;,]+)', $set['stream_url'] );
  } if ( $args['name'] == 'file' ) {
    $route = str_replace( [ '%id%', '%artist%', '%title%' ], '([^/_~!#$&*()+={}\[\]|;,]+)', $set['post_url'] );
  } if ( $args['name'] == 'sitemap-keywords' ) {
    $route = str_replace( '%num%', '([0-9-]+)', $set['sitemap'] );
  } if ( $args['name'] == 'sitemap' ) {
    $route = $set['sitemap_index'];
  } if ( $args['name'] == 'pages' ) {
    $route = str_replace( '%pages%', '([^/_~!#$&*()+={}\[\]|;,]+)', '%pages%' );
  }

  $pattern = '/^' . str_replace( '/', '\/', $route ) . '$/';
  if ( preg_match( $pattern, $uri['path'], $vars ) ) {
    array_shift( $vars );

    $args['name'] = ( isset( $args['name'] ) ) ? $args['name'] : null;
    $args['vars'] = ( isset( $vars ) ) ? $vars : [];
    $args['file'] = ( isset( $args['file'] ) ) ? $args['file'] : null;

    $found = true;

    break;
  }
}

if ( ! $found ) {
  $args['name'] = 'error404';
  $args['vars'] = [];
}

$route = $args;
