<?php echo $form->hiddenField($model,'[inndoc]TypeID'); ?>
<?php echo $form->hiddenField($model,'[inndoc]edboID'); ?>
<?php echo CHtml::label("Індивідуальний податковий номер <span class='required'>*</span>",CHtml::activeId($model, '[inndoc]Numbers'), array('class'=>"required")); ?>
<?php echo $form->textField($model,'[inndoc]Numbers', array('class'=>'span12')); ?>
<?php echo $form->errorSummary($model) ?>
