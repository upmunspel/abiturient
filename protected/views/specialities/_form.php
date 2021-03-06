<?php
/* @var $this Specialitiescontroller */
/* @var $model Specialities */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerPackage('select2');
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'person-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="form well ">
    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
    <h3>Форма навчання:
        <?php
        $res = "";
            if (!empty($model->PersonEducationFormID)) {
                switch ($model->PersonEducationFormID) {
                    case "1": $res.="Денна";
                        break;
                    case "2": $res.="Заочна";
                        break;
                    case "3": $res.="Екстернат";
                        break;
                }
            }
            echo $res;
        ?>
        </h3>
    <h3>Повна назва:
        <?php
        
            echo $model->SpecialityFullName;
        ?>
        </h3>
    <?php echo $form->errorSummary($model); ?>
    <?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
    <div class="row-fluid">
        <div class ="span2">
            <?php echo $form->labelEx($model, 'idSpeciality'); ?>
            <?php echo $form->textField($model, 'idSpeciality', array('class' => 'span12')); ?>
            <?php echo $form->error($model, 'idSpeciality'); ?>
        </div>
        <div class ="span6">
            <?php echo $form->labelEx($model, 'SpecialityName'); ?>
            <?php echo $form->textField($model, 'SpecialityName', array('class' => 'span12', 'size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'SpecialityName'); ?>
        </div>
        <div class ="span4">
            <?php echo $form->labelEx($model, 'SpecialityKode'); ?>
            <?php echo $form->textField($model, 'SpecialityKode', array('class' => 'span12', 'size' => 40, 'maxlength' => 40)); ?>
            <?php echo $form->error($model, 'SpecialityKode'); ?>
        </div>
    </div>
    <?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
    <div class="row-fluid">
        <div class ="span4">
            <?php // echo $form->labelEx($model,'FacultetID'); ?>
            <?php //echo $form->dropDownList($model,'FacultetID', Facultets::DropDown(), array('class'=>'span12')); ?>
            <?php // echo $form->error($model,'FacultetID'); ?>
        </div>
    </div>
    <?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
    <div class="row-fluid">   	
        <div class ="span4">
            <?php echo $form->labelEx($model, 'SpecialityClasifierCode'); ?>
            <?php echo $form->textField($model, 'SpecialityClasifierCode', array('class' => 'span12', 'size' => 12, 'maxlength' => 12)); ?>
            <?php echo $form->error($model, 'SpecialityClasifierCode'); ?>
        </div>
        <div class ="span4">
            <?php echo $form->labelEx($model, 'SpecialityBudgetCount'); ?>
            <?php echo $form->textField($model, 'SpecialityBudgetCount', array('class' => 'span12')); ?>
            <?php echo $form->error($model, 'SpecialityBudgetCount'); ?>
        </div>
        <div class ="span4">
            <?php echo $form->labelEx($model, 'SpecialityContractCount'); ?>
            <?php echo $form->textField($model, 'SpecialityContractCount', array('class' => 'span12')); ?>
            <?php echo $form->error($model, 'SpecialityContractCount'); ?>
        </div>
    </div>
     <div class="row-fluid">
        <div class ="span12"></div>
    </div>
    <?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->labelEx($model, 'isArtExam'); ?>
            <div class="switch" data-on-label="Так" data-off-label="Ні">
                <?php echo $form->checkBox($model, 'isArtExam'); ?>
            </div> 
        </div>   
   
        <div class="span4">
            <?php echo $form->labelEx($model, 'isZaoch'); ?>
            <div class="switch" data-on-label="Так" data-off-label="Ні">
                <?php echo $form->checkBox($model, 'isZaoch'); ?>
            </div> 
        </div>   
   
        <div class="span4">
            <?php echo $form->labelEx($model, 'isPublishIn'); ?>
            <div class="switch" data-on-label="Так" data-off-label="Ні">
                <?php echo $form->checkBox($model, 'isPublishIn'); ?>
            </div> 
        </div>   
    </div>
      <hr/>
    <div class="row-fluid">
        <?php echo $form->labelEx($model, 'basespecialitys'); ?>
        <?php echo $form->dropDownList($model, 'basespecialitys', Personbasespeciality::DropDown(), array('empty' => "", 'style' => "width: 100%;", "multiple" => "multiple")); ?>
    </div>
     <?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
    <hr/>
    <div class="row-fluid">   	
        <div class ="span4">
            <?php echo $form->labelEx($model, 'Quota2'); ?>
            <?php echo $form->textField($model, 'Quota2', array('class' => 'span12', 'size' => 12)); ?>
            <?php echo $form->error($model, 'Quota2'); ?>
        </div>
        
    </div>

    <?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
    <div class="form-actions">
        <?php
        $this->widget("bootstrap.widgets.TbButton", array(
            'buttonType' => 'submit',
            'type' => 'primary',
            "size" => "null",
            'label' => $model->isNewRecord ? 'Створити' : 'Зберегти',
        ));
        ?>
    </div> 
<?php $this->endWidget(); ?>
     <script>
       
        $('#<?php echo CHtml::activeId($model, "basespecialitys"); ?>').select2({placeholder: "Обрати спеціальності", allowClear: true});
       
    </script>
</div><!-- form -->