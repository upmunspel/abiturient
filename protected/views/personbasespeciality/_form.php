<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerPackage('select2');
?>

<div class="form well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'personbasespeciality-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Поля з <span class="required">*</span> є обв'язковимиare.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row-fluid">
        <div class="span6">
            <?php echo $form->labelEx($model, 'PersonBaseSpecialityClasifierCode'); ?>
            <?php echo $form->textField($model, 'PersonBaseSpecialityClasifierCode', array('size' => 15, 'maxlength' => 15, "class" => "span12")); ?>
            <?php echo $form->error($model, 'PersonBaseSpecialityClasifierCode'); ?>
        </div>
        <div class="span6">
            <?php echo $form->labelEx($model, 'PersonBaseSpecialityName'); ?>
            <?php echo $form->textField($model, 'PersonBaseSpecialityName', array('size' => 60, 'maxlength' => 150, "class" => "span12")); ?>
            <?php echo $form->error($model, 'PersonBaseSpecialityName'); ?>
        </div>

    </div>
    <div class="row-fluid">
        <?php echo $form->labelEx($model, 'speciality'); ?>
        <?php echo $form->dropDownList($model, 'speciality', Specialities::DropDown(), array('empty' => "", 'style' => "width: 100%;", "multiple" => "multiple")); ?>
    </div>


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
        $("#spec-form-modal .switch").bootstrapSwitch();
        $('#<?php echo CHtml::activeId($model, "speciality"); ?>').select2({placeholder: "Обрати спеціальності", allowClear: true});
        //PSN.changeEntranceType($('#<?php echo CHtml::activeId($model, 'EntranceTypeID'); ?>').get(0));
    </script>
</div><!-- form -->
