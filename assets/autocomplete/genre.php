<?php
require '../../includes/db.php';
//mendapatkan input pencarian
$term = trim(strip_tags($_GET['term']));
 
$qstring = "SELECT name FROM genres WHERE name LIKE '%".$term."%'";
//query database untuk mengecek tabel Country 
$result = mysqli_query($GLOBALS["___mysqli_ston"], $qstring);
 
while ($row = mysqli_fetch_array($result))
{
    $row['value']=htmlentities(stripslashes($row['name']));
//buat array yang nantinya akan di konversi ke json
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>
