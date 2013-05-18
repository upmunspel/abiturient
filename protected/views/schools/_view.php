<?php
/* @var $this SchoolsController */
/* @var $data Schools */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idSchool')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idSchool), array('view', 'id'=>$data->idSchool)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EducationTypeID')); ?>:</b>
	<?php echo CHtml::encode($data->EducationTypeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Kode_School')); ?>:</b>
	<?php echo CHtml::encode($data->Kode_School); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchoolName')); ?>:</b>
	<?php echo CHtml::encode($data->SchoolName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchoolShortName')); ?>:</b>
	<?php echo CHtml::encode($data->SchoolShortName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('KOATUUCode')); ?>:</b>
	<?php echo CHtml::encode($data->KOATUUCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('KOATUUFullName')); ?>:</b>
	<?php echo CHtml::encode($data->KOATUUFullName); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('StreetTypeID')); ?>:</b>
	<?php echo CHtml::encode($data->StreetTypeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StreetName')); ?>:</b>
	<?php echo CHtml::encode($data->StreetName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HouceNum')); ?>:</b>
	<?php echo CHtml::encode($data->HouceNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchoolBossLastName')); ?>:</b>
	<?php echo CHtml::encode($data->SchoolBossLastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchoolBossFirstName')); ?>:</b>
	<?php echo CHtml::encode($data->SchoolBossFirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchoolBossMiddleName')); ?>:</b>
	<?php echo CHtml::encode($data->SchoolBossMiddleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchoolPhone')); ?>:</b>
	<?php echo CHtml::encode($data->SchoolPhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchoolMobile')); ?>:</b>
	<?php echo CHtml::encode($data->SchoolMobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchoolEMail')); ?>:</b>
	<?php echo CHtml::encode($data->SchoolEMail); ?>
	<br />

	*/ ?>

</div>
