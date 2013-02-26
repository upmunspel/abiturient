<?php
/* @var $this DocumentsController 
 * @var $form CActiveForm
 */

?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
)); 
//$model = new Documents();
//$form = new CActiveForm();
?>
    
<?php echo $form->errorSummary($model); ?> 
<?php echo $form->errorSummary(new Documentsubject()); ?> 
           
<div class="row-fluid">
    <div class ="span6">
        <?php echo $form->labelEx($model,'Numbers'); ?>
        <?php echo $form->textField($model,'Numbers',array('class'=>'span12')); ?>
    </div>    
    <div class ="span6">
        <?php echo $form->labelEx($model,'ZNOPin'); ?>
        <?php echo $form->textField($model,'ZNOPin',array('class'=>'span12')); ?>
    </div>    
   <!--<div class ="span3">
       <?php echo $form->labelEx($model,'isCopy'); ?>
       <div id="swmodal" class="switch" data-on-label="Так" data-off-label="Ні">
            <?php echo $form->checkbox($model,'isCopy'); ?>
       </div>
        
    </div>-->
   
</div>
<?php if (empty($subjects)) $subjects = array();
    foreach($subjects as $i=>$subject): ?>
        <div class="row-fluid">
         <div class="span1" align="center">
            <div class="row-fluid">
                 <div class="span12"></div>
            </div>   
            <div class="row-fluid">
                 <div class="span12"><b><?php echo ($i+1)."."; ?></b></div>
            </div>    
         </div>
         <div class="span11">
            <?php  $this->renderPartial("_subject",array("model"=>$subject,'form'=>$form,'i'=>$i)); ?>
         </div>
        </div>
    <?php endforeach; ?> 

    <script>
        
        $('#zno-form-modal .datepicker').datepicker({'format':'dd.mm.yyyy'});
        $('.datepicker').css("z-index","9999");
        //$('#swmodal').bootstrapSwitch();
        
        
       
    </script>
<?php $this->endWidget(); ?>
</div>