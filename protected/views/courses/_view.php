<?php
/* @var $this Coursescontroller */
/* @var $data Courses */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCourse')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idCourse), array('view', 'id'=>$data->idCourse)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CourseName')); ?>:</b>
	<?php echo CHtml::encode($data->CourseName); ?>
	<br />


</div>