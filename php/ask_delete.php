<html>
<head>
<style type="text/css">
.text_verdana { FONT-SIZE: 11px; FONT-STYLE: normal; FONT-FAMILY: Verdana; TEXT-DECORATION: none}
A { COLOR: #454545; TEXT-DECORATION: none}
form {margin-bottom:0px}
</style>
</head>
<body topmargin=0 marginwidth=0 marginheight=0 bgcolor=#E1E1E1 class=text_verdana>
<br>
<center><b>Вы действительно хотите удалить страницу?<b><br><br>
 <table border=0 cellspacing=0 cellpadding=0 class=text_verdana>
 <tr>
 <td width=90>
  <form method="post" action="<?php echo("edit_page.php?r_id=$r_id&dir=$dir&delete_page=1");?>">
  <input type="Submit" name="submit_page" value="&nbsp;&nbsp;&nbsp;Да&nbsp;&nbsp;&nbsp;" class=text_verdana size=30>
  </form>
 </td>

 <td width=90>
  <form method="post" action="<?php echo("edit_page.php?edit_type=$edit_type&r_id=$r_id&dir=$dir");?>">
  <input type="Submit" name="submit_page" value="&nbsp;&nbsp;&nbsp;Нет&nbsp;&nbsp;&nbsp;" class=text_verdana>
  </form>
 </td>
 </tr>
 </table>
</center>
</body>
</html>
