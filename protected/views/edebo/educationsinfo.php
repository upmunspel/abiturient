<?php 
$sp = Specialities::model()->find("idSpeciality = $specid");
?>
<h3>Перевірка попередньої освіти персон</h3>
<h4>Спеціальність: <?php echo $specid.' : '.$sp->getSpecialityFullName(); ?></h4>
<style>
    ul.person-item {
        overflow: hidden;
        border-bottom: 1px solid #ccc;
    }
    
    ul.person-item li {
        float: left;

        list-style: none;
    }
    li.person-item-id {
        width: 50px;
    }
    li.person-item-num {
        width: 50px;
    }
    li.person-item-fio {
        width: 230px;
    }
    li.person-item-edboid {
        width: 200px;
    }
    li.person-item-msg {
        width: 500px;
    }
</style>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requests = Personspeciality::model()->findAll("SepcialityID = $specid");
echo "<div> Обрано " . count($requests) . " заявок. </div>";
$i = 0;
foreach ($requests as $item) {
    $msg = "";
    try {
        $res = WebServices::getPersonBaseEducations($item->person->codeU);
        $res = CJSON::decode($res);

        if (is_array($res)) {
            $msg.="";
            foreach ($res as $obj) {
                $obj = (object) $obj;
                if (!(strpos($obj->universityFullName, "Запорізький національний університет")>0)){
                    $msg.= $obj->personEducationFormName .
                            " : " . $obj->personEducationPaymentTypeName .
                            " : " . $obj->qualificationName .
                            " : " . $obj->specDirectionName .
                            " : " . $obj->universityFullName;
                } else {
                    $msg = " немає ";
                }
            }
        }
       
    } catch (Exception $e) {
        $msg = $e->getMessage();
        
    }
    echo "<ul class='person-item'>";
    echo "<li class='person-item-num'>" . ++$i . "</li>";
    echo "<li class='person-item-id'>" . $item->person->idPerson . "</li>";
    echo "<li class='person-item-fio'><a href='" . Yii::app()->createUrl("person/view", array("id" => $item->person->idPerson)) . "'>" . $item->person->getFIO() . "</a></li>";
    echo "<li class='person-item-edboid'>" . $item->person->codeU . "</li>";
    echo "<li class='person-item-msg'>" . $msg . "</li>";
    echo "</ul>";
}
