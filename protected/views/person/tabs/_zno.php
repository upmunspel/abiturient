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
                $url = Yii::app()->createUrl("documents/newzno",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Додати сертифікат',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('id'=>'addZno',
                        'onclick'=>"PSN.addZno(this,'$url');",
                        ),
                )); ?>
        </div>
    </div>
    <hr>  
    <?php  /* PRINT ZNOS LIST */ ?>
    <?php if (!empty($models)): ?>   
        <?php foreach($models as $i=>$model): ?>   
            <div class="row-fluid">
                <div class ="span1">
                        <div class="row-fluid">
                             <div class="span12"></div>
                        </div>   
                        <div class="row-fluid" style="text-align: right;">
                             <div class="span12"><b><?php echo ($i+1)."."; ?></b></div>
                        </div>    
                </div>   
                <div class ="span5">
                    <?php echo $form->labelEx($model,"[$i]Numbers"); ?>
                    <?php echo $form->textField($model,"[$i]Numbers",array('class'=>'span12')); ?>
                </div>    
                <div class ="span4">
                    <?php echo $form->labelEx($model,"[$i]ZNOPin"); ?>
                    <?php echo $form->textField($model,"[$i]ZNOPin",array('class'=>'span12')); ?>
                </div>    
                <div class ="span1">
                    <span >&nbsp;</span>
                   <?php 
            //$url = Yii::app()->createUrl("personbenefits/delbenefit",array('benefitid'=>$model->idPersonBenefits, "personid"=>$personid));
            $this->widget("bootstrap.widgets.TbButton", array(
			'type'=>'danger',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-trash",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Видалити сертифікат",
                                'class'=>"span12",
                                'onclick'=>"PSN.deleteZno(this,'$url');"), 
                        )); 
             ?>
                </div>
                <div class ="span1">
                    <span >&nbsp;</span>
                   <?php 
            //$url = Yii::app()->createUrl("personbenefits/delbenefit",array('benefitid'=>$model->idPersonBenefits, "personid"=>$personid));
            $this->widget("bootstrap.widgets.TbButton", array(
			//'type'=>'primary',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-edit",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Редагувати сертифікат",
                                'class'=>"span12",
                                'onclick'=>"PSN.editZno(this,'$url');"), 
                        )); 
             ?>
                </div>    
            </div>
            
            <?php if (!empty($model->subjects)): ?>
                <?php foreach($model->subjects as $j=>$subject): ?>
                    <div class="row-fluid">
                     <div class="span2" align="center">
                        <div class="row-fluid">
                             <div class="span12"></div>
                        </div>   
                        <div class="row-fluid" style="text-align: right;">
                             <div class="span12" ><b><?php echo ($j+1)."."; ?></b></div>
                        </div>    
                     </div>
                     <div class ="span4">
                                <?php //echo $form->hiddenField($model,"[$i]idDocuments"); ?>
                                <?php echo $form->labelEx($subject,"[$j]SubjectID"); ?>
                                <?php echo $form->dropDownList($subject,"[$j]SubjectID", Subjects::DropDown(), array("class"=>"span12")); ?>
                     </div>    
                     <div class ="span2">
                                <?php echo $form->labelEx($subject,"[$j]DateGet"); ?>
                                <?php echo $form->textField($subject,"[$j]DateGet",array("class"=>"span12 datepicker","maxlength"=>10)); ?>
                     </div>    
                     <div class ="span2">
                                <?php echo $form->labelEx($subject,"[$j]SubjectValue"); ?>
                                <?php echo $form->textField($subject,"[$j]SubjectValue",array("class"=>"span12","maxlength"=>15)); ?>
                     </div>    
                   </div>
                <?php endforeach; ?>
           <?php endif; ?> 
       <?php endforeach; ?>

    <?php endif;?>   
    
    
    
    
    <?php  /* END PRINT ZNOS LIST */ ?>
    
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->