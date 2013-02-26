<?php //echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class ="span5">
        <?php //echo $form->hiddenField($model,"[$i]idDocuments"); ?>
        <?php echo $form->labelEx($model,"[$i]SubjectID"); ?>
        <?php echo $form->dropDownList($model,"[$i]SubjectID", Subjects::DropDown(), array("class"=>"span12")); ?>
    </div>    
    <div class ="span3">
        <?php echo $form->labelEx($model,"[$i]DateGet"); ?>
        <?php echo $form->textField($model,"[$i]DateGet",array("class"=>"span12 datepicker","maxlength"=>10)); ?>
    </div>    
    <div class ="span4">
        <?php echo $form->labelEx($model,"[$i]SubjectValue"); ?>
        <?php echo $form->textField($model,"[$i]SubjectValue",array("class"=>"span12","maxlength"=>15)); ?>
    </div>    
   
</div>
