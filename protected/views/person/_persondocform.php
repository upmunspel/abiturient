<?php //echo $form->errorSummary($model); $form = new CActiveForm()  ?>
<div class="row-fluid">
<!--            <div class ="span12">-->
                <?php echo $form->errorSummary($model) ?>
<!--            </div>-->
</div>
<div class="row-fluid">
    <div class ="span5">
        <?php echo $form->hiddenField($model,'[persondoc]edboID'); ?>
        <?php echo $form->labelEx($model,'[persondoc]TypeID'); ?>
        <?php echo $form->dropDownList($model,'[persondoc]TypeID',  PersonDocumentTypes::DropDown(2), array('class'=>'span12', 'disabled'=>!empty($model->edboID) )); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'[persondoc]Series'); ?>
        <?php echo $form->textField($model,'[persondoc]Series',array('class'=>'span12 series','maxlength'=>10, 'disabled'=>!empty($model->edboID))); ?>
    </div>    
    <div class ="span3">
        <?php echo $form->labelEx($model,'[persondoc]Numbers'); ?>
        <?php echo $form->textField($model,'[persondoc]Numbers',array('class'=>'span12','maxlength'=>15, 'disabled'=>!empty($model->edboID))); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'[persondoc]DateGet'); ?>
        <?php echo $form->textField($model,'[persondoc]DateGet', array('class'=>'span12 datepicker', 'disabled'=>!empty($model->edboID))); ?>
        <?php //echo $form->textFieldRow($model,'ZNOPin',array('class'=>'span5')); ?>
        <?php //echo $form->textFieldRow($model,'AtestatValue',array('class'=>'span5','maxlength'=>10)); ?>
    </div> 
</div>
<div class="row-fluid">
    <div class ="span12">
        <?php echo $form->labelEx($model,'[persondoc]Issued'); ?>
        <?php echo $form->textField($model,'[persondoc]Issued',array('class'=>'span12','maxlength'=>250, 'disabled'=>!empty($model->edboID))); ?>
    </div>    
</div>