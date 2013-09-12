<?php
function fgetcsv($data,$columns,$file_name){
    $fp = fopen($file_name, "w");
    
    var_dump($fp);
    
    for ($i = 0; $i < count($data); $i++){
        foreach ($columns as $col){
            $value = $data[$i]->getAttribute($col['name']);
            if ($col['name'] != 'Status'){
                $value = $value . ';' ;
            } else {
                $value = $value . "\r\n" ;
            }
            if ($col['name'] == 'evaluation'){
                $value = str_replace(".",",",$value);
            }
            
            $value = iconv("utf-8","windows-1251",$value);
            fwrite($fp,$value);
            //echo $value;
        }
    }
    
    fclose($fp);
    
    //header("Location: ".Yii::app()->createUrl($file_name));
}
?>
