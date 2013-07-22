<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>СТАТИСТИКА ВСТУПУ</title>
<style media="print">
TD {
	font-size: 7pt;
	border: 1px solid black;
}
TH {
	font-size: 10pt;
	border: 1px solid black;
}
H1 {
	font-size: 12pt;
}

A {
	text-decoration: none;
	color: black;
}
</style>
<style media="screen">
TD {
	font-size: 14pt;
	/* border: 1px solid black; */
        padding: 5px;
}
TH {
	font-size: 14pt;
	/* border: 1px solid black; */
        padding: 5px;
        
}
H1 {
	font-size: 16pt;
}


</style>
</head>
<body>
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

$QUERY_COUNT = 0;

mysql_query("USE `abiturient`");$QUERY_COUNT++;
mysql_query("SET NAMES utf8");$QUERY_COUNT++;


$cday = date("d");
$date = "'".date("Y-m-d")."'";
if (isset($_GET['date'])){
	if (preg_match("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/",$_GET['date'])){
		$cday = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$1",$_GET['date']);
		$date = "'".preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$3-$2-$1",$_GET['date'])."'";
	} else {
		$date = "'".mysql_real_escape_string($_GET['date'])."'";
		$mcday = explode("-",$_GET['date']);
		$cday = $mcday[2];
	}
}

$OKR = 6;
if (isset($_GET['okr']) && is_numeric($_GET['okr'])){
	$OKR = $_GET['okr'];
}

$spec_name = "SpecialityName";
if ($OKR == 6) {
	$spec_name = "SpecialityDirectionName";
}

$additional_count_condition = " personspeciality.StatusID NOT IN (10)";

$query = "select 
facultets.idFacultet,facultets.FacultetFullName, 
count(distinct specialities.SpecialityClasifierCode) as 'cnt' 
FROM facultets JOIN specialities 
ON facultets.idFacultet=specialities.FacultetID 
WHERE 
MID(specialities.SpecialityClasifierCode,1,1)='".$OKR."' 
GROUP BY specialities.FacultetID 
ORDER BY FacultetFullName;";

$query_specs = "select 
distinct specialities.SpecialityClasifierCode, 
CONCAT_WS(' ',specialities.SpecialityClasifierCode,specialities.".$spec_name.") AS `spec` 
from specialities 
WHERE FacultetID=__FacultetID__ AND 
MID(specialities.SpecialityClasifierCode,1,1)='".$OKR."';";

$query_counts = "select 

sum(specialities.PersonEducationFormID=1 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10)
AND __ADDITIONAL_CONDITION__) AS B_dnevn_per_day, 

sum(specialities.PersonEducationFormID=1 AND
personspeciality.CreateDate BETWEEN 
STR_TO_DATE('2013-07-01 00:00:00', '%Y-%m-%d %H:%i:%s') AND 
STR_TO_DATE('2013-12-21 23:59:59', '%Y-%m-%d %H:%i:%s') AND __ADDITIONAL_CONDITION__) AS B_dnevn_all,

sum(specialities.PersonEducationFormID=2 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10)
AND __ADDITIONAL_CONDITION__) AS B_zaoch_per_day,

sum(specialities.PersonEducationFormID=2 AND 
personspeciality.CreateDate BETWEEN 
STR_TO_DATE('2013-07-01 00:00:00', '%Y-%m-%d %H:%i:%s') AND 
STR_TO_DATE('2013-12-21 23:59:59', '%Y-%m-%d %H:%i:%s') AND __ADDITIONAL_CONDITION__) AS B_zaoch_all 

FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality 
WHERE specialities.SpecialityClasifierCode ='__CODE__' AND
specialities.FacultetID=__FacultetID__ ";

$query_counts = str_replace("__ADDITIONAL_CONDITION__",$additional_count_condition,$query_counts);


$query_specializationsCodes = "
SELECT DISTINCT  `SpecialityClasifierCode` 
FROM  `specialities` 
WHERE  `SpecialitySpecializationName` <>  \"\" AND FacultetID=__FacultetID__
";


