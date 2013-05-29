<?php echo $form->hiddenField($model,'[hospdoc]TypeID'); ?>
<?php echo CHtml::label("Дата медичної довідки <span class='required'>*</span>",CHtml::activeId($model, '[hospdoc]DateGet')); ?>
<?php echo $form->textField($model,'[hospdoc]DateGet', array('class'=>'span12 datepicker')); ?>
