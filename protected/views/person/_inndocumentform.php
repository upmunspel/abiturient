<?php echo $form->hiddenField($model,'[hospdoc]TypeID'); ?>
<?php echo CHtml::label("Індивідуальний податковий номер",CHtml::activeId($model, '[inndoc]Numbers')); ?>
<?php echo $form->textField($model,'[inndoc]Numbers', array('class'=>'span12')); ?>
