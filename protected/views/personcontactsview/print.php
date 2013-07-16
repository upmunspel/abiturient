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
        font-size: 10pt;
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

    
<?php 
    $data = $model->search(); 
    $table_data = $data->getData();
    $spesname = "";
    if (count($table_data)>0){
        $spesname = $table_data[0]->getAttribute('SpecName');
    }
?>



<div id="print-version" style="margin: 0 auto; width: 100%;"  >
    <h3><center>Телефони абітуріентів спеціальності  <?php echo $spesname; ?> </center></h3>
    <table border=1 cellspacing=0 width="100%">
        <tr>
            <th width="30">№</th>
            <th>Справа</th>
            <th>ФІО</th>
             <th>Ел. заява</th>
            <th>Спеціальність</th>
            <th>Контакти</th>
         </tr>
    <?php
       
      
        
        for ($i = 0; $i < count($table_data); $i++){
            ?>
            <tr>
                 <td align="center" ><?php
                echo $i+1;
            ?></td>
            <td align="center"><?php
                echo str_pad($table_data[$i]->getAttribute("RequestNumber"), 5, "0", STR_PAD_LEFT);
            ?></td>
            <td><?php
                echo $table_data[$i]->getAttribute('FIO');
            ?></td>
        <td><?php
                echo ($table_data[$i]->getAttribute('RequestFromEB') == 1) ? "Так": "Ні";
            ?></td>
            <td><?php
                echo $table_data[$i]->getAttribute('SpecName');
            ?></td>
             <td><?php
                echo $table_data[$i]->getAttribute('Contacts');
            ?></td>
            </tr>
            <?php
        }
    
    ?>
    </table>
</div>
