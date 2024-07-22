<?php
$adslink = '#iklanLinkMu';
$id_en = base64_decode($_GET['get']);
$id = $id_en;
?>
<html><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="HandheldFriendly" content="True" />
<meta name="MobileOptimized" content="320" />
<title>Generate Link</title>
<meta name="robots" content="noindex,follow,noodp" />
<style>
body {
background: #eee;
font-size: 16px;
font-style: normal;
color: #222;
margin: auto;}
.nganu {
    border: 1px solid #ddd;
    background: #fff;
    max-width: 860px;
    margin: 5px auto 10px auto;
    width: 100%;
}
iframe {border-radius:25px;}
.download-iklan {
    background-color: #00aaff;
    color: #ffffff;
    margin-bottom: 10%;
}

.download-asli {
    background-color: #fff;
    color: #00aaff;
    margin-bottom: 10%;
    border: 1px solid #00aaff;
}
.download-asli, .download-iklan {
    font-family: roboto,arial,Arial;
    cursor: pointer;
    text-align: center;
    display: inline-block;
    width: 80%;
    max-width: 280px;
    height: 40px;
    border-radius: 25px;
    margin-bottom: 20px;
    line-height: 40px;

}
.list{border-bottom:1px solid #eee;padding:8px 0;font-size:12px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.logo {padding:14px;text-align: center;}
#myDIV, #myDIV2 {display:none;}
a {text-decoration:none;}
</style>
</head><body>
<script type="text/javascript">
function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "block";
    }
}
function myFunction2() {
    var x = document.getElementById("myDIV2");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "block";
    }
}
</script>
<div class="nganu"><div class="logo">
<a href="/" title="Generate Link Lagu"><img src="/themes/planetlagu/images/planetkicau.png"></a><br>
</div>
<center>
    <p><font color="black"><span style="color:red">⚠</span> Jika muncul iklan, abaikan dan kembali kehalaman ini!<br />
<span style="color:red">⚠</span> klik tombol download 2x / 3x, jika muncul iklan</font></p>
<a class="download-iklan" href="<?php echo $adslink; ?>">Download Now</a>
<br>
<?php if($_GET['go']=='mp3'){ ?>
<a class="download-asli" onclick="myFunction()">Download MP3</a>
<div id="myDIV">
<p style="text-align:center;font-size:14px;font-style:italic;color:red;font-weight:bold;">&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;<br>LINK UTAMA<br><br />
<iframe sandbox="allow-scripts allow-pointer-lock allow-same-origin allow-forms" src="https://musicyt.click/mp3ori.php/?id=<?php echo $id; ?>" FRAMEBORDER="0" MARGINWIDTH="0" MARGINHEIGHT="0" SCROLLING="no" WIDTH="300" HEIGHT="80" sandbox="allow-scripts allow-pointer-lock allow-same-origin allow-forms"></iframe>
<br><br />&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;</p><br>
<p style="text-align:center;font-size:14px;font-style:italic;color:red;font-weight:bold;">&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;<br>LINK ALTERNATIF<br><br />
<iframe id="buttonIframe" src="https://ytmp3to.com/api/button/mp3/<?php echo $id; ?>" width="100%" height=60%" allowtransparency="true" scrolling="no" style="border:none"></iframe>
<br><br />&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;</p><br>
<p style="text-align:center;font-size:14px;font-style:italic;color:red;font-weight:bold;">&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;<br>DOWNLOAD MP4<br><br />
<iframe id="buttonIframe" src="https://ytmp3to.com/api/button/videos/<?php echo $id; ?>" width="100%" height="60%" allowtransparency="true" scrolling="no" style="border:none"></iframe>
<br><br />&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;</p></p><br>
</div>
<?php }else{ header('Location: /'); } ?>
</center><br />
</div>
</body>
</html>