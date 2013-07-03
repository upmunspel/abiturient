<?php

error_reporting(E_STRICT);

$connect_status = mysql_connect("10.1.10.26","edbo","eU7InIl","abiturient");
if (!$connect_status){
	echo "<center>
	<h1 style='color:red;font-size:18pt;font-family:Monotype Corsiva'>
	Немає зв'язку з сервером. 
	Зараз ви можете піти випити кофе або просто почекати. 
	Влаштовуйтесь позручніше.</h1></center>";
	exit();
}
mysql_query("USE `abiturient`");$QUERY_COUNT++;
mysql_query("SET NAMES utf8");$QUERY_COUNT++;
$query = "SELECT idSpeciality as `id`,MID(SpecialityClasifierCode,1,1) AS 'Code' FROM specialities WHERE ";
foreach ($_GET as $key=>$val){
	if ($key == 'date' || $key == "secname") continue;
	$value = $val;
	if ($key == 'SpecialitySpecializationName'){
		$value = urldecode($value);
	}
	$query .= $key."='".$value."' AND ";
	//echo $key." ==> ".$value."<br/>";
}
$query .= "1";
//echo $query."<br/>";
$res = mysql_query($query);
$row = mysql_fetch_assoc($res);
$Code = 1;
switch ($row['Code']){
	case '8': $Code = 2; break;
	case '7': $Code = 3; break;
	
}
//echo "http://10.1.11.57:8080/request_report-1.0/journal.jsp?SpecialityID=".$row['id']."&eduFormID=".$_GET['PersonEducationFormID']."&idOKR=".$Code."&Date=".$_GET['date']."&yt0=";
header("Location: http://10.1.11.57:8080/request_report-1.0/journal.jsp?secname=".$_GET['secname']."&SpecialityID=".$row['id']."&eduFormID=".$_GET['PersonEducationFormID']."&idOKR=".$Code."&Date=".$_GET['date']."&yt0=");


?>