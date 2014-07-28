<?php
/* @var $this SpecialityquotesController */
/* @var $model Specialityquotes */

$this->breadcrumbs=array(
	'specialityquotes'=>array('index'),
	'Довідник ',
);

$this->menu=array(
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
);
?>

<h1>Довідник "Квоти спеціальностей"</h1>

<div class="row-fluid">
<div class="span12 well well-small">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'specialityquotes-form',
	'enableAjaxValidation'=>false,
  'action' => '',
  'method' => 'POST',
)); 
/* @var $form CActiveForm */
?>

<p class="note">У цій формі можна додавати квоту до спеціальності. 
  Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
    <div class="span6">
      <?php echo $form->labelEx($model,'SpecialityID'); ?>
      <?php echo $form->dropDownList($model, 'SpecialityID', 
        Specialities::getAllSpecs(), array('class'=>'span12')); ?>
      <?php echo $form->error($model,'SpecialityID'); ?>
    </div>
    <div class="span3">
      <?php echo $form->labelEx($model,'QuotaID'); ?>
      <?php echo $form->dropDownList($model, 'QuotaID', 
        Quota::getAllQuota(), array('class' => 'span12')); ?>
      <?php echo $form->error($model,'QuotaID'); ?>
    </div>
    <div class="span2">
      <?php echo $form->labelEx($model,'BudgetPlaces'); ?>
      <?php echo $form->textField($model, 'BudgetPlaces', array('class' => 'span12')); ?>
      <?php echo $form->error($model,'BudgetPlaces'); ?>
    </div>
    <div class="span1">
      <input type="hidden" name="SpecialityQuotesCreate" value="1" />
      <?php 
      echo CHtml::label('OK','SpecialityQuotesCreateButton');
      $this->widget("bootstrap.widgets.TbButton", array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'icon' => 'star',
        'id' => 'SpecialityQuotesCreateButton',
        //'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
      )); ?>
    </div>
  </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
  'id'=>'specialityquotes-grid',
  'type'=>'striped bordered condensed',
  'dataProvider'=>$model->search(),
  'filter'=>$model,
  'columns'=>array(
      array("name" => 'idSpecialityQuotes',
        'htmlOptions' => array('class' => 'span1'),
        'headerHtmlOptions' => array('class' => 'span1'),
      ),
      array(
        'class' => 'bootstrap.widgets.TbEditableColumn',
        'name' => 'SpecialityID',
        'editable' => array(
               'url'        => $this->createUrl('specialityquotes/xedit'),
               'type'       => 'select',
               'source'     => Specialities::getAllSpecs(),
               'placement'  => 'right',
               'inputclass' => 'span3',
           ),
        'htmlOptions' => array('class' => 'span5'),
        'headerHtmlOptions' => array('class' => 'span5'),
      ),
      array(
        'class' => 'bootstrap.widgets.TbEditableColumn',
        'name' => 'QuotaID',
        'editable' => array(
               'url'        => $this->createUrl('specialityquotes/xedit'),
               'type'       => 'select',
               'source'     => Quota::getAllQuota(),
               'placement'  => 'right',
               'inputclass' => 'span3',
           ),
        'htmlOptions' => array('class' => 'span4'),
        'headerHtmlOptions' => array('class' => 'span4'),
      ),
      array(
        'class' => 'bootstrap.widgets.TbEditableColumn',
        'name' => 'BudgetPlaces',
        'editable' => array(
               'url'        => $this->createUrl('specialityquotes/xedit'),
               'type'       => 'text',
               'placement'  => 'right',
               'inputclass' => 'span3',
           ),
        'htmlOptions' => array('class' => 'span2'),
        'headerHtmlOptions' => array('class' => 'span2'),
      ),
      array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
      ),
  ),
)); ?>
