<?php //echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class ="span9">
        <?php //echo $form->hiddenField($model,"[$i]idDocuments"); ?>
        <?php echo $form->labelEx($model,"[$i]TypeID"); ?>
        <?php echo $form->dropDownList($model,"[$i]TypeID",  PersonDocumentTypes::DropDown(1), array("class"=>"span12")); ?>
    </div>    
    <div class ="span1">
        <?php echo $form->labelEx($model,"[$i]Series"); ?>
        <?php echo $form->textField($model,"[$i]Series",array("class"=>"span12","maxlength"=>10)); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,"[$i]Numbers"); ?>
        <?php echo $form->textField($model,"[$i]Numbers",array("class"=>"span12","maxlength"=>15)); ?>
    </div>    
   
</div>
<div class="row-fluid">
     <div class ="span2">
        <?php echo $form->labelEx($model,"[$i]DateGet"); ?>
        <?php echo $form->textField($model,"[$i]DateGet", array("class"=>"span12 datepicker")); ?>
        <?php //echo $form->textFieldRow($model,"ZNOPin",array("class"=>"span5")); ?>
        <?php //echo $form->textFieldRow($model,"AtestatValue",array("class"=>"span5","maxlength"=>10)); ?>
    </div> 
    <div class ="span8">
        <?php echo $form->labelEx($model,"[$i]Issued"); ?>
        <?php echo $form->textField($model,"[$i]Issued",array("class"=>"span12","maxlength"=>250)); ?>
        
    </div>   
    <div class ="span2">
      <?php echo Chtml::label("Знищити", ""); ?>
    <?php 
            $url = Yii::app()->createUrl("personbenefits/delbenefitdoc",array('num'=>$i));
            $this->widget("bootstrap.widgets.TbButton", array(
			'type'=>'danger',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-trash",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Видалити пільгу",
                                'class'=>"span7",
                                'onclick'=>"PSN.delBenefitDoc(this,'$url');"), 
                        )); 
                ?>
    </div>
</div>