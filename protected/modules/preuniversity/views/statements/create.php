<?php
/* @var $this StatementsController */
/* @var $model Statements */

$this->breadcrumbs=array(
	'Statements'=>array('index'),
	'Create',
);

$this->menu=array(
	
	array('label'=>'Перелік відомостей', 'url'=>array('admin'),'icon'=>"icon-list-alt" ),
        array('label'=>'Перелік слухачів', 'url'=>array('/preuniversity/person'),'icon'=>" icon-user" ),
);
?>

<h1>Нова відомість</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>