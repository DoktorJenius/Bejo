<?php

return [
  '/' => [ 'name' => 'home', 'file' => 'plugin/grabber/home.php' ],
  'search/([^/_~!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'search', 'file' => 'plugin/grabber/search.php' ],
  'artist/([^/_~!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'artist', 'file' => 'plugin/grabber/posts.php' ],
  'genre/([^/_~!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'genre', 'file' => 'plugin/grabber/posts.php' ],
  'download/([^/_~!#$&*()+={}\[\]|;,]+)-([^/_~!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'download', 'file' => 'plugin/grabber/download.php' ],
  'stream/([^/_~!#$&*()+={}\[\]|;,]+)-([^/_~!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'stream', 'file' => 'plugin/grabber/stream.php' ],
  'sitemap/([0-9-]+).xml' => [ 'name' => 'sitemap-keywords', 'file' => 'plugin/grabber/sitemap.php' ],
  'sitemap.xml' => [ 'name' => 'sitemap', 'file' => 'plugin/grabber/sitemap.php' ],
  '([^/_~!#$&*()+={}\[\]|;,]+)/([^/_~!#$&*()+={}\[\]|;,]+)-([^/_~!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'file', 'file' => 'plugin/grabber/file.php' ],
  '([^/_~!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'pages', 'file' => 'plugin/grabber/pages.php' ]
];
