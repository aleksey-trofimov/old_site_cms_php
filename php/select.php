<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>
</title>

<SCRIPT LANGUAGE="JavaScript">
function tex(fm,file) {
 window.opener.myFileBrowserValueReturn('src',file);
}
</SCRIPT>


<?php
print'
<frameset rows="300,*"  framespacing="0" frameborder="NO" border="0" id="my">
  <frame src="selector.php?record_path='.$record_path.'" name="topFrame" scrolling="YES" noresize>
  <frame src="bottom.php" name="mainFrame" scrolling="NO" noresize>
</frameset>
';
?>

</body>
</html>