<?php

class AGC {

  private function get_youtube_api() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
    $api_keys = $set['apikey'];
    if ( $api_keys ) {
      $exp_api_keys = explode( ',', $api_keys );
      shuffle( $exp_api_keys );
      return $exp_api_keys[0];
    }
  }
  
  public function get_itunes_top_songs() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
    $url = 'https://itunes.apple.com/id/rss/topsongs/limit=' . $set[ 'itunes_count' ] . '/xml';
    $curl = $this->curl( $url, 'https://www.apple.com' );

    if ( $curl['info']['http_code'] == 200 ) {
      $xml = str_replace( 'im:', '', $curl['data'] );
      $xml = json_decode( json_encode( simplexml_load_string( $xml ) ), true );

      if ( isset( $xml['entry'] ) ) {
        foreach ( $xml['entry'] as $item ) {
          $item['title2'] = str_replace(' - '.$item["artist"].'', '', $item["title"]);
		  $data['title'] = $item['artist'].' - '.$item['title2'];
          $data['artist'] = $item['artist'];
          $item['date2'] = str_replace( 'T', ' ', $item['releaseDate'] );
          $data['date'] = fb(str_replace( '-07:00', '', $item['date2'] ));
          $data['image'] = str_replace( '55x55bb', '160x160bb', $item['image'][0] );
          $items[] = $data;
        }
      }
    }

    return ( isset( $items ) ) ? $items : [];
  }

  public function get_itunes_new_releases() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
    $url = 'https://rss.itunes.apple.com/api/v1/us/apple-music/new-releases/all/' . $set[ 'itunes_count' ] . '/explicit.atom';
    $curl = $this->curl( $url, 'https://www.apple.com' );

    if ( $curl['info']['http_code'] == 200 ) {
      $xml = str_replace( 'im:', '', $curl['data'] );
      $xml = json_decode( json_encode( simplexml_load_string( $xml ) ), true );

      if ( isset( $xml['entry'] ) ) {
        foreach ( $xml['entry'] as $item ) {
          $item['title2'] = str_replace(' - '.$item["artist"].'', '', $item["title"]);
		  $data['title'] = $item['artist'].' - '.$item['title2'];
          $data['artist'] = $item['artist'];
          $item['date2'] = str_replace( 'T', ' ', $item['releaseDate'] );
          $data['date'] = fb(str_replace( '-07:00', '', $item['date2'] ));
          $data['image'] = str_replace( '200x200bb', '160x160bb', $item['image'] );
          $items[] = $data;
        }
      }
    }

    return ( isset( $items ) ) ? $items : [];
  }

  public function get_youtube_top_videos() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
    $api_key = $this->get_youtube_api();
	
    $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&chart=mostPopular&regionCode=ID&maxResults=' . $set[ 'trend_count' ] . '&key=' . $api_key;
    $curl = $this->curl( $url, 'https://www.youtube.com' );

    if ( $curl['info']['http_code'] == 200 ) {
      $array = json_decode( $curl['data'], true );
      if ( isset( $array['items'] ) ) {
        foreach ( $array['items'] as $item ) {
          $data['id'] = $item['id'];
          $data['title'] = strip_tags($item['snippet']['title']);
          $data['channel'] = $item['snippet']['channelTitle'];
          $data['date'] = fb($item['snippet']['publishedAt']);
          $data['image'] = $item['snippet']['thumbnails']['medium']['url'];
          $items[] = $data;
        }
      }
    }

    return ( isset( $items ) ) ? $items : [];
  }
  
  public function get_youtube_trend_music () {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
    $api_key = $this->get_youtube_api();
	
    $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=PLFgquLnL59alQ4PrI-9tZyl0Z8Bqp-RE7&maxResults=' . $set[ 'trend_count' ] . '&key=' . $api_key;
    $curl = $this->curl( $url, 'https://www.youtube.com' );

    if ( $curl['info']['http_code'] == 200 ) {
      $array = json_decode( $curl['data'], true );
      if ( isset( $array['items'] ) ) {
        foreach ( $array['items'] as $item ) {
          $data['id'] = $item['snippet']['resourceId']['videoId'];
          $item['title2'] = strip_tags($item['snippet']['title']);
          $item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
          $item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
          $item['title2'] = str_replace( ' Official', '', $item['title2'] );
          $item['title2'] = str_replace( ' Music', '', $item['title2'] );
          $item['title2'] = str_replace( ' Video', '', $item['title2'] );
          $data['title'] = str_replace( '||', '', $item['title2'] );
          $data['channel'] = $item['snippet']['channelTitle'];
          $data['date'] = fb($this->convert_youtube_date($item['snippet']['publishedAt']));
          $data['image'] = $item['snippet']['thumbnails']['medium']['url'];
		  $items[] = $data;
        }
      }
    }

    return ( isset( $items ) ) ? $items : [];
  }

  public function get_search() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
    $q = urlencode( get_search_query() );
		
    $items = [];

    $youtube__api_key = $this->get_youtube_api();

    if ( $youtube__api_key ) {
      $youtube__url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&videoType=any&maxResults=' . $set[ 'search_count' ] . '&q=' . $q . '&key=' . $youtube__api_key;
      $youtube__curl = $this->curl( $youtube__url, 'https://www.youtube.com' );

      if ( $youtube__curl['info']['http_code'] == 200 ) {
        $youtube__array = json_decode( $youtube__curl['data'], true );
        if ( isset( $youtube__array['items'] ) ) {
          foreach ( $youtube__array['items'] as $item ) {
            $data['id'] = $item['id']['videoId'];
            $data['title'] = strip_tags($item['snippet']['title']);
            $data['desc'] = strip_tags($item['snippet']['description']);
            $data['date'] = fb($this->convert_youtube_date($item['snippet']['publishedAt']));
            $data['channel'] = $item['snippet']['channelTitle'];
            $data['image'] = $item['snippet']['thumbnails']['medium']['url'];
            $items[] = $data;
          } unset( $item, $data );
        }
      }
    }
	
    return ( isset( $items ) ) ? $items : [];
  }

  public function get_download() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
    global $route;

    $slug = $route['vars'][0];
    $id = $route['vars'][1];
	$decode_id = base64_url_decode( $id );
    $exp_decode_id = explode( '--', $decode_id );
	
      if ( count( $exp_decode_id ) == 2 ) {
        $id = $exp_decode_id[1];
          $youtube__api_key = $this->get_youtube_api();
          if ( $youtube__api_key ) {
            $youtube__url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics&id=' . $id . '&key=' . $youtube__api_key;
            $youtube__curl = $this->curl( $youtube__url, 'https://www.youtube.com' );

            if ( $youtube__curl['info']['http_code'] == 200 ) {
              $youtube__array = json_decode( $youtube__curl['data'], true );
              if ( isset( $youtube__array['items'][0]['snippet'] ) && isset( $youtube__array['items'][0]['contentDetails'] ) && isset( $youtube__array['items'][0]['statistics'] ) ) {
                $snippet = $youtube__array['items'][0]['snippet'];
                $content_details = $youtube__array['items'][0]['contentDetails'];
                $stats = $youtube__array['items'][0]['statistics'];

                $data['id'] = $id;
                $data['title'] = strip_tags($snippet['title']);
                $data['channel'] = $snippet['channelTitle'];
                $data['desc'] = str_replace(urldecode('%0A'), '<br/>', strip_tags($snippet['description']));
                $data['date'] = fb($this->convert_youtube_date($snippet['publishedAt']));
                $data['duration'] = $this->format_time($content_details['duration']);
                $data['view'] = number_format( $stats['viewCount'] );
                $data['like'] = number_format( $stats['likeCount'] );
                $data['dislike'] = number_format( $stats['dislikeCount'] );
                $data['image'] = 'http://img.youtube.com/vi/' . $id . '/mqdefault.jpg';

                $exp_duration = explode( ':', $data['duration'] );
                if ( count( $exp_duration ) == 2 ) {
                  $parsed = date_parse( '00:' . $data['duration'] );
                  $seconds = ( $parsed['minute'] * 60 ) + $parsed['second'];
                } else {
                  $parsed = date_parse( $data['duration'] );
                  $seconds = ( $parsed['hour'] * 60 * 60 ) + ( $parsed['minute'] * 60 ) + $parsed['second'];
                }

                $data['size'] = $this->get_format_bytes( ( $seconds * ( 128 / 8 ) * 1000 ) );
              }
            }
        }
      }
	  
    return ( isset( $data ) ) ? $data : [];
  }

  public function get_file() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
    global $route;

    $id = $route['vars'][0];
	$path2 = '././data/mp3/'.$id.'.mp3';
	$size = filesize($path2);     
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE id='$id'");
	
	if(mysqli_num_rows($sql) > 0 ){
		
	  $views=mysqli_fetch_array($sql);
	  $data['id'] = $views['id'];
	  $data['title'] = strip_tags($views['title']);
	  $data['artist'] = $views['artist'];
	  $data['album'] = $views['album'];
	  $data['genre'] = $views['genre'];
	  $data['rilis'] = $views['rilis'];
	  $data['time'] = $views['time'];
	  $data['yt'] = $views['yt'];
	  $data['lyric'] = $views['lyric'];
	  $data['listen'] = number_format($views['listen']);
	  $data['size'] = $size;
	  $data['cover'] = $views['cover'];
	  
	  if (file_exists('././data/cover/'.$views['id'].'.jpg')) {
		$data['image'] = '/data/cover/'.$views['id'].'.jpg';
	  }else{
		$data['image'] = '/assets/images/cover.jpg';
	  }

	return ( isset( $data ) ) ? $data : [];
	
	}else{
		header('location: /error.php');
	}
  }
  
  public function get_related() {
	
    global $route;

    $slug = $route['vars'][0];
    $id = $route['vars'][1];

      $decode_id = base64_url_decode( $id );
      $exp_decode_id = explode( '--', $decode_id );

      if ( count( $exp_decode_id ) == 2 ) {
        $id = $exp_decode_id[1];
        $youtube__api_key = $this->get_youtube_api();
		$items = [];
		
          if ( $youtube__api_key ) {
            $youtube__url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=7&relatedToVideoId=' . $id . '&key=' . $youtube__api_key;
            $youtube__curl = $this->curl( $youtube__url, 'https://www.youtube.com' );

			if ( $youtube__curl['info']['http_code'] == 200 ) {
			  $youtube__array = json_decode( $youtube__curl['data'], true );
			  if ( isset( $youtube__array['items'] ) ) {
				foreach ( $youtube__array['items'] as $item ) {
				  $data['id'] = $item['id']['videoId'];
				  $data['title'] = strip_tags($item['snippet']['title']);
				  $data['desc'] = $item['snippet']['description'];
				  $data['date'] = fb($this->convert_youtube_date($item['snippet']['publishedAt']));
				  $data['channel'] = $item['snippet']['channelTitle'];
				  $data['image'] = $item['snippet']['thumbnails']['medium']['url'];
				  $items[] = $data;
				} unset( $item, $data );
			  }
			}
		  }
      }

    return ( isset( $items ) ) ? $items : [];
  }

  private function curl( $url, $referer = '' ) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $ua = new UA;
    $ch = curl_init();

  	curl_setopt( $ch, CURLOPT_URL, $url );
  	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_ENCODING, "gzip,deflate" );
    curl_setopt( $ch, CURLOPT_USERAGENT, $ua->get_ua() );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
  	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, TRUE );

    if ( $referer ) {
      curl_setopt( $ch, CURLOPT_REFERER, $referer );
    }

    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
  	curl_setopt( $ch, CURLOPT_HTTPHEADER, [ "Accept-Language: en-US;q=0.6,en;q=0.4", "REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip" ] );

    $data = curl_exec( $ch );
  	$info = curl_getinfo( $ch );

  	curl_close( $ch );

  	return [ 'info' => $info, 'data' => $data ];
  }

  private function convert_youtube_time( $time ){
    $start = new DateTime( '@0' );
    $start->add( new DateInterval( $time ) );
    return $start->format( 'i:s' );
  }
  
  private function convert_youtube_date($date){
	$date = substr($date,0,10);
	$date = explode('-',$date);
	$mn = date('F',mktime(0,0,0,$date[1]));
	$dates=''.$date[2].' '.$mn.' '.$date[0].'';
	return $dates;
  }
  private function format_time($t) {
	$sam = str_replace('PT','',$t);
	$sam = str_replace('H',':',$sam);
	$sam = str_replace('M',':',$sam);
	$sam = str_replace('S','',$sam);
	return $sam;
  }

  private function get_format_bytes( $bytes, $precision = 2 ) {
  	$units = [ 'B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB' ];
  	$bytes = max( $bytes, 0);
  	$pow = floor( ( $bytes ? log( $bytes ) : 0) / log( 1024 ) );
  	$pow = min( $pow, count( $units ) - 1 );
  	$bytes /= pow( 1024, $pow );
  	return round( $bytes, $precision ) . '' . $units[$pow];
  }
	
  public function get_pages() {
	global $route;
	$pages = $route['vars'][0];
	
	$epage=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pages WHERE url='$pages'");
	$page=mysqli_fetch_array($epage);
	
	$errors=array();
	$page_check=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pages WHERE url='$pages'");
	if(mysqli_num_rows($page_check)<1){
	  $errors[]= header("Location: /error.php");
	}
	
	if(empty($errors)){
	  $data['id'] = $page['id'];
	  $data['url'] = $page['url'];
	  $data['title'] = $page['title'];
	  $data['text'] = $page['text'];
	}else{
	  foreach($errors as $error){
		 echo $error;
	  }
	}
	return ( isset( $data ) ) ? $data : [];
  }
  
  public function pages_search() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
	$q = get_search_query();
	$uplud = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * 
                  FROM pages 
                  WHERE MATCH ( title ) 
                  AGAINST ('".$q."' IN BOOLEAN MODE) ORDER BY id DESC LIMIT " . $set[ 'post_count' ] . ";");
	
	if(mysqli_num_rows($uplud) > 0 ){
		
	$identitas = array();
	while($row =mysqli_fetch_assoc($uplud))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;
  
	if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$items[] = $item;
  		}
    }

	return ( isset( $items ) ) ? $items : [];
	}
  }
  
  public function upload_search() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
	$q2 = get_search_query();
	
	if (strlen($q2) == 3){
	$q = $q2;
	$uplud = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where title LIKE '%".$q."%' OR artist LIKE '%".$q."%' ORDER BY id DESC LIMIT " . $set[ 'post_count' ] . ";");
	
	}else{
	$q3 = str_replace(' ', ' +', $q2);
	$q = '+'.$q3;
	$uplud = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * 
                  FROM posts 
                  WHERE MATCH ( artist,title ) 
                  AGAINST ('".$q."' IN BOOLEAN MODE) ORDER BY id DESC LIMIT " . $set[ 'post_count' ] . ";");
	}
	
	if(mysqli_num_rows($uplud) > 0 ){
		
	$identitas = array();
	while($row =mysqli_fetch_assoc($uplud))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;
  
	if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$items[] = $item;
  		}
    }

	return ( isset( $items ) ) ? $items : [];
	}
  }

  public function recent_upload() {
	$uplud = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts ORDER BY id DESC LIMIT 5;");
	
	if(mysqli_num_rows($uplud) > 0 ){
		
	$identitas = array();
	while($row =mysqli_fetch_assoc($uplud))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;
  
	if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$items[] = $item;
  		}
    }

	return ( isset( $items ) ) ? $items : [];
	}
  }

  public function top_download() {
	$uplud = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts ORDER BY listen DESC LIMIT 5;");
	
	if(mysqli_num_rows($uplud) > 0 ){
		
	$identitas = array();
	while($row =mysqli_fetch_assoc($uplud))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;
  
	if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$items[] = $item;
  		}
    }

	return ( isset( $items ) ) ? $items : [];
	}
  }
  
  public function all_posts() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);

	$halaman = $set[ 'new_post_count' ];
	$pageku = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$jumlah = ($pageku-1)*$halaman;
	$uplud = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts ORDER BY id DESC LIMIT ".$jumlah.",$halaman");
	
	if(mysqli_num_rows($uplud) > 0 ){
		
	$identitas = array();
	while($row =mysqli_fetch_assoc($uplud))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;
  
	if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$items[] = $item;

  		}
    }

	return ( isset( $items ) ) ? $items : [];
	}
  }
  
  public function artist_search() {
	$q2 = get_search_query();
	if (strlen($q2) == 3){
	$q = $q2;
	$artist = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM artists where name LIKE '%".$q."%' LIMIT 1;");
	
	}else{
	$q3 = str_replace(' ', ' +', $q2);
	$q = '+'.$q3;
	$artist = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * 
                  FROM artists 
                  WHERE MATCH ( name ) 
                  AGAINST ('".$q."' IN BOOLEAN MODE) LIMIT 1;");
	}
	
	if(mysqli_num_rows($artist) > 0 ){
		
	$identitas = array();
	while($row =mysqli_fetch_assoc($artist))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;
  
	if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$items[] = $item;
  		}
    }

	return ( isset( $items ) ) ? $items : [];
	}
  }
  
  public function get_recent_search() {
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT keyword FROM keywords ORDER BY id DESC LIMIT 10");
	$identitas = array();
	while($row =mysqli_fetch_assoc($sql))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;

	  if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$output[] = $item;
  		}
    }

  return ( isset( $output ) ) ? $output : [];
  }
  
  public function artist() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
	$halaman = $set[ 'artist_count' ];
	$pageku = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$jumlah = ($pageku-1)*$halaman;
	$q = get_search_query();
	
	$artistku = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where artist = '$q' ORDER BY id DESC LIMIT  ".$jumlah.",$halaman");
	if(mysqli_num_rows($artistku) > 0 ){
		
	$identitas = array();
	while($row =mysqli_fetch_assoc($artistku))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;
  
	if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$items[] = $item;
  		}
    }

	return ( isset( $items ) ) ? $items : [];
	}
  }
  
  public function genre() {
	$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
	$set = array();
	while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
	((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);
	
	$halaman = $set[ 'genre_count' ];
	$pageku = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$jumlah = ($pageku-1)*$halaman;
	$q = get_search_query();
	
	$genreku = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where genre = '$q' ORDER BY id DESC LIMIT  ".$jumlah.",$halaman");
	if(mysqli_num_rows($genreku) > 0 ){
		
	$identitas = array();
	while($row =mysqli_fetch_assoc($genreku))
	{
		$identitas[] = $row;
	}
		$get_data = $identitas;
  
	if ( isset($get_data) ) {
      foreach( $get_data as $item ) {

  			$items[] = $item;
  		}
    }

	return ( isset( $items ) ) ? $items : [];
	}
  }
}

function agc() {
  return new AGC;
}
