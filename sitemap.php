<?php
require 'includes/db.php';
require 'core/functions/connect.php';
require 'config/init.php';

require 'core/functions/general.php';
require 'core/uri.php';
require 'core/router.php';
require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/functions/site.php';

$halaman = $set['sitemap_limit'];

if ($_GET['halaman']) {

header( "Content-Type: application/xml" );
echo'<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.site_url().'/assets/sitemap.xsl"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
  
	$id = $_GET['halaman'];
	$page = isset($id)? (int)$id:1;
	$mulai = ($page-1)*$halaman;
	$query = mysqli_query($GLOBALS["___mysqli_ston"], "select id, artist, title from posts LIMIT $mulai, $halaman");
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select id, artist, title from posts");
	$total = mysqli_num_rows($sql);
	$pages = ceil($total/$halaman); 

  while ($data = mysqli_fetch_array($query)) {
	  
    echo'
	<url>
		<loc>'.file_permalink($data['id'], $data['artist'], $data['title']).'</loc>
		<changefreq>daily</changefreq>
		<priority>0.6</priority>
	</url>';
          
  }
echo'</urlset>';

}else{
header( "Content-Type: application/xml" );
echo'<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.site_url().'/assets/sitemap.xsl"?>
<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	echo'<sitemap>
		<loc>'.site_url().'/sitemap-misc.xml</loc>
	</sitemap>';

$page = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$query = mysqli_query($GLOBALS["___mysqli_ston"], "select title from posts LIMIT $mulai, $halaman");
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select title from posts");
$total = mysqli_num_rows($sql);
$pages = ceil($total/$halaman); 

for ($i=1; $i<=$pages ; $i++){
 echo'	
	<sitemap>
		<loc>'.site_url().'/posts/'.$i.'.xml</loc>
	</sitemap>' . "\n";
 
}
echo '</sitemapindex>';

}
?>