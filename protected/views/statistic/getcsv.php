<?php

    //$model = new PersonspecMag();

    $Data = PersonspecMag::model()->search();
    $data = $Data->getData();

    $columns = array(
        array( 'name'=>    'FacultetFullName'  ),
        array( 'name'=>    'Specialnost'  ),
        array( 'name'=>    'FIO'  ),
        array( 'name'=>    'Kontrakt'  ),
        array( 'name'=>    'Budget'  ),
        array( 'name'=>    'PersonDocumentTypesName'  ),
        array( 'name'=>    'evaluation'  ),
        array( 'name'=>    'Status'  ),
    );
    
    $fp = fopen("mags_.csv", "w");
    
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
    
    header("Location: ".Yii::app()->createUrl("mags_.csv"));
?>
