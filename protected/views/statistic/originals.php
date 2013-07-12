<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>Статистика по спеціальностям</title>
<style>
TD {
	font-size: 14pt;
	border: 1px solid black;
       
}

TH {
	font-size: 14pt;
	border: 1px solid black;
        
}

H1 {
	font-size: 20pt;
}

A {
	text-decoration: none;
	color: black;
}

</style>
</head>
<body>
<?php
error_reporting(E_STRICT);
$connect_status = mysql_connect("10.1.103.26","edbo","eU7InIl","abiturient");
if (!$connect_status){
	echo "<center>
	<h1 style='color:red;font-size:18pt;font-family:Monotype Corsiva'>
	Немає зв'язку з сервером. 
	Зараз ви можете піти випити кофе або просто почекати. 
	Влаштовуйтесь позручніше.</h1></center>";
	exit();
}

$QUERY_COUNT = 0;

mysql_query("USE `abiturient`");$QUERY_COUNT++;
mysql_query("SET NAMES utf8");$QUERY_COUNT++;

//текущий день(число)
$cday = date("d");
//парсинг даты в формат гггг-мм-дд
$date_begin = "'".$_GET['date_begin']."'";
$date_end = "'".$_GET['date_end']."'";
//$date_begin = "'".date("Y-m-d")."'";
//$date_end = "'".date("Y-m-d")."'";


	if (preg_match("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/",$_GET['date_begin'])){
		$cday = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$1",$_GET['date_begin']);
		$date_begin = "'".preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$3-$2-$1",$_GET['date_begin'])."'";
	} else {
		$date_begin = "'".mysql_real_escape_string($_GET['date_begin'])."'";
		$mcday = explode("-",$_GET['date_begin']);
		$cday = $mcday[2]; //выделение числа из пришедшей даты
	}



	if (preg_match("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/",$_GET['date_end'])){
		$cday = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$1",$_GET['date_end']);
		$date_end = "'".preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$3-$2-$1",$_GET['date_end'])."'";
	} else {
		$date_end = "'".mysql_real_escape_string($_GET['date_end'])."'";
		$mcday = explode("-",$_GET['date_end']);
		$cday = $mcday[2]; //выделение числа из пришедшей даты
	}

//----------------------------------------------
$OKR = 6; //по умолчанию - бакалавр
if (isset($_GET['okr']) && is_numeric($_GET['okr'])){
	$OKR = $_GET['okr']; //если есть параметр ОКР - присваиваем это значение
}

$spec_name = "SpecialityName";
if ($OKR == 6) {
	$spec_name = "SpecialityDirectionName";
	
}
else{
    $spec_name = "SpecialityName";
}

