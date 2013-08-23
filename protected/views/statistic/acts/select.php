<?php  
	$fac = $_POST['facultet'];
	$spec = $_POST['spec'];
        $SpecSpec = $_POST['specialization'];  
        $budgetcontract=$_POST['budgetcontract'];
		$budget; 
		$contract;
        $eduform=$_POST['eduform'];
        $index = 0;
        $tmp = true;
		if ($_POST['budgetcontract']== 1)
		{
			$budget=1; 
			$contract=0;
		}else
		{
			$budget=0; 
			$contract=1;
		}
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
        /*echo $speciality;
        echo "   ".$specialization;
		echo $budget;
		echo $contract;*/
	$connection = mysql_connect('10.1.10.26','root','ehHYAuj');
	mysql_query("use abiturient");
	mysql_query("set names utf8");
	mysql_query("UPDATE parametersquery SET value='".$fac."' WHERE code=16");
	mysql_query("UPDATE parametersquery SET value='".$spec."' WHERE code=17");
        mysql_query("UPDATE parametersquery SET value='".$specialization."' WHERE code=18");
        mysql_query("UPDATE parametersquery SET value='".$speciality."' WHERE code=19");
      //  if($budgetcontract=="Бюджет"){
	//echo "<a href=\"http://10.1.103.57:8080/request_report-1.0/decanat.jsp?budgetcontract=$budgetcontract&eduform=$eduform&budget=$budget&contract=$contract&iframe=true&width=1024&height=600\">Сформувати PDF</a>";
      //  }
      //  else{
           // echo "<a href=\"http://10.1.11.57:8080/request_report-1.0/decanat_contract.jsp?Speciality=$spec&Fac=$fac&iframe=true&width=1024&height=600\">Сформувати PDF</a>";
     //   }
         header("Location: http://10.1.11.57:8080/request_report-1.0/decanat_contract.jsp?budgetcontract=$budgetcontract&eduform=$eduform&budget=$budget&contract=$contract&iframe=true&width=1024&height=600");
        ?>
 