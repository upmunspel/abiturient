<!DOCTYPE HTML>
<html>
<head>
<title>Особи з ознакою "Перехресний вступ"</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body>
<?php

?>
<h1>Особи з ознакою "Перехресний вступ"</h1>
<style type="text/css">
    .container{
        text-align:center;
    }
    .report tr:nth-child(odd){
        /*background-color:#e0eeee;*/
    }
    .repeat{
        background-color:#e0eeee;
        border-left:5px solid silver;
    }
    .start{
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,e0eeee+100 */
        background: #ffffff; /* Old browsers */
        background: -moz-linear-gradient(top, #ffffff 0%, #e0eeee 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#e0eeee)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #ffffff 0%,#e0eeee 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #ffffff 0%,#e0eeee 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #ffffff 0%,#e0eeee 100%); /* IE10+ */
        background: linear-gradient(to bottom, #ffffff 0%,#e0eeee 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e0eeee',GradientType=0 ); /* IE6-9 */
        
        border-top:7px solid white;
        border-left:5px solid silver;
        
    }
    .report td{
        padding:0px 1em 4px 0.5em;
        vertical-align:top;
    }
</style>
<div class="container">
<table class="report" cellspacing="0">
    <tr>
        <th>Прізвище, ім'я, по батькові</th>
        <th>Спеціальність / напрям</th>
        <th>OKP</th>
        <th>Форма<br>навчання</th>
        <th>Факультет</th>
    </tr>
<?php
$FacultetFullName='';
$PersonEducationFormName='';
$QualificationName='';
$SpecialityTitle='';
foreach($list as $row){
    if($FacultetFullName != $row['FacultetFullName']){
        $viewFacultetFullName =$row['FacultetFullName'];
        $FacultetFullName = $row['FacultetFullName'];
        $PersonEducationFormName='';
        $QualificationName='';
        $SpecialityTitle='';
    }else{
        $viewFacultetFullName='';
    }
    if($PersonEducationFormName != $row['PersonEducationFormName']){
        $viewPersonEducationFormName = $row['PersonEducationFormName'];
        $PersonEducationFormName = $row['PersonEducationFormName'];
        $QualificationName='';
        $SpecialityTitle='';
    }else{
        $viewPersonEducationFormName='';
    }
    if($QualificationName != $row['QualificationName']){
        $viewQualificationName =  $row['QualificationName'];
        $QualificationName = $row['QualificationName'];
        $SpecialityTitle='';
    }else{
        $viewQualificationName = '';
    }
    if($SpecialityTitle != $row['SpecialityTitle']){
            $viewSpeciality = $row['SpecialityClasifierCode'].' '.$row['SpecialityTitle'];
            $SpecialityTitle = $row['SpecialityTitle'];
    }else{
        $viewSpeciality ='';
    }
    ?>
    <tr>
        <td class="start"><?php echo $row['LastName']; ?> <?php echo $row['FirstName']; ?> <?php echo $row['MiddleName']; ?></td>
        <td class="<?php echo $viewSpeciality?'start':'repeat'; ?>"><?php echo $viewSpeciality; ?></td>
        <td class="<?php echo $viewQualificationName ?'start':'repeat'; ?>"><?php echo $viewQualificationName; ?></td>
        <td class="<?php echo $viewPersonEducationFormName?'start':'repeat'; ?>"><?php echo $viewPersonEducationFormName; ?></td>
        <td class="<?php echo $viewFacultetFullName?'start':'repeat'; ?>"><?php echo $viewFacultetFullName; ?></td>
    </tr>
    <?php
}
?>
</table>
<hr>
&copy; Запорізький національний університет, 2015 р.
</div>
</body>
</html>