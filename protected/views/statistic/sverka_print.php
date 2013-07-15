<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */
?>
<!--<style media ="screen">
    #print-version {
        /* display: none; */
    }
    #screen-version {
        display: block;
    }
</style>-->
<style>
    #print-version {
        display: block;
        font-size: 7pt;
        margin: 2px;
        padding: 0px;
    }
    .navbar {
        display: none;
    }
   
    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
    
 </style>

    
<?php $data = $model->searchBigPrint(); ?>



<div id="print-version" style="margin: 0 auto; width: 100%;"  >
    <h1><center>Отчет сверка</center></h1>
    <table border=1 cellspacing=0 width="100%">
        <tr>
            <th style='width: 80px;'>Особ. справа</th> 
            <th>Справа</th>
            <th>ФН</th>
            <th>ФІО</th>
            <th>Спеціальність</th>
            <th>Копія</th>
            <th>ЗНО1</th>
            <th>ЗНО2</th>
            <th>ЗНО3</th>
            <th>Атестат</th>
            <th style="width:200px;">Пільги</th>
            <th style='width: 80px;'>Курси</th>
            <th style='width: 80px;'>Олімпіада / Бал</th>
        </tr>
    <?php
       
        $table_data = $data->getData();
        
        for ($i = 0; $i < count($table_data); $i++){
            ?>
            <tr>
            <td><?php
                echo $table_data[$i]->RequestPrefix.str_pad($table_data[$i]->getAttribute('PersonRequestNumber'), 5, "0", STR_PAD_LEFT);
            ?> </td>
            <td><?php
                echo str_pad($table_data[$i]->getAttribute('RequestNumber'), 5, "0", STR_PAD_LEFT);
            ?></td>
            <td><?php
                $is_copy = $table_data[$i]->getAttribute('EducationFormID');
                if ($is_copy == 1){
                    $is_copy = "Д";
                } else {
                    $is_copy = "З";
                }
                echo $is_copy;
            ?></td>
            <td><?php
                echo $table_data[$i]->getAttribute('FIO');
            ?></td>
            <td><?php
                echo $table_data[$i]->getAttribute('SpecCodeName');
            ?></td>
            <td><?php
                $is_copy = $table_data[$i]->getAttribute('isCopyEntrantDoc');
                if ($is_copy){
                    $is_copy = "так";
                } else {
                    $is_copy = "ні";
                }
                echo $is_copy;
            ?></td>
            <td><?php
                echo $table_data[$i]->getAttribute('DocumentSubject1Value');
            ?></td>
            <td><?php
                echo $table_data[$i]->getAttribute('DocumentSubject2Value');
            ?></td>
            <td><?php
                echo $table_data[$i]->getAttribute('DocumentSubject3Value');
            ?></td>
            <td><?php
                echo $table_data[$i]->getAttribute('AtestatValue');
            ?></td>
             <td><?php
                echo $table_data[$i]->getBenefits();
            ?></td>
            <td><?php
                $crs = $table_data[$i]->getAttribute('CoursedpID');
                if (!empty($crs)){
                    
                    echo $table_data[$i]->coursedp->CourseDPName;
                    $ball =  $table_data[$i]->CoursedpBall() ;
                    if (!empty($ball)) {
                        echo "(<strong>".$ball."</strong>)";
                    }
                } else {
                    echo "немає";
                }
            ?></td>
            <td><?php
                $crs = $table_data[$i]->getAttribute('OlympiadID');
                if ($crs){
                    echo $table_data[$i]->olympiad->OlympiadAwardName."(<strong>{$table_data[$i]->olympiad->OlympiadAwardBonus }</strong>)";
                } else {
                    echo "немає";
                }
            ?></td>
            </tr>
            <?php
        }
    
    ?>
    </table>
</div>
