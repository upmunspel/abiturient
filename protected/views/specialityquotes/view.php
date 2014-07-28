<?php
/* @var $this SpecialityquotesController */
/* @var $model Specialityquotes */

$this->breadcrumbs=array(
	'Quota'=>array('index'),
	$model->idSpecialityQuotes,
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idSpecialityQuotes)),
	array('label'=>'Видалити запис', 'url'=>'#', 
    'linkOptions'=>array('submit'=>array('delete','id'=>$model->idSpecialityQuotes),
      'confirm'=>'Видалити остаточно?')
  ),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути запис довідника "Квоти спеціальностей" #<?php echo $model->idSpecialityQuotes; ?></h1>

<?php 
$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
  'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idSpecialityQuotes',
		'SpecialityID',
		'QuotaID',
		'BudgetPlaces',
	),
));
?>
