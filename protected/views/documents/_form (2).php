<?php
/* @var $this DocumentsController 
 * @var $form CActiveForm
 */
//$form = new CActiveForm();
?>
<?php 
$burl = Yii::app()->baseUrl;
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($burl."/js/bootstrap-datepicker.js");
Yii::app()->clientScript->registerScriptFile($burl."/js/person.js");

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
    //'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array("class"=>"well"),
));
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary($model); ?> 
<?php
   if (!empty($subjects)){
        foreach($subjects as $i=>$subject){
            echo $form->errorSummary($subject); 
        }
   }
   echo $form->hiddenField($model, "PersonID");
   echo $form->hiddenField($model, "idDocuments");
   
?> 
<div class="row-fluid">
    <div class ="span6">
        <?php echo $form->labelEx($model,'Numbers'); ?>
        <?php echo $form->textField($model,'Numbers',array('class'=>'span12', 'maxlength'=>7)); ?>
    </div>    
    <div class ="span6">
        <?php echo $form->labelEx($model,'ZNOPin'); ?>
        <?php echo $form->textField($model,'ZNOPin',array('class'=>'span12','maxlength'=>4)); ?>
    </div>    
</div>
<?php if (!empty($subjects)): ?>
    
    <div class="row-fluid" style ="font-weight: bold;">
        <div class="span1" align="center">П/Н</div>
    <div class ="span4">
        <?php  echo Documentsubject::model()->getAttributeLabel("SubjectID"); ?>
    </div>    
    <div class ="span3">
        <?php echo Documentsubject::model()->getAttributeLabel("DateGet"); ?>
    </div>    
    <div class ="span3">
        <?php echo Documentsubject::model()->getAttributeLabel("SubjectValue"); ?>
    </div>    
    <div class ="span1"></div>
    </div>  
  <?php  foreach($subjects as $i=>$subject): ?>
        <div class="row-fluid" <?php echo ($subject->deleted == 1) ? "style='display:none'":"";?> >
         <div class="span1" align="center" >
             <span style="font-size: 14px; display:block; margin-top: 5px;"><?php echo ($i+1); ?></span>
         </div>
         
         <?php  $this->renderPartial("_subject",array("model"=>$subject,'form'=>$form,'i'=>$i)); ?>
         
        </div>
    <?php endforeach; endif;?> 

    <script>
        
        $('#zno-form-modal .datepicker').datepicker({'format':'dd.mm.yyyy'});
        $('.datepicker').css("z-index","9999");
        //$('#swmodal').bootstrapSwitch();
        
        
       
    </script>
    <div class="form-actions">
<?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                         "size"=>"null",
			'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
                        )); 
                ?>
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
</div>