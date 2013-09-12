<?php
/* @var $this ContractsController */
/* @var $model Contracts */
/* @var $form CActiveForm */
?>



<?php 
$specmodel = new PersonSpecialityView();
if ($model->isNewRecord){
    $specmodel=PersonSpecialityView::model()->find("idPersonSpeciality = $specid");
} else {
    $specmodel=PersonSpecialityView::model()->find("idPersonSpeciality = ".$model->PersonSpecialityID);
}
$model->PersonSpecialityID = $specmodel->idPersonSpeciality;

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contracts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

	<?php //echo $form->errorSummary($model); ?>
<?php  

//------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="form well">
    
        <div class="row-fluid">
            <h3>Студент: <?php echo $specmodel->FIO; ?> <br>(<?php echo $specmodel->SpecCodeName ?>) </h3>
            <hr>
            <?php echo $form->hiddenField($model,'PersonSpecialityID'); ?>
	</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>

        <div class="row-fluid">
<!--            <div class="span3">
		<?php // echo $form->labelEx($model,'ContractNumber'); ?>
		<?php //echo $form->textField($model,'ContractNumber',array('size'=>60,'maxlength'=>100, "class"=>"span12")); ?>
		<?php //echo $form->error($model,'ContractNumber'); ?>
            </div>-->
             
            <div class="span3">
                
                <?php echo $form->labelEx($model,'ContractDate'); ?>
                <?php echo $form->textField($model, 'ContractDate',array("class"=>"span12"));
                //echo $model->ContractDate
                //$form->labelEx($model,'ContractDate'); ?>
		<?php // echo $form->datepickerRow($model,'ContractDate', array("empty"=>"", "class"=>"span12", 'hint'=>'Click inside! This is a super cool date field.',
        ///'prepend'=>'<i class="icon-calendar"></i>')); ?>
		<?php echo $form->error($model,'ContractDate'); ?>
            </div>
            <div class="span9">
                <?php 
                if ($model->isNewRecord){
                    $model->CustomerName = $specmodel->FIO;
                }
                echo $form->labelEx($model,'CustomerName'); ?>
		<?php echo $form->textField($model,'CustomerName', array("class"=>"span12")); ?>
		<?php echo $form->error($model,'CustomerName'); ?>
            </div>
           
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
        
	</div>
          <div class="row-fluid">
            <div class="span6">
                <?php echo $form->labelEx($model,'CustomerDoc'); ?>
		<?php echo $form->textArea($model,'CustomerDoc',array('rows'=>3, 'cols'=>50, "class"=>"span12")); ?>
		<?php echo $form->error($model,'CustomerDoc'); ?>
            </div>
              <div class="span6">
              <?php echo $form->labelEx($model,'CustomerAddress'); ?>
		<?php echo $form->textArea($model,'CustomerAddress',array('rows'=>3, 'cols'=>50, "class"=>"span12")); ?>
		<?php echo $form->error($model,'CustomerAddress'); ?>
            </div>
          </div>
    
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
  
        <div class="row-fluid">
            
            <div class="span3">
              <?php echo $form->labelEx($model,'CustomerPaymentDetails'); ?>
		<?php echo $form->textArea($model,'CustomerPaymentDetails',array('rows'=>3, 'cols'=>50, "class"=>"span12")); ?>
		<?php echo $form->error($model,'CustomerPaymentDetails'); ?>
            </div>
            <div class="span3">
              <?php echo $form->labelEx($model,'PaymentDate'); ?>
		<?php echo $form->textField($model,'PaymentDate',array("class"=>"span12 datepicker")); ?>
		<?php echo $form->error($model,'PaymentDate'); ?>
            </div>
            <div class="span6">
              <?php echo $form->labelEx($model,'Comment'); ?>
		<?php echo $form->textArea($model,'Comment',array('rows'=>3, 'cols'=>50, "class"=>"span12")); ?>
		<?php echo $form->error($model,'Comment'); ?>
            </div>
            
        </div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
    <hr>
<div class="row-fluid">
    <?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        "size"=>"null",
			'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
                        )); 
    ?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    //$('#contracts-form .datepicker').datepicker({'format':'dd.mm.yyyy'});
</script>
