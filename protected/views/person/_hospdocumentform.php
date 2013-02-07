<?php echo $form->hiddenField($model,'[hospdoc]TypeID'); ?>
<?php echo CHtml::label("Дата отримання медичної довідки",CHtml::activeId($model, '[hospdoc]DateGet')); ?>
<?php echo $form->textField($model,'[hospdoc]DateGet', array('class'=>'span12 datepicker')); ?>
