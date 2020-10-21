<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; />
<title>
</title>
<body>

<SCRIPT LANGUAGE="JavaScript">
function closeit(fm,file) {
 parent.tex(fm,file);
 parent.close();	
}
</SCRIPT>
<STYLE>
a {color:black;
   text-decoration:none;
    padding:5px;
FONT-FAMILY: Arial;
}
a:hover {
   background:black;
   color:white;
   text-decoration:none;
    padding:5px;
   FONT-FAMILY: Arial;
}
</STYLE>


<?
echo "<b><div style='padding-left:20px'>Âûáåðèòå êàðòèíêó:</div></b><br>";

 $dh = opendir("/home/vir/paloma/$record_path/");
 $file= readdir($dh);
print"<table  border='0' cellspacing='0' cellpadding='0' 
 width='100%' class='adminpanel'><div>\n";
  $x=0;
 while (false !==($file = readdir($dh))) {
  $dir1=$file;

   if (!is_dir($dir1)) {


    if (substr($dir1,-3,3)=='gif' || 
        substr($dir1,-3,3)=='jpg' || substr($dir1,-3,3)=='JPG') {   

    if ($x==0) {print"<tr>\n";}
    $x++;
print <<< myeof
     <td><a class='filebrowser' href="" 
       onClick=window.closeit('$fm','$dir1');
        onMouseOver=top.mainFrame.logo.src="$record_path/$dir1";


>
     $dir1</a><br><br></td>
myeof;
    if ($x>3) {$x=0;print"</tr>\n";}

    }
   }
 }
 print"</table>\n";
 closedir($dh); 





?>

</body>
</html>