$query_specializations ="
SELECT DISTINCT SpecialitySpecializationName AS `s_name` FROM `specialities` WHERE `SpecialityClasifierCode`='__CODE__' AND FacultetID = __FacultetID__;
";

$query_distinct_persons = "SELECT COUNT(DISTINCT PersonID) AS `cnt` 
    FROM personspeciality 
    JOIN specialities ON 
    personspeciality.SepcialityID=specialities.idSpeciality 
WHERE __WDATE__  AND MID(specialities.SpecialityClasifierCode,1,1) = '".$OKR."'
    AND __ADDITIONAL_CONDITION__";
$query_distinct_persons = str_replace("__ADDITIONAL_CONDITION__",$additional_count_condition,$query_distinct_persons);

if ($OKR == '7' || $OKR == '8'){
   $query_distinct_persons = str_replace(" = '".$OKR."'"," IN ('7','8')",$query_distinct_persons); 
}

$table = array();
$res = mysql_query($query);$QUERY_COUNT++;
$s = 0;
	$PEREVIRKA = 0;
	
for ($i = 0; $i < mysql_num_rows($res); $i++){
	$row[$i] = mysql_fetch_assoc($res);
	$rowspan = $row[$i]['cnt'];
	if ($row[$i]['FacultetFullName'] == "Соціальної педагогіки та психології"){
		$row[$i]['FacultetFullName'] = "Соціальної педагогіки <br/> та психології";
	}
	
	$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$query_specializationsCodes);
	$res_specializationsCodes = mysql_query($q);$QUERY_COUNT++;
	$facultet_count_specializations = 0;
	$count_specializations = 0;
	$facultet_count_specializations = mysql_num_rows($res_specializationsCodes);

	
	for ($j = 0; $j < $facultet_count_specializations; $j++){
		$t = mysql_fetch_assoc($res_specializationsCodes);
		$specializationsCodes[$t['SpecialityClasifierCode']] = $t['SpecialityClasifierCode'];
	}
	
	if ($facultet_count_specializations){
		$q = str_replace("`SpecialityClasifierCode`='__CODE__' AND","MID(`SpecialityClasifierCode`,1,1)='".$OKR."' AND",$query_specializations);
		$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$q);
		$rowspan = mysql_num_rows(mysql_query($q)) + mysql_num_rows(mysql_query("SELECT DISTINCT `SpecialityClasifierCode` AS `s_cc` FROM `specialities` WHERE SpecialitySpecializationName = '' AND FacultetID =".$row[$i]['FacultetID']));$QUERY_COUNT+=2;
	}
	$table[$s] = "<tr><td rowspan='".$rowspan."'><p title='".$row[$i]['idFacultet']."'>".$row[$i]['FacultetFullName']."</p></td>";
	
	
	$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$query_specs);
	$res_specs = mysql_query($q);$QUERY_COUNT++;

	$N = $row[$i]['cnt'];
	
	for ($j = 0; $j < $N; $j++){
		$spec = mysql_fetch_assoc($res_specs);
		if ($facultet_count_specializations){
			if (isset($specializationsCodes[$spec['SpecialityClasifierCode']])){
				$q = str_replace("__CODE__",$spec['SpecialityClasifierCode'],$query_specializations);
				$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$q);
				$res_specializations = mysql_query($q);$QUERY_COUNT++;
				$count_specializations = mysql_num_rows($res_specializations);
			}
		}
		if ($spec['SpecialityClasifierCode'] == "6.040106" || $spec['SpecialityClasifierCode'] == "7.04010601" || $spec['SpecialityClasifierCode'] == "8.04010601"){
			$spec['spec'] = str_replace("навколишнього середовища","навколишнього<br/>середовища",$spec['spec']);
		}
		if ($count_specializations){
			for ($l = 0; $l < $count_specializations; $l++){
				$specialization = mysql_fetch_assoc($res_specializations);
				$q = str_replace("__DATE__",$date,$query_counts);
				$q = str_replace("__CODE__",$spec['SpecialityClasifierCode'],$q);
				$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$q);
				$q .= " AND specialities.SpecialitySpecializationName='".$specialization['s_name']."'";
				$res_counts = mysql_query($q);$QUERY_COUNT++;
				$count = mysql_fetch_assoc($res_counts);
				$PEREVIRKA += $count['B_dnevn_all'];
				foreach ($count as $key => $val){
					if (preg_match("/_all/",$key)){
						if ($val =="") $count[$key] = "0";
						continue;
					}
					$PersonEducationFormID = (preg_match("/dnevn/",$key) != 0)?(1):(2);
					$count[$key] = preg_replace("/([1-9][0-9]*)/","<a href='".Yii::app()->createUrl("statistic/print")."?secname=".urlencode($_GET["secname"])."&FacultetID=".$row[$i]['idFacultet']."&SpecialityClasifierCode=".$spec['SpecialityClasifierCode']."&PersonEducationFormID=".$PersonEducationFormID."&date=".str_replace("'","",$date)."&SpecialitySpecializationName=".urlencode($specialization['s_name'])."' target='blank'> $1 </a>",$val);
					
                                        if ($val =="") $count[$key] = "0";
				}
				$Xspec = $spec['spec'];
				if (mb_strlen($specialization['s_name']) > 56) $Xspec .= "<br/>";
				$Xspec.="(".$specialization['s_name'].")";
				if (!($j ==0 && $l == 0)){
					$table[$s] .= "<tr>";
				}
				
				$table[$s++] .= "<td>".$Xspec."</td><td>".$count['B_dnevn_per_day']."</td><td>".$count['B_zaoch_per_day']."</td><td>".$count['B_dnevn_all']."</td><td>".$count['B_zaoch_all']."</td></tr>";
			}
		} else {
			$q = str_replace("__DATE__",$date,$query_counts);
			$q = str_replace("__CODE__",$spec['SpecialityClasifierCode'],$q);
			$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$q);
			$res_counts = mysql_query($q);$QUERY_COUNT++;
			$count = mysql_fetch_assoc($res_counts);
			$PEREVIRKA += $count['B_dnevn_all'];
			foreach ($count as $key => $val){
					if (preg_match("/_all/",$key)){
						if ($val =="") $count[$key] = "0";
						continue;
					}
					$PersonEducationFormID = (preg_match("/dnevn/",$key) != 0)?(1):(2);
					$count[$key] = preg_replace("/([1-9][0-9]*)/","<a href='".Yii::app()->createUrl("statistic/print")."?secname=".urlencode($_GET["secname"])."&FacultetID=".$row[$i]['idFacultet']."&SpecialityClasifierCode=".$spec['SpecialityClasifierCode']."&PersonEducationFormID=".$PersonEducationFormID."&date=".str_replace("'","",$date)."' target='blank'> $1 </a>",$val);
					if ($val =="") $count[$key] = "0"; 
			}
			if ($j > 0){
				$table[$s] .= "<tr>";
			}
			$table[$s++] .= "<td>".$spec['spec']."</td><td>".$count['B_dnevn_per_day']."</td><td>".$count['B_zaoch_per_day']."</td><td>".$count['B_dnevn_all']."</td><td>".$count['B_zaoch_all']."</td></tr>";
		}
	}
	
}

