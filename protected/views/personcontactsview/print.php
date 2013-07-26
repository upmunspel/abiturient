<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>Список абітурієнтів</title>
<style>
TD {
	font-size: 12pt;
	border: 1px solid black;
       
}

TABLE {
       border: 1px solid black;
}

TH {
	font-size: 14pt;
	border: 1px solid black;
        
}

H1 {
	font-size: 20pt;
        text-align: center;
}

</style>
</head>
<body>
    
<?php
error_reporting(E_STRICT);
$connect_status =  mysql_connect(/*"localhost","root","","abiturient"*/"10.1.103.26","edbo","eU7InIl","abiturient");
if (!$connect_status){
	echo "<center>
	<h1 style='color:red;font-size:18pt;font-family:Monotype Corsiva'>
	Немає зв'язку з сервером. 
	Зараз ви можете піти випити кофе або просто почекати. 
	Влаштовуйтесь позручніше.</h1></center>";
	exit();
}
mysql_query("USE `abiturient`");
mysql_query("SET NAMES utf8");
$idFac = $_GET['idFuc'];
$columncount = 0;

$query = "SELECT surname, name, fartherName, spec, edu, homephone, mobile, eb , city, region, cityVillage, sumBall, isCopy    
    FROM person_list
    WHERE idFacultet = $idFac AND status NOT IN(2,3,10) order by edu, spec, sumBall desc";
 


$res = mysql_query($query);
 echo "<H1>Контактна інформація абітурієнтів станом на ".date("d.m.Y")."</H1>";
 echo "<table align = center cellspacing = 0><tr style='font-weight:bold; text-align: center;'><td>№</td><td>ПІБ</td><td width=150px>Контакти</td><td>Адреса</td><td>Напрям</td><td>Сума балів</td><td>Ел. заява</td><td>Форма<br>навчання</td><td>Чи буде<br>надавати<br>документи</td></tr>";
 for($i=0; $i<mysql_num_rows($res); $i++){
     $rows[$i] = mysql_fetch_assoc($res);
     echo "<tr>
          <td>".++$columncount."</td>
          <td>".$rows[$i]['surname']." ".$rows[$i]['name']." ".$rows[$i]['fartherName']."</td>
          <td width=150px>"."моб.".$rows[$i]['mobile']."<br>дом.".$rows[$i]['homephone']."</td>
          <td style='font-size: 10px;'>".$rows[$i]['region'].(!empty($rows[$i]['cityVillage']) ? ", ".$rows[$i]['cityVillage']:"").(!empty($rows[$i]['city'])? ", ".$rows[$i]['city']: "")."</td>
          <td align='center' style='font-size: 10px;'>".$rows[$i]['spec']."</td>
          <td align='center' >".round($rows[$i]['sumBall'],1)."</td>
          <td align='center'>".$rows[$i]['eb']."</td>
          <td align='center'>".$rows[$i]['edu']."</td>
          <td>&nbsp</td></tr>";
 }
?>

</body>
</html>
<?php mysql_close(); ?>