<?php  

if ($model->PersonContactTypeID == 1) {
    $type = "homephone";
    $label = "Стаціонарний телефон";
} else {
    $type = "mobphone";
    $label = "Мобільний телефон";
} ?>         
<?php echo CHtml::label( $label, CHtml::activeId($model,"[$type]Value"), array("required"=>'true')); ?>
<?php echo $form->textField($model,"[$type]Value",array('class'=>'span12')); 
      echo $form->error($model,"[$type]Value"); 
?>
   