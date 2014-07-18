<?php
/* @var $this EdbodataController */
/* @var $model EdboData */

$this->menu=array(
  array('label'=>'Додати новий запис', 'url'=>array('create')),
);


?>

<h1>ЄДЕБО-дані</h1>


<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
  'id' => 'edbo-data-grid',
  'dataProvider'=>$model->search_rel(),
  'filter'=>$model,
  'columns'=>array(
    'ID',
    'PIB',
    'Status',
    'Created',
    'RatingPoints',
    'SpecCode',
    'Direction',
    'SpecialCode',
    'Speciality',
    'Specialization',
    'DocPoint',
    'OD',
    array(
      'class'=>'bootstrap.widgets.TbButtonColumn',
    ),
  ),
)); ?>