$gen_counts_query = "
SELECT SUM(specialities.PersonEducationFormID = 1
AND SUBSTRING(specialities.SpecialityClasifierCode,1,1) = '".$OKR."'
AND SUBSTRING(CreateDate,1,10)=SUBSTRING(__DATE__,1,10)
AND __ADDITIONAL_CONDITION__) as `all-dnevn-XX.07.2013`,

SUM(specialities.PersonEducationFormID = 2
AND SUBSTRING(specialities.SpecialityClasifierCode,1,1) = '".$OKR."'
AND SUBSTRING(CreateDate,1,10)=SUBSTRING(__DATE__,1,10)
AND __ADDITIONAL_CONDITION__) as `all-zaochn-XX.07.2013`,

SUM(specialities.PersonEducationFormID = 1
AND SUBSTRING(specialities.SpecialityClasifierCode,1,1) = '".$OKR."'
AND CreateDate
BETWEEN STR_TO_DATE('2013-07-01 00:00:00', '%Y-%m-%d %H:%i:%s')
AND STR_TO_DATE('2013-12-21 23:59:59', '%Y-%m-%d %H:%i:%s')
AND __ADDITIONAL_CONDITION__) as `all-dnevn-from01.07.2013`,

SUM(specialities.PersonEducationFormID = 2
AND SUBSTRING(specialities.SpecialityClasifierCode,1,1) = '".$OKR."'
AND CreateDate
BETWEEN STR_TO_DATE('2013-07-01 00:00:00', '%Y-%m-%d %H:%i:%s')
AND STR_TO_DATE('2013-12-21 23:59:59', '%Y-%m-%d %H:%i:%s') AND
__ADDITIONAL_CONDITION__) as `all-zaochn-from01.07.2013`

