<?php //echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class ="span5">
        <?php //echo $form->hiddenField($model,'[entrantdoc]idDocuments'); ?>
        <?php echo $form->labelEx($model,'[entrantdoc]TypeID'); ?>
        <?php echo $form->dropDownList($model,'[entrantdoc]TypeID',  PersonDocumentTypes::DropDown(1), array('class'=>'span12')); ?>
    </div>    
    <div class ="span1">
        <?php echo $form->labelEx($model,'[entrantdoc]Series'); ?>
        <?php echo $form->textField($model,'[entrantdoc]Series',array('class'=>'span12','maxlength'=>10)); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'[entrantdoc]Numbers'); ?>
        <?php echo $form->textField($model,'[entrantdoc]Numbers',array('class'=>'span12','maxlength'=>15)); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'[entrantdoc]DateGet'); ?>
        <?php echo $form->textField($model,'[entrantdoc]DateGet', array('class'=>'span12 datepicker')); ?>
        <?php //echo $form->textFieldRow($model,'ZNOPin',array('class'=>'span5')); ?>
        <?php //echo $form->textFieldRow($model,'AtestatValue',array('class'=>'span5','maxlength'=>10)); ?>
    </div> 
    <div class ="span2">
        <?php echo $form->labelEx($model,'[entrantdoc]AtestatValue'); ?>
        <?php echo $form->textField($model,'[entrantdoc]AtestatValue', array('class'=>'span12')); ?>
        <?php //echo $form->textFieldRow($model,'ZNOPin',array('class'=>'span5')); ?>
        <?php //echo $form->textFieldRow($model,'AtestatValue',array('class'=>'span5','maxlength'=>10)); ?>
    </div> 
</div>
<div class="row-fluid">
    <div class ="span12">
        <?php echo $form->labelEx($model,'[entrantdoc]Issued'); ?>
        <?php echo $form->textField($model,'[entrantdoc]Issued',array('class'=>'span12','maxlength'=>250)); ?>
    </div>    
<!--    <div class ="span2">
        <?php // echo $form->labelEx($model,'[entrantdoc]isCopy'); ?>
        <div class="switch" data-on-label="Так" data-off-label="Ні">
            <?php //echo $form->checkBox($model,'[entrantdoc]isCopy'); ?>
        </div>
    </div>-->
</div>
