<?php
/* @var $this Countrycontroller */
/* @var $model Country */
/* @var $form CActiveForm */
?>

<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'country-form',
'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span2">
    <?php echo $form->labelEx($model,'CountryName'); ?>
    <?php echo $form->textField($model,'CountryName',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model,'CountryName'); ?>
    </div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
            <?php echo $form->labelEx($model,'Visible'); ?>
           <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'Visible');?>
                </div>
                <script type='text/javascript'>
                    $('#togle_Visible').toggleButtons({
                    label: {
                        enabled: 'Так',
                        disabled: 'Ні'
                    }
                });
             </script>   

            <?php echo $form->error($model,'Visible'); ?>
    </div>
<hr>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
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