//----------------------------------------------
$query = "SELECT Distinct
if(specialities.SpecialitySpecializationName = \"\",specialities.$spec_name,specialities.SpecialitySpecializationName) AS direction,
specialities.SpecialityClasifierCode As cCode,
specialities.idSpeciality As idSpec 
FROM  specialities
WHERE specialities.PersonEducationFormID = 1 and MID(specialities.SpecialityClasifierCode,1,1) =".$OKR."";

$query1 = "SELECT DISTINCT 
if(specialities.SpecialitySpecializationName = \"\",specialities.$spec_name,specialities.SpecialitySpecializationName) AS direction,
specialities.SpecialityClasifierCode As cCode,
specialities.idSpeciality As idSpec 
FROM  specialities
WHERE specialities.PersonEducationFormID = 2 AND  MID(specialities.SpecialityClasifierCode,1,1) =".$OKR."";

$res = mysql_query($query);
$res1 = mysql_query($query1);
$allsum = $sum = array();
echo "<table align=center cellspacing=0>";
?>

<center>
<h1>
Статистика надання оригіналів<br/>
Освітньо-кваліфікаційний рівень "<?php
switch ($OKR) {
case 6: echo "Бакалавр";break;
case 7: echo "Спеціаліст";break;
case 8: echo "Магістр";break;
}
?>" 
</h1>

<?php 
$counter = 1;
echo "<tr >"."<td>№"."</td>"."<td>"."Професійне спрямування"."</td>"."<td>"."Денна<br>кількість"."</td>"."<td>"."Оригінал"."</td>"."<td>"."Заоч.<br>кількість"."</td>"."<td>"."Оригінал."."</td>"."</tr>";
   for($i=0; $i<mysql_num_rows($res); $i++){
       $row[$i] = mysql_fetch_assoc($res);
 	$row1[$i] = mysql_fetch_assoc($res1);
	
       echo "<tr>";
       for($j = 0; $j<7; $j++){
           if ($row[$i]['direction'] == "екологія, охорона навколишнього середовища та збалансоване природокористування"){
                    $row[$i]['direction'] = "екологія, охорона навколишнього середовища<br> та збалансоване природокористування";
               
            }
           if($j==0) echo "<td>".$counter++."</td>";
           if($j==1) echo "<td>".$row[$i]['cCode']." ".$row[$i]['direction']."</td>";
           if($j==2){
               $idSpec = $row[$i]['idSpec'];
               $queryDay = "SELECT count(*) as countSpec
			   FROM `personspeciality`  WHERE personspeciality.StatusID<>3 AND personspeciality.EducationFormID = 1 and SepcialityID =".$idSpec."";
               $tmp = mysql_query($queryDay);
               $cur[$i] = mysql_fetch_assoc($tmp);
               $sum[$j] = $cur[$i]['countSpec'];
               $allsum[$j-2]+= $cur[$i]['countSpec'];
               echo "<td>".$cur[$i]['countSpec']."</td>";
           }
           if($j==3) {
              
               $idSpec = $row[$i]['idSpec'];
                $queryDay = "SELECT count(*) as countSpec
			   FROM `personspeciality`  WHERE personspeciality.StatusID<>3 AND personspeciality.iscopyentrantdoc = 0 and personspeciality.EducationFormID = 1 and SepcialityID =  ".$idSpec."";
               $tmp = mysql_query($queryDay);
               $cur[$i] = mysql_fetch_assoc($tmp);
               $sum[$j] = $cur[$i]['countSpec'];
               $allsum[$j-2]+= $cur[$i]['countSpec'];
               echo "<td>".$cur[$i]['countSpec']."</td>";
           }
           if($j==4){
              
               $idSpec = $row1[$i]['idSpec'];
		
                $queryDay = "SELECT count(*) as countSpec
			   FROM `personspeciality`  WHERE personspeciality.StatusID<>3 AND personspeciality.EducationFormID = 2 and SepcialityID =  ".$idSpec."";
               $tmp = mysql_query($queryDay);
               $cur[$i] = mysql_fetch_assoc($tmp);
               $sum[$j] = $cur[$i]['countSpec'];
               
               if($cur[$i]['countSpec']==null){
                   echo "<td>0</td>";
               }else{echo "<td>".$cur[$i]['countSpec']."</td>";}
               $allsum[$j-2]+= $cur[$i]['countSpec'];
           }
           if($j==5){
               $idSpec = $row1[$i]['idSpec'];
                $queryDay = "SELECT count(*) as countSpec
			   FROM `personspeciality`  WHERE personspeciality.StatusID<>3 AND personspeciality.iscopyentrantdoc = 0 
                           and personspeciality.EducationFormID = 2 and SepcialityID =  ".$idSpec."";
               $tmp = mysql_query($queryDay);
               $cur[$i] = mysql_fetch_assoc($tmp);
               $sum[$j] = $cur[$i]['countSpec'];
               $allsum[$j-2]+= $cur[$i]['countSpec'];
               if($cur[$i]['countSpec']==null){
                   echo "<td>0</td>";
               }else{
               echo "<td>".$cur[$i]['countSpec']."</td>";}
           }
          
       }
       
       echo "</tr>";
    }
    echo "<tr><td colspan=2>Всього:</td><td>".$allsum[0]."</td><td>".$allsum[1]."</td><td>".$allsum[2]."</td><td>".$allsum[3]."</td></tr>";
echo "</table>";

?>

</body>
</html>
<?php mysql_close(); ?>
