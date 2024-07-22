<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');

$querySetup = mysqli_query($GLOBALS["___mysqli_ston"], 'select set_name, value from setting');
$set = array();
while($setup=mysqli_fetch_assoc($querySetup)) $set[$setup['set_name']] = $setup['value'];
((mysqli_free_result($querySetup) || (is_object($querySetup) && (get_class($querySetup) == "mysqli_result"))) ? true : false);

function update($set_name,$value){
mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE setting SET value='$value' WHERE set_name='$set_name'");
return TRUE;
}

function input($text){
return trim(addslashes($text));
}

function insert($name){
$qr = mysqli_query($GLOBALS["___mysqli_ston"], "select max(id) from $name");
$max = mysqli_fetch_array($qr);
return $max['max(id)']+1;
((mysqli_free_result($qr) || (is_object($qr) && (get_class($qr) == "mysqli_result"))) ? true : false);
}

function formget($val){
$val2=$_GET["$val"];
$get=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], addslashes(htmlspecialchars($val2)));
return $get;
}

function formpost($val1){
$val3=$_POST["$val1"];
$post=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], addslashes(htmlspecialchars($val3)));
return $post;
}

function dump_error($erro){
foreach($erro as $errr){
echo ''.$errr.'';
}
}

function users($udataname){
$uemail=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_SESSION['email']);
$udata=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE email='$uemail'");
$ufdata=mysqli_fetch_array($udata);
return $ufdata["$udataname"];
}

$chssemail=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_SESSION['email']);
$chsslog=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE email='$chssemail'");

if(mysqli_num_rows($chsslog)>0){
$dumlog=mysqli_fetch_array($chsslog);
if($dumlog["email"]==$chssemail){
$userlog=1;
}
else {
$userlog=0;
}
if($dumlog["rights"] == 2){
$adminlog=1;
}
else{
$adminlog=0;
}
}

$hal = '20';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$j = ($page-1)*$hal;

function paging($all,$page,$num,$url) { $total = ceil($all/$num);
if ($page != 1) $pervpage = ' <a class="paging" href= "'.$url.'page='. ($page - 1) .'">&#171; Previous</a> ';
if ($page != $total) $nextpage = ' <a class="paging" href="'.$url.'page='. ($page + 1) .'">Next &#187;</a>';
if ($page - 4 > 0) $first = '<a class="paging" href="'.$url.'page=1">1</a>...';
if ($page + 4 <= $total) $last = '...<a class="paging" href="'.$url.'page='.$total.'">'.$total.'</a>';
if($page - 2 > 0) $page2left = ' <a class="paging" href= "'.$url.'page='. ($page - 2) .'">'. ($page - 2) .'</a> ';
if($page - 1 > 0) $page1left = '<a class="paging" href= "'.$url.'page='. ($page - 1) .'">'. ($page - 1) .'</a> ';
if($page + 2 <= $total) $page2right = ' <a class="paging" href= "'.$url.'page='. ($page + 2) .'">'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = ' <a class="paging" href="'.$url.'page='. ($page + 1) .'">'. ($page + 1) .'</a>';
echo '<div class="board">'.$pervpage.$first.$page1left.' <div class="paging-active">'.$page.'</div> '.$page1right.$last.$nextpage.'</div>';
}

function fsize($size,$round=2){
	$sizes=array(' Byts',' KB',' MB',' GB',' TB');
	$total=count($sizes)-1;
		for($i=0;$size>1024 && $i<$total;$i++){
			$size/=1024;
		}
	return round($size,$round).$sizes[$i];
}

function fb($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'Year',
        'm' => 'Month',
        'w' => 'Week',
        'd' => 'Day',
        'h' => 'Hour',
        'i' => 'Minute',
        's' => 'Second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'Just now';
}
?>