<?php  

if ($model->PersonContactTypeID == 1) {
    $type = "homephone";
    $label = "Стаціонарний телефон";
} else {
    $type = "mobphone";
    $label = "Мобільний телефон";
}          
echo Chtml::label($label, CHtml::activeId($model,"[$type]Value")); ?>
<?php echo $form->textField($model,"[$type]Value",array('class'=>'span12')); ?>
   