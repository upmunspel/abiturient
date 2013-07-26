<?php
$this->breadcrumbs=array(
	'Specialitysubjects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Перелік предметів напряку','url'=>array('admin'), 'icon'=>"icon-list-alt"),
//	array('label'=>'Manage Specialitysubjects','url'=>array('admin')),
);
?>

<h1>Create Specialitysubjects</h1>

<?php echo $this->renderPartial('_form', array('models'=>$models,'SpecialityID'=>$SpecialityID)); ?>