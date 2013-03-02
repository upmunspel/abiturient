<?php
/* @var $this DocumentsController 
 * @var $form CActiveForm
 */
//$form = new CActiveForm();
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
  
  <?php  foreach($subjects as $i=>$subject): ?>
        <div class="row-fluid">
         <div class="span1" align="center">
            <!--<?php echo ($i==0) ? "<div class ='span12' ><b>№</b></div>":""; ?>
            <div class="span12"><b><?php echo ($i+1)."."; ?></b></div>-->
         </div>
         
         <?php  $this->renderPartial("_subject",array("model"=>$subject,'form'=>$form,'i'=>$i)); ?>
         
        </div>
    <?php endforeach; endif;?> 

    <script>
        
        $('#zno-form-modal .datepicker').datepicker({'format':'dd.mm.yyyy'});
        $('.datepicker').css("z-index","9999");
        //$('#swmodal').bootstrapSwitch();
        
        
       
    </script>
<?php $this->endWidget(); ?>
</div>