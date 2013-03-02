<?php //echo $form->errorSummary($model); ?>
<div class ="span4">
    <?php //echo $form->hiddenField($model,"[$i]idDocuments"); ?>
    <?php  echo ($i==0) ?  $form->labelEx($model,"[$i]SubjectID"):""; ?>
    <?php echo $form->dropDownList($model,"[$i]SubjectID", Subjects::DropDown(), array("class"=>"span12")); ?>
</div>    
<div class ="span3">
    <?php echo ($i==0) ? $form->labelEx($model,"[$i]DateGet"):""; ?>
    <?php echo $form->textField($model,"[$i]DateGet",array("class"=>"span12 datepicker","maxlength"=>10)); ?>
</div>    
<div class ="span3">
    <?php echo ($i==0) ? $form->labelEx($model,"[$i]SubjectValue"):""; ?>
    <?php echo $form->textField($model,"[$i]SubjectValue",array("class"=>"span12","maxlength"=>15)); ?>
</div>    
<div class ="span1"  >
    <?php  echo ($i==0) ? "<label>&nbsp</label>":"";?>
    <div class="span12" >
    <?php 
            $url = Yii::app()->createUrl("documents/delznosubject",array("num"=>$i));
            $this->widget("bootstrap.widgets.TbButton", array(
			'type'=>'danger',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-trash",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Видалити предмет",
                                'class'=>"span12",
                                'onclick'=>"PSN.delZnoSubject(this,'$url');"), 
                        )); 
             ?>
        </div>

</div>    