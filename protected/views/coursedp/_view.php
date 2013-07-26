<?php
/* @var $this CoursedpController */
/* @var $data Coursedp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCourseDP')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idCourseDP), array('view', 'id'=>$data->idCourseDP)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CourseDPName')); ?>:</b>
	<?php echo CHtml::encode($data->CourseDPName); ?>
	<br />


</div>