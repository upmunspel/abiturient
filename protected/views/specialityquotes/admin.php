<?php
/* @var $this SpecialityquotesController */
/* @var $model Specialityquotes */

$this->breadcrumbs=array(
	'specialityquotes'=>array('index'),
	'Довідник ',
);

$this->menu=array(
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
);
?>

<h1>Довідник "Квоти спеціальностей"</h1>


<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
  'id'=>'specialityquotes-grid',
  'type'=>'striped bordered condensed',
  'dataProvider'=>$model->search(),
  'filter'=>$model,
  'columns'=>array(
      array("name" => 'idSpecialityQuotes',
        'htmlOptions' => array('class' => 'span1'),
        'headerHtmlOptions' => array('class' => 'span1'),
      ),
      array(
        'class' => 'bootstrap.widgets.TbEditableColumn',
        'name' => 'SpecialityID',
        'editable' => array(
               'url'        => $this->createUrl('specialityquotes/xedit'),
               'type'       => 'select',
               'source'     => Specialities::getAllSpecs(),
               'placement'  => 'right',
               'inputclass' => 'span3',
           ),
        'htmlOptions' => array('class' => 'span5'),
        'headerHtmlOptions' => array('class' => 'span5'),
      ),
      array(
        'class' => 'bootstrap.widgets.TbEditableColumn',
        'name' => 'QuotaID',
        'editable' => array(
               'url'        => $this->createUrl('specialityquotes/xedit'),
               'type'       => 'select',
               'source'     => Quota::getAllQuota(),
               'placement'  => 'right',
               'inputclass' => 'span3',
           ),
        'htmlOptions' => array('class' => 'span4'),
        'headerHtmlOptions' => array('class' => 'span4'),
      ),
      array(
        'class' => 'bootstrap.widgets.TbEditableColumn',
        'name' => 'BudgetPlaces',
        'editable' => array(
               'url'        => $this->createUrl('specialityquotes/xedit'),
               'type'       => 'text',
               'placement'  => 'right',
               'inputclass' => 'span3',
           ),
        'htmlOptions' => array('class' => 'span2'),
        'headerHtmlOptions' => array('class' => 'span2'),
      ),
      array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
      ),
  ),
)); ?>
