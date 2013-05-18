<?php
/* @var $this Subjectscontroller */
/* @var $data Subjects */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idSubjects')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idSubjects), array('view', 'id'=>$data->idSubjects)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idZNOSubject')); ?>:</b>
	<?php echo CHtml::encode($data->idZNOSubject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubjectName')); ?>:</b>
	<?php echo CHtml::encode($data->SubjectName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ParentSubject')); ?>:</b>
	<?php echo CHtml::encode($data->ParentSubject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubjectKey')); ?>:</b>
	<?php echo CHtml::encode($data->SubjectKey); ?>
	<br />


</div>