<?php
/*$this BenefitController 
$model = new PersonBenefits();*/
//$form = new CActiveForm();
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'znos-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="well">
    <div class="row-fluid">
        <div class="span3">
                <?php
                    $url = Yii::app()->createUrl("personspeciality/create",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Додати спеціальність',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('id'=>'addSpec',
                        'onclick'=>"PSN.addSpec(this,'$url');",
                        ),
                )); ?>
        </div>
    </div>
    <hr>  
    <?php  /* PRINT ZNOS LIST */ ?>
    <?php if (!empty($models)): ?>   
        <?php foreach($models as $i=>$model): ?>   
            <div class="row-fluid">
                <div class="span12">
                  <?php echo $model->sepciality->SpecialityName; ?>
                </div>
                    
            </div>  
            <?php /*if (!empty($model->subjects)): ?>
                    
                <?php foreach($model->subjects as $j=>$subject): ?>
                    <div class="row-fluid">
                     <div class="span2" align="center">
                       <!-- <?php echo  ($j==0) ? "<div class='span12' style='text-align: right;'><b>№</b></div>":"";?>
                        <div class="span12" align="right"><b><?php echo ($j+1)."."; ?></b></div>-->
                     </div>
                     <div class ="span4">
                                <?php //echo $form->hiddenField($model,"[$i]idDocuments"); ?>
                                <?php echo  ($j==0) ? $form->labelEx($subject,"[$j]SubjectID"):""; ?>
                                <?php echo $form->dropDownList($subject,"[$j]SubjectID", Subjects::DropDown(), array("class"=>"span12",'disabled'=>"disabled")); ?>
                     </div>    
                     <div class ="span2">
                                <?php echo ($j==0) ? $form->labelEx($subject,"[$j]DateGet"):""; ?>
                                <?php echo $form->textField($subject,"[$j]DateGet",array("class"=>"span12 datepicker","maxlength"=>10,'disabled'=>"disabled" )); ?>
                     </div>    
                     <div class ="span2">
                                <?php echo ($j==0) ? $form->labelEx($subject,"[$j]SubjectValue"):""; ?>
                                <?php echo $form->textField($subject,"[$j]SubjectValue",array("class"=>"span12","maxlength"=>15, 'disabled'=>"disabled")); ?>
                     </div>    
                   </div>
                <?php endforeach; ?>
           <?php endif; */?> 
       <?php endforeach; ?>

    <?php endif;?>   
    
    
    
    
    <?php  /* END PRINT ZNOS LIST */ ?>
    
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->