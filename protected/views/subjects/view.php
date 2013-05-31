<?php
/* @var $this Subjectscontroller */
/* @var $model Subjects */

$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	$model->idSubjects,
);

$this->menu=array(
	/*array('label'=>'List Subjects', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idSubjects),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idSubjects),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Предмет" #<?php echo $model->idSubjects; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idSubjects',
		'idZNOSubject',
		'SubjectName',
		array(
    'label'=>'Категорія вищого рівня',
    'type'=>'raw',
    'value'=>$model->ps->SubjectName,
),
		'SubjectKey',
	),
)); ?>
