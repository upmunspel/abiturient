<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Формування актів - крок 2</title>
  <link rel="stylesheet" type="text/css" href="styles.css" />
 </head>
 <body>
	<?php 
	$fac = $_POST['facultet'];
	$spec = $_POST['spec'];
	$connection = mysql_connect('10.1.10.26','root','ehHYAuj');
	mysql_query("use abiturient");
	mysql_query("set names utf8");
	mysql_query("UPDATE parametersquery SET value='".$fac."' WHERE code=16");
	mysql_query("UPDATE parametersquery SET value='".$spec."' WHERE code=17");
	echo "<a href=\"http://10.1.11.57:8080/request_report-1.0/decanat.jsp?Speciality=$spec&Fac=$fac&iframe=true&width=1024&height=600\">Сформувати PDF</a>";
	mysql_close();
	?>
 </body>
</html>