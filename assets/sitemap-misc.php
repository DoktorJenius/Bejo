<?php
require '../core/functions/general.php';
header( "Content-Type: application/xml" );
?>
<?php echo'<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.site_url().'/assets/sitemap.xsl"?>'; ?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">	<url>
		<loc><?php echo site_url(); ?></loc>
		<changefreq>daily</changefreq>
		<priority>1.0</priority>
	</url>
</urlset>