FROM

specialities JOIN facultets
ON facultets.idFacultet = specialities.FacultetID
LEFT JOIN personspeciality
ON specialities.idSpeciality=personspeciality.SepcialityID
WHERE  1 ;";

$gen_counts_query = str_replace("__ADDITIONAL_CONDITION__",$additional_count_condition,$gen_counts_query);
$gen_counts_query = str_replace("__DATE__",$date,$gen_counts_query);
$gen_counts_res = mysql_query($gen_counts_query);$QUERY_COUNT++;
$gen_counts = mysql_fetch_assoc($gen_counts_res);

$q = str_replace("__WDATE__","MID(CreateDate,1,10)=".$date,$query_distinct_persons);
$distinct_persons_per_day_res = mysql_query($q);$QUERY_COUNT++;
$distinct_persons_per_day = mysql_fetch_assoc($distinct_persons_per_day_res);
$q = str_replace("__WDATE__","1",$query_distinct_persons);
$distinct_persons_all_res = mysql_query($q);$QUERY_COUNT++;
$distinct_persons_all = mysql_fetch_assoc($distinct_persons_all_res);

?>
<center>
<h1>
Кількість заявок абітурієнтів<br/>
Освітньо-кваліфікаційний рівень "<?php
switch ($OKR) {
case 6: echo "Бакалавр";break;
case 7: echo "Спеціаліст";break;
case 8: echo "Магістр";break;
}
?>"
</h1>
<table border=1 cellspacing=0>
<tr>
<th rowspan="2" align='center'>Факультети</th>
<th rowspan="2" align='center'>Спеціальності</th>
<th colspan="2" align='center' style="font-size:10pt;">За <br/><?php echo $cday;?>.07.2013</th>
<th colspan="2" align='center' style="font-size:10pt;">За період з<br/>01.07.2013</th>
</tr>
<tr>
<th align='center' style="font-size:10pt;">Денна<br/>кількість</th>
<th align='center' style="font-size:10pt;">Заочна<br/>кількість</th>
<th align='center' style="font-size:10pt;">Денна<br/>кількість</th>
<th align='center' style="font-size:10pt;">Заочна<br/>кількість</th>

</tr>
<?php for ($i = 0; $i < count($table); $i++){echo $table[$i];}?>
<tr>
<td colspan="2"><p title='кількість запитів (mysql_query): <?php echo $QUERY_COUNT;?>'>Всього заявок</p></td>
    <td><?php echo $gen_counts['all-dnevn-XX.07.2013'];?></td>
    <td><?php echo $gen_counts['all-zaochn-XX.07.2013'];?></td>
    <td><?php echo $gen_counts['all-dnevn-from01.07.2013']/*." ( ".$PEREVIRKA." )"*/;?></td>
    <td><?php echo $gen_counts['all-zaochn-from01.07.2013'];?></td>
</tr>
<tr>
<td colspan="2">
    <p title='кількість запитів (mysql_query): <?php echo $QUERY_COUNT;?>'>
        Всього абітурієнтів
        <?php
        switch ($OKR){
            case '7': 
                echo " <i>разом з магістрами</i>";  
                break;
            case '8':
                echo " <i>разом із спеціалістами</i>";    
                break;
        }
        ?>
    </p></td>
    <td colspan="2"><?php echo $distinct_persons_per_day['cnt'];?></td>
    <td colspan="2"><?php echo $distinct_persons_all['cnt'];?></td>    
</tr>
</table>
</center>


</body>
</html>

<?php mysql_close(); ?>