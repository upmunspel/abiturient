<?php
/* @var $this Coursescontroller */
/* @var $model Courses */
/* @var $form CActiveForm */
?>
<div class="well form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    )); 
    ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
  <div class="row-fluid">
		<div class ="span2">
		<?php echo $form->label($model,'idCourse'); ?>
		<?php echo $form->textField($model,'idCourse',array('class'=>'span12')); ?>
	</div>
		<div class ="span10">
		<?php echo $form->label($model,'CourseName'); ?>
		<?php echo $form->textField($model,'CourseName',array('class'=>'span12','size'=>10,'maxlength'=>10)); ?>
	</div>
 </div>
 <hr>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                //'type'=>'info',
                'label'=>'Пошук',
        )); ?>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<?php $this->endWidget(); ?>
</div><!-- search-form -->