<?php if($userlog==1){ ?>
  </div>
<?php }else{ ?>
  <div id="bayu-ft" align="center">
	<span><a href="/pages/terms">Terms</a></span>
	<span><a href="/pages/privacy">Privacy Policy</a>
	</span><span><a href="/pages/contact">Contact</a></span>
  </div>
  <div id="bayu-footer">
	&copy; 2018 <a href="/"><?php echo $_SERVER["HTTP_HOST"]; ?></a>. Made with <i class="fa fa-heart" style="color:#C51162"></i> in Indonesia.
  </div>
<?php } ?>
<script>
var myVar;
function myFunction() {
myVar = setTimeout(showPage, 500);
}
function showPage() {
document.getElementById("loader").style.display = "none";
document.getElementById("myDiv").style.display = "block";
}
</script>
<script type='text/javascript'>
<!-- Publish By Xkomo-->
$("#nganu a.tutup,#nganu a.buka").click(function(e){
    e.preventDefault();
    if($(this).hasClass("buka"))
    {
    $(this).removeClass("buka");
    $(this).parent().children("ul").stop(true,true).slideUp("normal");
    } else {
    $("#nganu a.tutup.buka").removeClass("buka");
    $(this).addClass("buka");
    $(".sub").filter(":visible").slideUp("normal");
    $(this).parent().children("ul").stop(true,true).slideDown("normal");
    }
});
</script>
</body>
</html>
