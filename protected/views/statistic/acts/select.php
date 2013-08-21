<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Формування рейтингу - крок 1</title>
  <link rel="stylesheet" type="text/css" href="styles.css" />
 </head>
 <body>
	<?php 
	$fac = $_POST['facultet'];
	$spec = $_POST['spec'];
        $SpecSpec = $_POST['specialization'];       
        $index = 0;
        $tmp = true;
        for ($i = 0; $i < strlen($SpecSpec); $i++ ){
            if($SpecSpec[$i]==':'){
            $index = $i;
            $tmp = false;
            }
        }
        //echo $SpecSpec."\n";
        if($tmp == false){
        $speciality = substr($SpecSpec,0, $index);
        $specialization = substr($SpecSpec,$index+1,strlen($SpecSpec)-($index+1));
        }
        else
        {
            $speciality = $SpecSpec;
            $specialization = "";
        }
        echo $speciality;
        echo "   ".$specialization;
	$connection = mysql_connect('10.1.103.26','root','ehHYAuj');
	mysql_query("use abiturient");
	mysql_query("set names utf8");
	mysql_query("UPDATE parametersquery SET value='".$fac."' WHERE code=16");
	mysql_query("UPDATE parametersquery SET value='".$spec."' WHERE code=17");
        mysql_query("UPDATE parametersquery SET value='".$specialization."' WHERE code=18");
        mysql_query("UPDATE parametersquery SET value='".$speciality."' WHERE code=19");
	echo "<a href=\"http://10.1.11.57:8080/request_report-1.0/decanat.jsp?Speciality=$spec&Fac=$fac&iframe=true&width=1024&height=600\">Сформувати PDF</a>";
	?>
 </body>
</html>