<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<style type="text/css">
body {	background: #E1E1E1; margin: 0px; margin-left: 4px; }
.text_verdana { FONT-SIZE: 9px; FONT-STYLE: normal; FONT-FAMILY: Verdana; TEXT-DECORATION: none}

#menu_title {		text-align: center;
			font-weight: bold;
			font-size: 11px;
			width: 100%;
			padding-bottom: 5px;
			padding-top: 5px;
}

/*Стили для отображения меню*/
#menu_content ul { margin: 0px; padding: 0px; width: 100%; list-style-type: none;}
#menu_content ul li { display: block; width: 95%; font-size:7pt; font-weight:bold; margin: 0px; padding: 0px; TEXT-DECORATION: none;}
#menu_content ul li ul li { display: block; width: 95%; font-size:7pt; font-weight:bold; padding-bottom: 2px; padding-left: 5px; TEXT-DECORATION: none;}
#menu_content ul li ul li ul li { display: block; width: 95%; font-size:7pt; font-weight:bold; padding-bottom: 2px; padding-left: 5px; TEXT-DECORATION: none;}
#menu_content ul li ul li ul li ul li { display: block; width: 95%; font-size:7pt; font-weight:normal; padding-bottom: 2px; padding-left: 5px; TEXT-DECORATION: none;}

/*Раскрашиваем буковки */
ul li a { color: #990033; }
ul li ul li a { color: #6633cc; }
ul li ul li ul li a { color: #336600; }
ul li ul li ul li ul li a { color: #660066; }

#menu_content a.item_opener {
		text-decoration: none;
		width: 10px;
/*		float:left;*/
		display: inline;
    }


#menu_content a.item_text { /*	float:left;*/
				text-decoration: none;
				width: 93%; }

#menu_content a:hover.item_text { /*	float:left;*/
					text-decoration: none;
					background-color: #cccccc;
					width: 93%; }

#menu_content a.new_item_text { /*	float:left;*/
					text-decoration: none;
					width: 93%; }


#menu_content a:hover.new_item_text { /*	float:left;*/
					text-decoration: none;
					background-color: #cccccc;
					width: 93%; }


#menu_content a.item_end { float: none; text-decoration: none; width: 0%;  }

</style>

</head>
<body class="text_verdana">
<?php
include"config.php";

/*Открываем-закрываем раздел меню.*/
if($invert)
{
 //Инвертируем флаг открытого/закрытого меню
 $db = mysql_connect("localhost", " ", " ");;
 mysql_select_db("paloma",$db);

 $result = mysql_query("SELECT php_menu_status FROM records WHERE id=$r_id ORDER BY id",$db);
 $myrow  = mysql_fetch_array($result);

 $menu_status = !$myrow["php_menu_status"] + 0;


 $result = mysql_query("UPDATE records SET php_menu_status='$menu_status' WHERE id=$r_id");
mysql_close($db);
}
?>
<div id="menu_title">Меню</div>
<div id="menu_content">
<?php
//Шлепаем пункты меню
 $db = mysql_connect("localhost", " ", " ");;
 mysql_select_db("paloma",$db);


$interface_path = dirname(__FILE__);
$base_path = dirname($interface_path);

show_dir_list($base_path, 0);

mysql_close($db);
?>
</div>
<!--<a href="show_subscribers.php" target="page"><br>Показать подписчиков</a>-->

<center>
<br/>
<a href="menu.php"><font size="3">Обновить</font></a>
</center>
</body>
</html>



<?php
//#####################################   FUNCTION BEGIN    ##########################################
function show_dir_list($base_path, $parent)
{
 global $db; 

 $order_by = "PRIORITY";
 if($parent == 0)
  $order_by = "PRIORITY";

 $result_for_level = mysql_query("SELECT id, parent_id, is_container, php_menu_status, php_menu_name FROM records WHERE parent_id=$parent ORDER BY $order_by",$db);

 if( mysql_num_rows($result_for_level) )
  echo("<ul>\n");

 while ( $row_for_level = mysql_fetch_array($result_for_level) )
 {
  //Рисуем начало пункта списка
  $row_id = $row_for_level["id"];
  $menu_name = $row_for_level["php_menu_name"];
  $is_container = $row_for_level["is_container"];


  if( $row_for_level["php_menu_status"] )
  {
   //Пункт открыт в меню, рисуем его.
   echo("<li><a href=\"?r_id=$row_id&invert=1\" class=\"item_opener\"><img src=\"img/minus.gif\" border=\"0\" align=\"left\"/></a><a href=\"edit_page.php?edit_type=1&r_id=$row_id&dir=$base_path&lang=ru\" class=\"item_text\" target=\"page\">$menu_name</a><a href=\"#\" class=\"item_end\">&nbsp;</a>\n");

   //Далее нужно отобразить потомков этого пункта. Вызываем эту же функцию рекурсивно.
   show_dir_list($base_path, $row_id);

  }
  else
  {
   //Пункт закрыт в меню, рисуем кому надо плюсики

   if( $is_container )
    echo("<li><a href=\"?r_id=$row_id&invert=1\" class=\"item_opener\"><img src=\"img/plus.gif\" border=\"0\" align=\"left\"/></a><a href=\"edit_page.php?edit_type=1&r_id=$row_id&dir=$base_path&lang=ru\" class=\"item_text\" target=\"page\">$menu_name</a><a href=\"#\" class=\"item_end\">&nbsp;</a></li>\n");

   else
    echo("<li><a href=\"#\" class=\"item_opener\">&nbsp;</a><a href=\"edit_page.php?edit_type=1&r_id=$row_id&dir=$base_path&lang=ru\" class=\"item_text\" target=\"page\">$menu_name</a><a href=\"#\" class=\"item_end\">&nbsp;</a></li>\n");  
  }
 }
//Отображаем ссылки на создание новых страниц

    echo("<li><a href=\"#\" class=\"item_opener\"></a><a href=\"new_page.php?dir=$base_path&parent=$parent&level=$row_level\" target=\"page\" class=\"new_item_text\"><b>Новая страница</b></a><a href=\"#\" class=\"item_end\">&nbsp;</a></li>\n");  

 if( mysql_num_rows($result_for_level) )
  echo("</ul></li>");
}
?>
